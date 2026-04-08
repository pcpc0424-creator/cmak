<?php

use App\Models\EnglishContent;

if (!function_exists('eng_page')) {
    /**
     * Fetch an English page record by slug. Returns null if not found.
     * Used by /eng/* blade templates to read editable content from DB,
     * with hardcoded fallback values inside the template.
     */
    function eng_page(string $slug): ?EnglishContent
    {
        static $cache = [];
        if (!array_key_exists($slug, $cache)) {
            try {
                $cache[$slug] = EnglishContent::bySlug($slug);
            } catch (\Throwable $e) {
                $cache[$slug] = null;
            }
        }
        return $cache[$slug];
    }
}

if (!function_exists('eng_value')) {
    /**
     * Helper: return DB field value for an English page if present, else fallback.
     */
    function eng_value(?string $slug, string $field, $fallback = '')
    {
        if ($slug === null) return $fallback;
        $page = eng_page($slug);
        if (!$page) return $fallback;
        $val = $page->{$field} ?? null;
        return ($val === null || $val === '') ? $fallback : $val;
    }
}
