<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 18:47
 */

namespace app\commands;

use app\contracts\RotatableInterface;

/**
 * Поворот объекта
 *
 * Class RotateCommand
 * @package app\commands
 */
class RotateCommand
{
    /**
     * @param RotatableInterface $rotatable
     */
    public function __construct(
        private readonly RotatableInterface $rotatable,
    )
    {
    }

    /**
     * Выполнение
     *
     * @return void
     */
    public function execute(): void
    {
        $rotatable = $this->rotatable;

        $direction = $rotatable->getDirection() + $rotatable->getAngularVelocity();
        $direction = $direction / $rotatable->getDirectionsNumber();

        $rotatable->setDirection($direction);
    }
}
