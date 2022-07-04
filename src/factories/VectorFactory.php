<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 26.06.2022
 * Time: 18:14
 */

namespace app\factories;

use app\valueObjects\Vector;
use JetBrains\PhpStorm\Pure;

/**
 * Фабрика создания вектора
 *
 * Class VectorFactory
 * @package app\factories
 */
class VectorFactory
{
    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Создание вектора
     *
     * @param int $x
     * @param int $y
     * @return Vector
     */
    #[Pure] public static function create(int $x, int $y): Vector
    {
        return new Vector($x, $y);
    }

    /**
     * Сложение векторов
     *
     * @param Vector $first
     * @param Vector $second
     * @return Vector
     */
    #[Pure] public static function sum(Vector $first, Vector $second): Vector
    {
        return self::create(
            $first->x + $second->x,
            $first->y + $second->y,
        );
    }
}
