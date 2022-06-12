<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.06.2022
 * Time: 15:21
 */

namespace app;

use InvalidArgumentException;

/**
 * Решение квадратного уравнения
 * ax2+bx+c=0
 *
 * Class SquareRoot
 * @package app
 */
class SquareRoot
{
    /**
     * @throws InvalidArgumentException
     */
    public function solve(float $a, float $b, float $c): array
    {
        if (NumberHelper::isEqualZero($a) === true) {
            throw new InvalidArgumentException("Параметр $a не должен быть равен 0.");
        }

        $d = $b * $b - 4 * $a * $c;

        if ($d < 0) {
            return [];
        }

        if (NumberHelper::isEqualZero($d) === true) {
            return [
                (-1) * $b / (2 * $a),
                (-1) * $b / (2 * $a),
            ];
        }

        return [
            ((-1) * $b + sqrt($d)) / (2 * $a),
            ((-1) * $b - sqrt($d)) / (2 * $a),
        ];
    }
}
