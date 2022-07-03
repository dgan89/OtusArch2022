<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 26.06.2022
 * Time: 17:23
 */

namespace app\valueObjects;

use JetBrains\PhpStorm\Pure;

/**
 * Вектор
 *
 * Class Vector
 * @package app\valueObjects
 */
class Vector
{
    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(
        public readonly int $x,
        public readonly int $y,
    )
    {
    }
}
