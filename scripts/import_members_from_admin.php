<?php
/**
 * 구관리자(cmak.or.kr/admin) 회원사 엑셀(기업회원현황) 181개를 member_companies 에 반영.
 * 소스: scripts/data/member_admin_181.csv
 *   컬럼: NO.,코드,가입일,구분,지회,조회Key,회사명,대표자,전화번호,FAX,주소,홈페이지
 *
 * - 기존 활성 회원사는 모두 is_active=0 으로 비활성화(보존, 복구 가능)
 * - 181개를 신규 INSERT (region=주소기반 시/도, branch=지회, member_code=코드, joined_at=가입일)
 *
 * 실행: php /var/www/cmak/scripts/import_members_from_admin.php
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$CSV = __DIR__ . '/data/member_admin_181.csv';

/** 주소에서 시/도 추출 (기존 replace_members_with_original.php 와 동일 규칙) */
function extractRegion(string $address): string {
    static $mapping = [
        '서울'=>'서울','부산'=>'부산','대구'=>'대구','인천'=>'인천','광주'=>'광주',
        '대전'=>'대전','울산'=>'울산','세종'=>'세종','경기'=>'경기','강원'=>'강원',
        '충북'=>'충북','충남'=>'충남','전북'=>'전북','전남'=>'전남','경북'=>'경북',
        '경남'=>'경남','제주'=>'제주',
        '서울특별시'=>'서울','부산광역시'=>'부산','대구광역시'=>'대구','인천광역시'=>'인천',
        '광주광역시'=>'광주','대전광역시'=>'대전','울산광역시'=>'울산','세종특별자치시'=>'세종',
        '경기도'=>'경기','강원도'=>'강원','강원특별자치도'=>'강원','충청북도'=>'충북',
        '충청남도'=>'충남','전라북도'=>'전북','전북특별자치도'=>'전북','전라남도'=>'전남',
        '경상북도'=>'경북','경상남도'=>'경남','제주특별자치도'=>'제주','제주도'=>'제주',
    ];
    $clean = preg_replace('/^\(\d+\)\s*/', '', trim($address));
    $first = preg_split('/\s+/', $clean)[0] ?? '';
    return $mapping[$first] ?? '';
}

function nn($v) { $v = trim((string)$v); return $v === '' || $v === '-' ? null : $v; }

// === 1단계: CSV 파싱 ===
echo "[1/3] CSV 파싱 중...\n";
if (!is_file($CSV)) { fwrite(STDERR, "CSV 없음: $CSV\n"); exit(1); }
$fh = fopen($CSV, 'r');
$header = fgetcsv($fh);
// UTF-8 BOM 제거
if ($header && isset($header[0])) $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
$rows = [];
while (($r = fgetcsv($fh)) !== false) {
    if (count($r) < 11) continue;
    // 0:NO 1:코드 2:가입일 3:구분 4:지회 5:조회Key 6:회사명 7:대표자 8:전화 9:FAX 10:주소 11:홈페이지
    $company = nn($r[6] ?? '');
    if ($company === null) continue;
    $type = trim($r[3] ?? '');
    $address = nn($r[10] ?? '');
    $rows[] = [
        'no'             => (int)($r[0] ?? 0),
        'member_code'    => nn($r[1] ?? ''),
        'joined_at'      => nn($r[2] ?? ''),
        'company_type'   => in_array($type, ['용역','시공'], true) ? $type : null,
        'branch'         => nn($r[4] ?? ''),
        'company_name'   => $company,
        'representative' => nn($r[7] ?? ''),
        'phone'          => nn($r[8] ?? ''),
        'fax'            => nn($r[9] ?? ''),
        'address'        => $address,
        'website'        => nn($r[11] ?? ''),
        'region'         => $address ? extractRegion($address) : '',
    ];
}
fclose($fh);
echo "  - 파싱: " . count($rows) . "건\n\n";

if (count($rows) < 100) { fwrite(STDERR, "파싱 건수 비정상(" . count($rows) . "). 중단.\n"); exit(1); }

// === 2단계: 기존 활성 비활성화 ===
echo "[2/3] 기존 활성 회원사 비활성화(보존) 중...\n";
$beforeActive = DB::table('member_companies')->where('is_active', 1)->count();
DB::table('member_companies')->where('is_active', 1)->update(['is_active' => 0]);
echo "  - 기존 활성 {$beforeActive}건 → 비활성화\n\n";

// === 3단계: 181개 신규 INSERT ===
echo "[3/3] 관리자 회원사 신규 등록 중...\n";
$now = date('Y-m-d H:i:s');
$inserted = 0;
DB::transaction(function () use ($rows, $now, &$inserted) {
    foreach ($rows as $m) {
        DB::table('member_companies')->insert([
            'company_name'   => $m['company_name'],
            'region'         => $m['region'] ?: null,
            'branch'         => $m['branch'],
            'member_code'    => $m['member_code'],
            'joined_at'      => $m['joined_at'],
            'company_type'   => $m['company_type'],
            'representative' => $m['representative'],
            'phone'          => $m['phone'],
            'fax'            => $m['fax'],
            'address'        => $m['address'],
            'website'        => $m['website'],
            'is_active'      => 1,
            'is_verified'    => 1,
            'is_integrated'  => 0,
            'sort_order'     => $m['no'],
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
        $inserted++;
    }
});
echo "  - 신규 등록: {$inserted}건\n\n";

// === 결과 ===
echo "=== 결과 ===\n";
echo "활성 회원사: " . DB::table('member_companies')->where('is_active',1)->count() . "건\n";
echo "비활성 회원사: " . DB::table('member_companies')->where('is_active',0)->count() . "건\n";
$hasFax = DB::table('member_companies')->where('is_active',1)->whereNotNull('fax')->where('fax','!=','')->count();
$hasWeb = DB::table('member_companies')->where('is_active',1)->whereNotNull('website')->where('website','!=','')->count();
echo "FAX 채워진: {$hasFax}건 / 홈페이지 채워진: {$hasWeb}건\n";
echo "\n업종:\n";
foreach (DB::table('member_companies')->where('is_active',1)->select('company_type', DB::raw('count(*) as c'))->groupBy('company_type')->orderByDesc('c')->get() as $r) {
    echo "  · " . ($r->company_type ?: '(없음)') . ": {$r->c}\n";
}
echo "\n지회:\n";
foreach (DB::table('member_companies')->where('is_active',1)->select('branch', DB::raw('count(*) as c'))->groupBy('branch')->orderByDesc('c')->get() as $r) {
    echo "  · " . ($r->branch ?: '(없음)') . ": {$r->c}\n";
}
echo "\n지역(시/도):\n";
foreach (DB::table('member_companies')->where('is_active',1)->select('region', DB::raw('count(*) as c'))->whereNotNull('region')->where('region','!=','')->groupBy('region')->orderByDesc('c')->get() as $r) {
    echo "  · {$r->region}: {$r->c}\n";
}
