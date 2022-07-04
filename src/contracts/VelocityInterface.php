<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.07.2022
 * Time: 17:57
 */

namespace app\contracts;

/**
 * Интерфейс объекта с направлением движения
 *
 * Class VelocityInterface
 * @package app\contracts
 */
interface VelocityInterface
{
    /**
     *
     *
     * @param int $velocity
     * @return void
     */
    public function setVelocity(int $velocity): void;

    /**
     *
     *
     * @return bool
     */
    public function isMovable(): bool;
}