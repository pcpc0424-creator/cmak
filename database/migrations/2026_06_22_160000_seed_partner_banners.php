<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('banners')->where('screen_type', 'partner')->exists()) {
            return;
        }

        $now = now();
        // [name, image, link] — 기존 관련기관 롤링 배너 그대로 이관
        $partners = [
            ['CMAK YouTube', 'images/banners/partners/cmak_youtube.jpg', 'https://www.youtube.com/channel/UCcVZEpnpnFrPzG73IvT_48Q'],
            ['정책브리핑', 'images/banners/partners/korea_policy.jpg', 'https://www.korea.kr'],
            ['기획재정부', 'images/banners/partners/moef.jpg', 'https://www.moef.go.kr'],
            ['국토교통부', 'images/banners/partners/molit.jpg', 'http://www.molit.go.kr'],
            ['나라장터', 'images/banners/partners/g2b.jpg', 'https://www.g2b.go.kr'],
            ['정부24', 'images/banners/partners/gov24.jpg', 'https://www.gov.kr'],
        ];

        $rows = [];
        foreach ($partners as $i => $p) {
            $rows[] = [
                'screen_type' => 'partner',
                'title' => $p[0],
                'image_path' => $p[1],
                'link_url' => $p[2],
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
        DB::table('banners')->where('screen_type', 'partner')->delete();
    }
};
