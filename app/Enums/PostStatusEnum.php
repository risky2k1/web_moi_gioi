<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostStatusEnum extends Enum
{
    public const PENDING = 0;
    public const ADMIN_PENDING = 1;
    public const ADMIN_APPROVED = 2;
}
