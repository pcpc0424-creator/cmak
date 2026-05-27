@if(isset($sites) && $sites->count() > 0)
    <table style="width:100%; border-collapse:collapse; margin-top:16px;">
        <thead>
            <tr style="background:#f0f4fa; border-top:2px solid #064277;">
                <th style="padding:12px 16px; font-size:13px; font-weight:600; color:#333; text-align:center; border-bottom:1px solid #dde3ed; width:60px;">번호</th>
                <th style="padding:12px 16px; font-size:13px; font-weight:600; color:#333; text-align:left; border-bottom:1px solid #dde3ed;">기관명</th>
                <th style="padding:12px 16px; font-size:13px; font-weight:600; color:#333; text-align:left; border-bottom:1px solid #dde3ed;">홈페이지</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $index => $site)
                <tr style="border-bottom:1px solid #e8ecf1;">
                    <td style="padding:11px 16px; font-size:13px; color:#888; text-align:center;">{{ $index + 1 }}</td>
                    <td style="padding:11px 16px; font-size:14px; color:#333; font-weight:500;">{{ $site->site_name }}</td>
                    <td style="padding:11px 16px; font-size:13px;">
                        <a href="{{ $site->site_url }}" target="_blank" rel="noopener noreferrer" style="color:#0061c2; text-decoration:none;">
                            {{ $site->site_url }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="margin-top:12px; font-size:12px; color:#999;">총 {{ $sites->count() }}개 기관</p>
@else
    <div class="sub-info-box" style="text-align:center; padding:30px;">
        <p style="color:#999; font-size:14px;">등록된 기관이 없습니다.</p>
    </div>
@endif
