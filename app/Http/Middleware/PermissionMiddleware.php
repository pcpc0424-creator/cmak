<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * 관리 영역별 세분 권한 검사. 라우트에 permission:<key> 형태로 적용.
 * admin 역할은 전체 통과, editor는 해당 권한 보유 시에만 통과.
 * (AdminMiddleware 통과 이후 적용되는 것을 전제)
 */
class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = auth()->user();

        if (!$user || !$user->hasPermission($permission)) {
            abort(403, '이 기능에 대한 접근 권한이 없습니다.');
        }

        return $next($request);
    }
}
