<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 18:42
 */

namespace app\contracts;

/**
 * Интерфейс поворота объекта
 *
 * Class RotatableInterface
 * @package app\contracts
 */
interface RotatableInterface
{
    /**
     *
     *
     * @return int
     */
    public function getDirection(): int;

    /**
     *
     *
     * @return int
     */
    public function getAngularVelocity(): int;

    /**
     *
     *
     * @param int $direction
     * @return void
     */
    public function setDirection(int $direction): void;

    /**
     *
     *
     * @return int
     */
    public function getDirectionsNumber(): int;
}