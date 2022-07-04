<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 20:35
 */

use app\commands\CheckFuelCommand;
use app\configs\AppConfig;
use app\contracts\FuelInterface;
use app\exceptions\CommandException;
use PHPUnit\Framework\TestCase;

/**
 * Тест проверки топлива
 *
 * Class CheckFuelTest
 * @package ${NAMESPACE}
 */
class CheckFuelTest extends TestCase
{
    /**
     * Топлива хватает
     *
     * @return void
     */
    public function testCheckSuccess(): void
    {
        $exception = null;

        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $fuelMock
            ->method('getFuel')
            ->willReturnCallback(fn() => AppConfig::FUEL_CONSUMPTION + 5);

        try {
            $moveCommand = new CheckFuelCommand($fuelMock);
            $moveCommand->execute();
        } catch (CommandException $exception) {
        }

        $this->assertNull($exception);
    }

    /**
     * Топлива не хватает
     *
     * @return void
     */
    public function testCheckFailure(): void
    {
        $this->expectException(CommandException::class);

        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $fuelMock
            ->method('getFuel')
            ->willReturnCallback(fn() => AppConfig::FUEL_CONSUMPTION - 5);

        $moveCommand = new CheckFuelCommand($fuelMock);
        $moveCommand->execute();
    }
}
