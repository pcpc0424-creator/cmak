<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 이미 cm_ad 배너가 있으면 중복 시드 방지
        if (DB::table('banners')->where('screen_type', 'cm_ad')->exists()) {
            return;
        }

        $now = now();
        // [title, image, link]  — 기존 하단 광고(CM AD) 17종 그대로 이관
        $ads = [
            ['SHINHWA', 'images/ads/ad_01.jpg', 'http://www.shinhwaeng.com'],
            ['JUNGLIM CM', 'images/ads/ad_02.jpg', 'http://www.junglim.com'],
            ['포스코A&C', 'images/ads/ad_03.jpg', 'https://www.poscoanc.com'],
            ['PCM (해안건축)', 'images/ads/ad_04.jpg', 'http://www.haeahn.com'],
            ['heerim (희림)', 'images/ads/ad_05.jpg', 'https://www.heerim.com'],
            ['SHINHWA', 'images/ads/ad_06.jpg', 'http://www.shinhwaeng.com'],
            ['JUNGLIM CM', 'images/ads/ad_07.jpg', 'http://www.junglim.com'],
            ['포스코A&C', 'images/ads/ad_08.jpg', 'https://www.poscoanc.com'],
            ['PCM (해안건축)', 'images/ads/ad_09.jpg', 'http://www.haeahn.com'],
            ['heerim (희림)', 'images/ads/ad_10.jpg', 'https://www.heerim.com'],
            ['KUNWON (건원엔지니어링)', 'images/ads/ad_11.jpg', null],
            ['THE M', 'images/ads/ad_12.jpg', null],
            ['MOOYOUNG CM (무영씨엠)', 'images/ads/ad_13.jpg', null],
            ['SAMOO C.M. (삼우씨엠)', 'images/ads/ad_14.jpg', null],
            ['JEONIN CM (전인CM)', 'images/ads/ad_15.jpg', null],
            ['TOMOON (토문)', 'images/ads/ad_16.jpg', null],
            ['TOPEC', 'images/ads/ad_17.jpg', null],
        ];

        $rows = [];
        foreach ($ads as $i => $ad) {
            $rows[] = [
                'screen_type' => 'cm_ad',
                'title' => $ad[0],
                'image_path' => $ad[1],
                'link_url' => $ad[2],
                'link_target' => '_blank',
                'is_active' => true,
                'sort_order' => $i + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('banners')->insert($rows);
    }

    public function down(): void
    {
        DB::table('banners')->where('screen_type', 'cm_ad')->delete();
    }
};
