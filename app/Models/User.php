<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'permissions',
        'grade',
        'department',
        'position',
        'company_name',
        'is_member_company',
        'member_company_id',
        'phone_company',
        'phone_mobile',
        'sms_agree',
        'email_agree',
        'ad_agree',
        'zipcode',
        'address',
        'address_detail',
        'join_period',
        'is_active',
        'approval_status',
        'approved_at',
    ];

    /** 가입 승인 상태 */
    public const APPROVAL_STATUSES = [
        'pending' => '승인대기',
        'approved' => '승인',
        'rejected' => '반려',
    ];

    public function approvalLabel(): string
    {
        return self::APPROVAL_STATUSES[$this->approval_status] ?? '-';
    }

    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /** 회원 등급 정의 (정회원/준회원/인터넷회원/특별회원) */
    public const GRADES = [
        'regular'   => '정회원',
        'associate' => '준회원',
        'internet'  => '인터넷회원',
        'special'   => '특별회원',
    ];

    /** 제한 콘텐츠 열람 가능 등급 (인터넷회원 제외 전 등급 + 관리자) */
    public const VIEW_ALL_GRADES = ['regular', 'associate', 'special'];

    public function gradeLabel(): string
    {
        return self::GRADES[$this->grade] ?? ($this->isAdmin() ? '관리자' : '-');
    }

    /** 제한 게시판(논문·CM해외공급·수행사례·교육세미나·전문가칼럼·기획특집·입찰소식) 열람 권한 */
    public function canViewRestricted(): bool
    {
        return $this->isAdmin() || in_array($this->grade, self::VIEW_ALL_GRADES, true);
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'approved_at' => 'datetime',
            'permissions' => 'array',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_member_company' => 'boolean',
            'sms_agree' => 'boolean',
            'email_agree' => 'boolean',
            'ad_agree' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }

    /** 관리자 권한 영역 정의 (계정관리 체크박스 + 라우트 보호 키) */
    public const PERMISSIONS = [
        'posts' => '게시판 관리(협회업무·CM 소개·알림마당·참여마당)',
        'member_companies' => '회원사 관리',
        'members' => '개인회원 관리',
        'home' => '홈 화면 관리(히어로·카드·헤럴드·상단팝업)',
        'banners' => '배너 관리',
        'popups' => '팝업 관리',
        'related_sites' => '관련사이트 관리',
        'online' => '온라인 접수',
        'page_contents' => '페이지 내용 편집',
        'english' => '영문사이트 관리',
        'accounts' => '계정 관리',
    ];

    /**
     * 특정 관리 영역 접근 권한 보유 여부.
     * admin 역할은 항상 전체 허용, editor는 permissions에 포함된 영역만.
     */
    public function hasPermission(string $key): bool
    {
        if ($this->isAdmin()) {
            return true;
        }
        return in_array($key, $this->permissions ?? [], true);
    }
}
