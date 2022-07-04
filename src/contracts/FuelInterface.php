<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 20:28
 */

namespace app\contracts;

/**
 * Объект имеет топливо
 *
 * Class FuelInterface
 * @package app\contracts
 */
interface FuelInterface
{
    /**
     * Получение запаса топлива
     *
     * @return int
     */
    public function getFuel(): int;

    /**
     * Установка запаса топлива
     *
     * @param int $fuel
     * @return void
     */
    public function setFuel(int $fuel): void;
}