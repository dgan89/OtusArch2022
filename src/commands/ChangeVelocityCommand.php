<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.07.2022
 * Time: 17:09
 */

namespace app\commands;

use app\contracts\CommandInterface;
use app\contracts\VelocityInterface;

/**
 * Изменение вектора мгновенной скорости
 *
 * Class ChangeVelocityCommand
 * @package app\commands
 */
class ChangeVelocityCommand implements CommandInterface
{
    /**
     * @param VelocityInterface $velocity
     * @param int $value
     */
    public function __construct(
        private readonly VelocityInterface $velocity,
        private readonly int               $value,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $velocity = $this->velocity;
        $value = $this->value;

        if ($velocity->isMovable() === true) {
            $velocity->setVelocity($value);
        }
    }
}
