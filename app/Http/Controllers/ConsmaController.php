<?php

namespace App\Http\Controllers;

use App\Models\ConsmaEdition;

class ConsmaController extends Controller
{
    /** ConsMa 연도별 포스터 썸네일 목록 */
    public function index()
    {
        $editions = ConsmaEdition::active()
            ->orderBy('sort_order')->orderBy('id')
            ->get();

        return view('business.consma', compact('editions'));
    }

    /** 개별 연도 상세 페이지 */
    public function show(string $year)
    {
        $edition = ConsmaEdition::active()->where('year', $year)->firstOrFail();

        return view('business.consma-detail', compact('edition'));
    }
}
