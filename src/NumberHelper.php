<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 12.06.2022
 * Time: 13:44
 */

namespace app;

/**
 * Хелпер чисел
 *
 * Class NumberHelper
 * @package app
 */
class NumberHelper
{
    /** @var float  */
    const EPSILON = 1e-7;

    /**
     * Сравнение числа типа float с 0
     *
     * @param float $value
     * @return bool
     */
    public static function isEqualZero(float $value): bool
    {
        return abs($value) < self::EPSILON;
    }
}
