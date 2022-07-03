<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 26.06.2022
 * Time: 16:31
 */

namespace app\contracts;

use app\valueObjects\Vector;

/**
 * Интерфейс движущегося объекта
 *
 * Class MovableInterface
 * @package app\contracts
 */
interface MovableInterface
{
    /**
     * Получение позиции объекта
     *
     * @return Vector
     */
    public function getPosition(): Vector;

    /**
     * Установка позиции
     *
     * @param Vector $position
     * @return void
     */
    public function setPosition(Vector $position): void;

    /**
     * Скорость
     *
     * @return Vector
     */
    public function getVelocity(): Vector;
}