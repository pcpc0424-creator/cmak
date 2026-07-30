<?php

namespace App\Http\Controllers;

use App\Models\PageContent;

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
     *
     * '이 페이지를 사이트에 게시'를 해제한 탭은 탭 바에서도 감춘다. 예전에는 기구표 탭을
     * 해제하면 미완성 정적 조직도(intro.organization)가 대신 노출되고 탭이 통째로
     * 사라졌는데, 게시 해제가 '구버전 노출'로 동작하는 셈이라 폐지했다.
     */
    public function show(string $tab = 'chart')
    {
        if (!array_key_exists($tab, self::TABS)) {
            abort(404);
        }

        $tabs = array_filter(
            self::TABS,
            fn($meta) => PageContent::bySlug($meta['slug']) !== null
        );

        // 4개 탭을 모두 게시 해제하면 이 메뉴 자체가 보여줄 내용이 없다
        if (!$tabs) {
            abort(404);
        }

        // 게시 해제된 탭으로 직접 들어오면 남아 있는 첫 탭으로 보낸다
        if (!isset($tabs[$tab])) {
            $first = array_key_first($tabs);

            return redirect('/intro/organization' . ($first === 'chart' ? '' : '/' . $first));
        }

        return view('intro.organization-dynamic', [
            'page'      => PageContent::bySlug(self::TABS[$tab]['slug']),
            'tabs'      => $tabs,
            'activeTab' => $tab,
        ]);
    }
}
