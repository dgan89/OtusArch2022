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

/**
 * Уменьшение количество топлива
 *
 * Class BurnFuelCommand
 * @package app\commands
 */
class BurnFuelCommand implements CommandInterface
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
     */
    public function execute(): void
    {
        $object = $this->object;

        $fuelValue = $object->getFuel() - AppConfig::FUEL_CONSUMPTION;
        $object->setFuel($fuelValue);
    }
}
