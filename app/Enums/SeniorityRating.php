<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SeniorityRating extends Enum
{
    const Junior = 1;
    const Intermediate = 2;
    const Expert = 3;
}
