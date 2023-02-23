<?php

namespace App\Models;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;


/**
 * @property mixed $currency_salary
 * @property mixed $status
 */
class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'company_id',
        'job_title',
        'levels',
        'city',
        'status',
        "district",
        "min_salary",
        "max_salary",
        "currency_salary",
        "requirement",
        "start_date",
        "end_date",
        "number_applicants",
        "status",
        "is_pinned",
        "slug",
    ];
//    protected $appends = [
//        'currency_salary_code',
//    ];

    protected static function booted(): void
    {
        static::creating(static function ($object) {
            $object->user_id = 1;
        });
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'job_title'
            ]
        ];
    }


    /**
     * @throws InvalidEnumMemberException
     *
     */
    public function getCurrencySalaryCodeAttribute(): string
    {
        return PostCurrencySalaryEnum::getKey($this->currency_salary);
    }

    /**
     * @throws InvalidEnumMemberException
     */
    public function getStatusNameAttribute(): string
    {
        return PostStatusEnum::getKey($this->status);
    }

}
