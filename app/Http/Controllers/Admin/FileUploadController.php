<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    /** 허용 확장자 (소문자) */
    protected array $allowedExtensions = [
        'hwp', 'hwpx', 'pdf', 'doc', 'docx', 'xls', 'xlsx',
        'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'zip', 'txt', 'csv',
    ];

    /** 최대 파일 크기 (KB) — 서버(php/nginx) 50M 한도와 정합 */
    protected int $maxKilobytes = 51200; // 50MB

    /**
     * 에디터 첨부파일 AJAX 업로드.
     * 성공: { success:true, file:{id,name,size,url} }
     * 실패: { success:false, message:"..." } + 적절한 HTTP 상태코드
     */
    public function upload(Request $request)
    {
        // 1) 파일 존재 여부 (php.ini 한도 초과 시 file 이 비어 여기서 걸림)
        if (!$request->hasFile('file')) {
            return response()->json([
                'success' => false,
                'message' => '파일이 전송되지 않았습니다. 파일 크기가 서버 허용 용량(50MB)을 초과했을 수 있습니다.',
            ], 422);
        }

        $file = $request->file('file');

        // 2) 업로드 자체 오류 (부분 전송 등)
        if (!$file->isValid()) {
            return response()->json([
                'success' => false,
                'message' => '파일 업로드에 실패했습니다. (' . $file->getErrorMessage() . ')',
            ], 422);
        }

        // 3) 확장자 검증 (hwp 등은 MIME 추정이 불안정하므로 확장자 기준으로 검사)
        $ext = strtolower($file->getClientOriginalExtension());
        if (!in_array($ext, $this->allowedExtensions, true)) {
            return response()->json([
                'success' => false,
                'message' => "허용되지 않는 파일 형식입니다. (." . $ext . ") 허용: " . implode(', ', $this->allowedExtensions),
            ], 422);
        }

        // 4) 크기 검증
        if ($file->getSize() > $this->maxKilobytes * 1024) {
            return response()->json([
                'success' => false,
                'message' => '파일 크기가 너무 큽니다. 최대 ' . round($this->maxKilobytes / 1024) . 'MB 까지 업로드할 수 있습니다.',
            ], 422);
        }

        // 5) 저장 (public 디스크 → 웹 접근 가능, 기존 게시판 첨부와 동일 컨벤션)
        try {
            $date = now()->format('Y/m/d');
            $path = $file->store("uploads/{$date}", 'public'); // storage/app/public/uploads/... 반환값: uploads/...
            if ($path === false) {
                return response()->json([
                    'success' => false,
                    'message' => '서버에 파일을 저장하지 못했습니다. 저장 경로 권한을 확인해주세요.',
                ], 500);
            }

            $attachment = Attachment::create([
                'attachable_id' => null,
                'attachable_type' => null,
                'file_name' => $file->getClientOriginalName(), // 한글 원본 파일명 보존
                'file_path' => 'storage/' . $path,             // 예: storage/uploads/2026/07/14/xxxx.hwp
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        } catch (\Throwable $e) {
            Log::error('첨부파일 업로드 실패', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => '서버 오류로 업로드에 실패했습니다. 잠시 후 다시 시도해주세요.',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'file' => [
                'id' => $attachment->id,
                'name' => $attachment->file_name,
                'size' => $attachment->file_size,
                // 원본(한글) 파일명으로 다운로드되도록 다운로드 라우트 경유. 프론트에서 /cmak 프리픽스 부착.
                'url' => '/file/' . $attachment->id . '/download',
            ],
        ]);
    }

    /**
     * 에디터 단독 업로드 첨부 공개 다운로드 (원본 한글 파일명 유지).
     * 부모(attachable)가 있는 게시판 첨부는 이 라우트로 노출하지 않는다(보안).
     */
    public function download(Attachment $attachment)
    {
        abort_unless($attachment->attachable_id === null, 404);

        $relative = preg_replace('#^storage/#', '', $attachment->file_path);
        if (!Storage::disk('public')->exists($relative)) {
            abort(404, '파일을 찾을 수 없습니다.');
        }

        return Storage::disk('public')->download($relative, $attachment->file_name);
    }

    public function delete(Attachment $attachment)
    {
        $relative = preg_replace('#^storage/#', '', $attachment->file_path);
        Storage::disk('public')->delete($relative);
        $attachment->delete();

        return response()->json([
            'success' => true,
            'message' => '파일이 삭제되었습니다.',
        ]);
    }
}
