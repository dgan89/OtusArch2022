<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.07.2022
 * Time: 16:50
 */

use app\commands\BurnFuelCommand;
use app\commands\CheckFuelCommand;
use app\commands\MoveCommand;
use app\commands\RunMacroCommand;
use app\configs\AppConfig;
use app\contracts\FuelInterface;
use app\contracts\MovableInterface;
use app\exceptions\CommandException;
use app\factories\VectorFactory;
use Assert\AssertionFailedException;
use PHPUnit\Framework\TestCase;

/**
 * Тест макрокоманды движения
 *
 * Class MoveMacroTest
 */
class MoveMacroTest extends TestCase
{
    /**
     * Проверка типа команды
     *
     * @return void
     * @throws AssertionFailedException
     * @throws CommandException
     */
    public function testCommandTypeFailed(): void
    {
        $this->expectException(AssertionFailedException::class);

        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $commands = [
            new AppConfig(),
            new CheckFuelCommand($fuelMock),
            new BurnFuelCommand($fuelMock),
        ];

        $runCommand = new RunMacroCommand($commands);
        $runCommand->execute();
    }

    /**
     * Тест успешного движения по прямой
     *
     * @throws CommandException
     * @throws AssertionFailedException
     */
    public function testMovingStraightLineSuccess()
    {
        $movableMock = $this
            ->getMockBuilder(MovableInterface::class)
            ->getMock();

        $movableMock
            ->method('getPosition')
            ->willReturnCallback(fn() => VectorFactory::create(12, 5));

        $movableMock
            ->method('getVelocity')
            ->willReturnCallback(fn() => VectorFactory::create(-7, 3));

        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $fuelMock
            ->method('getFuel')
            ->willReturnCallback(fn() => AppConfig::FUEL_CONSUMPTION + 5);

        $movableMock
            ->expects($this->once())
            ->method('setPosition')
            ->with(
                VectorFactory::create(5, 8),
            );

        $fuelMock
            ->expects($this->once())
            ->method('setFuel')
            ->with(5);

        $commands = [
            new CheckFuelCommand($fuelMock),
            new MoveCommand($movableMock),
            new BurnFuelCommand($fuelMock),
        ];

        $runCommand = new RunMacroCommand($commands);
        $runCommand->execute();
    }

    /**
     * Тест неудачного движения по прямой
     *
     * @throws CommandException
     * @throws AssertionFailedException
     */
    public function testMovingStraightLineFailure()
    {
        $this->expectException(CommandException::class);

        $movableMock = $this
            ->getMockBuilder(MovableInterface::class)
            ->getMock();

        $fuelMock = $this
            ->getMockBuilder(FuelInterface::class)
            ->getMock();

        $fuelMock
            ->method('getFuel')
            ->willReturnCallback(fn() => AppConfig::FUEL_CONSUMPTION - 5);

        $commands = [
            new CheckFuelCommand($fuelMock),
            new MoveCommand($movableMock),
            new BurnFuelCommand($fuelMock),
        ];

        $runCommand = new RunMacroCommand($commands);
        $runCommand->execute();
    }
}
