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
        'grade',
        'department',
        'position',
        'phone_company',
        'phone_mobile',
        'sms_agree',
        'email_agree',
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
            'password' => 'hashed',
            'is_active' => 'boolean',
            'sms_agree' => 'boolean',
            'email_agree' => 'boolean',
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
}
