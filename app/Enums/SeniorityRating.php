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

    /**
     * Get array of arrays
     *
     * @return array
     */
    public static function getArrayOfArrays()
    {
        $formattedArray = [];
        $questionTypes = self::asSelectArray();

        if (count($questionTypes)) {
            foreach ($questionTypes as $key => $value) {
                $formattedArray[$key] = $value;
            }
        }

        return $formattedArray;
    }
}
