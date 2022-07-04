<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.07.2022
 * Time: 16:45
 */

use app\commands\BurnFuelCommand;
use app\configs\AppConfig;
use app\contracts\FuelInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование уменьшение количество топлива
 *
 * Class BurnFuelTest
 * @package ${NAMESPACE}
 */
class BurnFuelTest extends TestCase
{
    /**
     * Проверка уменьшения топлива
     *
     * @return void
     */
    public function testBurnSuccess(): void
    {
        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $fuelMock
            ->method('getFuel')
            ->willReturnCallback(fn() => AppConfig::FUEL_CONSUMPTION + 5);

        $fuelMock
            ->expects($this->once())
            ->method('setFuel')
            ->with(5);

        $moveCommand = new BurnFuelCommand($fuelMock);
        $moveCommand->execute();
    }
}
