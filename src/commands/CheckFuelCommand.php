<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 20:00
 */

namespace app\commands;

use app\configs\AppConfig;
use app\contracts\CommandInterface;
use app\contracts\FuelInterface;
use app\exceptions\CommandException;

/**
 * Проверка топлива
 *
 * Class CheckFuelCommand
 * @package app\commands
 */
class CheckFuelCommand implements CommandInterface
{
    /**
     * @param FuelInterface $object
     */
    public function __construct(
        private readonly FuelInterface $object,
    )
    {
    }

    /**
     * @inheritDoc
     * @throws CommandException
     */
    public function execute(): void
    {
        if ($this->hasAvailableFuel() === false) {
            throw new CommandException('Не достаточно топлива');
        }
    }

    /**
     * Запаса топлива хватает
     *
     * @return bool
     */
    private function hasAvailableFuel(): bool
    {
        $object = $this->object;

        return $object->getFuel() >= AppConfig::FUEL_CONSUMPTION;
    }
}
