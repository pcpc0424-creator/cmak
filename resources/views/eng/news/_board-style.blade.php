@push('styles')
<style>
.eng-board { margin-top: 18px; border-top: 2px solid #0a3d7c; }
.eng-board-row { display: flex; align-items: center; gap: 16px; padding: 14px 12px; border-bottom: 1px solid #eef1f5; text-decoration: none; color: #333; transition: background 0.15s; }
.eng-board-row:hover { background: #f6f9fd; }
.eng-board-no { flex-shrink: 0; width: 40px; text-align: center; font-size: 13px; color: #999; }
.eng-board-thumb { flex-shrink: 0; width: 54px; height: 54px; object-fit: cover; border-radius: 8px; border: 1px solid #e8ecf1; background: #f0f4fa; }
.eng-board-main { flex: 1; min-width: 0; }
.eng-board-title { font-size: 14.5px; font-weight: 600; color: #1a1a1a; line-height: 1.5; }
.eng-board-row:hover .eng-board-title { color: #0061c2; }
.eng-board-badge { flex-shrink: 0; display: inline-block; padding: 3px 9px; font-size: 10.5px; font-weight: 700; border-radius: 5px; background: #eaf1fb; color: #0061c2; letter-spacing: 0.5px; }
.eng-board-badge.pdf { background: #fdecec; color: #d23b3b; }
.eng-board-badge.doc { background: #eaf1fb; color: #2b579a; }
.eng-board-date { flex-shrink: 0; width: 96px; text-align: right; font-size: 13px; color: #999; }
.eng-board-count { color: #666; font-size: 14px; margin-bottom: 4px; }
@media (max-width: 700px) {
    .eng-board-no { display: none; }
    .eng-board-date { width: auto; font-size: 12px; }
    .eng-board-thumb { width: 42px; height: 42px; }
}
</style>
@endpush
