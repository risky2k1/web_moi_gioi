<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static updateOrCreate(array $array, array $array1)
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @property mixed $gender
 * @property mixed $role
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @throws InvalidEnumMemberException
     */
    public function getRoleNameAttribute(): string
    {
        return UserRoleEnum::getKey($this->role);
    }

    public function getGenderNameAttribute(): string
    {
        return $this->gender==0 ? 'Nam' : 'Nữ';
    }
}
