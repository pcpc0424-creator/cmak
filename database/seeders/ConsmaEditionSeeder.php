<?php

namespace Database\Seeders;

use App\Models\ConsmaEdition;
use Illuminate\Database\Seeder;

class ConsmaEditionSeeder extends Seeder
{
    public function run(): void
    {
        // 신규 포스터(zip)로 확보된 연도 + 기존 consma.blade의 레거시 상세 링크 매핑
        $legacy = [
            '2025' => '/cmak/legacy/cmak_popup/consma/CONSMA16/intro.html',
            '2023' => '/cmak/legacy/cmak_popup/consma/CONSMA15/intro.html',
            '2020' => '/cmak/legacy/cmak_popup/consma/CONSMA14/intro.html',
            '2019' => '/cmak/legacy/cmak_popup/consma/CONSMA13/intro.html',
            '2018' => '/cmak/legacy/cmak_popup/consma/CONSMA12/intro.html',
            '2017' => '/cmak/legacy/cmak_popup/consma/CONSMA11/intro.html',
            '2016' => '/cmak/legacy/cmak_popup/consma/CONSMA10/intro.html',
            '2014' => '/cmak/legacy/cmak_popup/consma/CONSMA9/intro.html',
            '2013' => '/cmak/legacy/cmak_popup/consma/CONSMA8/intro.html',
            '2012' => '/cmak/legacy/cmak_popup/consma/CONSMA7/intro.html',
            '2011' => '/cmak/legacy/cmak_popup/consma/CONSMA6/intro.html',
            '2010' => '/cmak/legacy/cmak_popup/consma/CONSMA5/index.asp',
            '2009' => '/cmak/legacy/cmak_popup/consma/CONSMA4/index.html',
            '2008' => '/cmak/legacy/cmak_popup/consma/COMSMA3/index.htm',
            '2007' => '/cmak/legacy/cmak_popup/consma/COMSMA3/ConsMa.html',
            '2005' => '/cmak/legacy/cmak_popup/consma/CONSMA1/consma1_data.html',
        ];

        $years = ['2026', '2025', '2024', '2023', '2022', '2021', '2020', '2019', '2018', '2017',
                  '2016', '2015', '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007', '2005'];

        $sort = 0;
        foreach ($years as $year) {
            $thumb = "images/business/consma/posters/thumb_{$year}.jpg";
            $full = "images/business/consma/posters/full_{$year}.jpg";
            if (!file_exists(public_path($thumb))) {
                continue; // 이미지가 없는 연도는 건너뜀
            }
            ConsmaEdition::updateOrCreate(
                ['year' => $year],
                [
                    'thumb_path' => $thumb,
                    'full_path' => $full,
                    'main_text' => "ConsMa {$year}",
                    'sub_text' => null,
                    'detail_url' => $legacy[$year] ?? null,
                    'sort_order' => $sort++,
                    'is_active' => true,
                ]
            );
        }
    }
}
