<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 26.06.2022
 * Time: 16:32
 */

namespace app\commands;

use app\contracts\MovableInterface;
use app\factories\VectorFactory;

/**
 * Команда движения объекта
 *
 * Class MoveCommand
 * @package app\commands
 */
class MoveCommand
{
    /**
     * @param MovableInterface $movable
     */
    public function __construct(
        private readonly MovableInterface $movable,
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
        $movable = $this->movable;

        $newPosition = VectorFactory::sum(
            $movable->getPosition(),
            $movable->getVelocity(),
        );
        $movable->setPosition($newPosition);
    }
}
