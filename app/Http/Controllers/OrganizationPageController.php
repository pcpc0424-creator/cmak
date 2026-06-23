<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Support\Facades\View;

class OrganizationPageController extends Controller
{
    /**
     * 조직 및 구성 4개 탭. URL 토큰 => [슬러그, 라벨].
     */
    public const TABS = [
        'chart'      => ['slug' => 'org-chart',      'label' => '기구표'],
        'executives' => ['slug' => 'org-executives', 'label' => '집행부'],
        'branches'   => ['slug' => 'org-branches',   'label' => '지회'],
        'committees' => ['slug' => 'org-committees',  'label' => '위원회'],
    ];

    /**
     * 조직 및 구성 페이지를 DB(page_contents)에서 불러와 탭과 함께 렌더링한다.
     * DB에 게시된 내용이 없으면(기구표 탭) 기존 정적 블레이드로 자동 폴백한다.
     */
    public function show(string $tab = 'chart')
    {
        if (!array_key_exists($tab, self::TABS)) {
            abort(404);
        }

        $page = PageContent::bySlug(self::TABS[$tab]['slug']);

        if (!$page) {
            // 폴백: 시딩 전이거나 미게시면 기존 정적 조직도 페이지로
            if ($tab === 'chart' && View::exists('intro.organization')) {
                return view('intro.organization');
            }
            abort(404);
        }

        return view('intro.organization-dynamic', [
            'page'      => $page,
            'tabs'      => self::TABS,
            'activeTab' => $tab,
        ]);
    }
}
