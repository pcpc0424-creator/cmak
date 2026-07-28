<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * 관리자 에디터 첨부 업로드 전체 흐름 검증.
 * 실제 라우트(admin.page-contents.upload-file) → AdminMiddleware → PermissionMiddleware
 * → FileUploadController → DB → Storage(public) → 다운로드 라우트(file.download) 까지
 * 전체 미들웨어 스택을 그대로 통과시킨다. (격리된 in-memory sqlite, 실서비스 DB/파일 미접촉)
 */
class EditorFileUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // APP_URL 에 /cmak 경로가 포함되어 있어(실서버는 nginx가 제거) 테스트 요청 경로가
        // /cmak/admin/... 으로 만들어져 라우트와 어긋난다. 테스트에선 루트를 호스트만으로 강제.
        \Illuminate\Support\Facades\URL::forceRootUrl('http://localhost');
        // CSRF 는 인프라 관심사(브라우저는 _token/X-CSRF-TOKEN 전송을 blade 에서 확인함).
        // 여기서는 AdminMiddleware/PermissionMiddleware/컨트롤러 로직 검증에 집중한다.
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
    }

    protected function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    /** 요구된 9개 확장자 + 한글 파일명 업로드 → 저장 → 다운로드 */
    public function test_all_extensions_upload_store_and_download(): void
    {
        Storage::fake('public');
        $this->actingAs($this->admin());

        $exts = ['hwp', 'hwpx', 'pdf', 'doc', 'docx', 'xlsx', 'pptx', 'jpg', 'png'];

        foreach ($exts as $ext) {
            $koreanName = "협회 관련자료 최종본.{$ext}";
            $file = UploadedFile::fake()->create($koreanName, 10); // 10KB

            $res = $this->post(route('admin.page-contents.upload-file'), ['file' => $file]);

            $res->assertOk();
            $res->assertJson(['success' => true]);
            $json = $res->json();

            // DB 레코드 + 원본 한글 파일명 보존
            $att = Attachment::find($json['file']['id']);
            $this->assertNotNull($att, "[$ext] Attachment 레코드 생성 실패");
            $this->assertSame($koreanName, $att->file_name, "[$ext] 한글 파일명 미보존");
            $this->assertNull($att->attachable_id, "[$ext] 단독 업로드는 attachable 이 null 이어야 함");

            // 실제 저장 확인 (public 디스크)
            $relative = preg_replace('#^storage/#', '', $att->file_path);
            Storage::disk('public')->assertExists($relative);

            // 반환 URL 형식
            $this->assertSame('/file/' . $att->id . '/download', $json['file']['url'], "[$ext] 다운로드 URL 형식 오류");

            // 다운로드 라우트 → 200 + 한글 파일명 Content-Disposition
            $dl = $this->get($json['file']['url']);
            $dl->assertOk();
            $cd = $dl->headers->get('content-disposition');
            $this->assertStringContainsString(
                "filename*=utf-8''" . rawurlencode($koreanName),
                $cd,
                "[$ext] 다운로드 Content-Disposition 에 한글 파일명 누락"
            );
        }
    }

    /** 허용되지 않는 확장자 → 422 + 사유 메시지 */
    public function test_disallowed_extension_is_rejected_with_message(): void
    {
        Storage::fake('public');
        $this->actingAs($this->admin());

        $file = UploadedFile::fake()->create('악성.exe', 10);
        $res = $this->post(route('admin.page-contents.upload-file'), ['file' => $file]);

        $res->assertStatus(422);
        $res->assertJson(['success' => false]);
        $this->assertStringContainsString('허용되지 않는', $res->json('message'));
    }

    /** 용량 초과(60MB) → 422 + 사유 메시지 */
    public function test_oversize_file_is_rejected_with_message(): void
    {
        Storage::fake('public');
        $this->actingAs($this->admin());

        $file = UploadedFile::fake()->create('큰파일.pdf', 60 * 1024); // 60MB
        $res = $this->post(route('admin.page-contents.upload-file'), ['file' => $file]);

        $res->assertStatus(422);
        $this->assertStringContainsString('크기', $res->json('message'));
    }

    /** 부모(attachable) 있는 게시판 첨부는 공개 다운로드 라우트로 노출 금지 */
    public function test_download_route_blocks_parented_attachments(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('attachments/x.hwp', 'dummy');

        $att = Attachment::create([
            'attachable_id' => 1,
            'attachable_type' => 'App\\Models\\Post',
            'file_name' => '게시판첨부.hwp',
            'file_path' => 'storage/attachments/x.hwp',
            'file_size' => 5,
            'mime_type' => 'application/octet-stream',
        ]);

        $this->get('/file/' . $att->id . '/download')->assertNotFound();
    }

    /** 비로그인 사용자는 업로드 접근 불가(로그인 리다이렉트) */
    public function test_guest_cannot_upload(): void
    {
        $file = UploadedFile::fake()->create('a.pdf', 10);
        $res = $this->post(route('admin.page-contents.upload-file'), ['file' => $file]);
        $res->assertRedirect('/admin/login');
    }
}
