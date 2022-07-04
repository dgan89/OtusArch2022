<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 18:54
 */

use app\commands\RotateCommand;
use app\contracts\MovableInterface;
use app\contracts\RotatableInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тестирование поворота
 *
 * Class RotateTest
 */
class RotateTest extends TestCase
{
    /**
     * Удачный повороти объекта
     *
     * @return void
     */
    public function testRotateSuccess(): void
    {
        $rotatableMock = $this
            ->getMockBuilder(RotatableInterface::class)
            ->getMock();

        $rotatableMock
            ->method('getDirection')
            ->willReturnCallback(fn() => 1);
        $rotatableMock->method('getAngularVelocity')
            ->willReturnCallback(fn() => 1);
        $rotatableMock->method('getDirectionsNumber')
            ->willReturnCallback(fn() => 1);

        $rotatableMock
            ->expects($this->once())
            ->method('setDirection')
            ->with($this->equalTo(2));

        $moveCommand = new RotateCommand($rotatableMock);
        $moveCommand->execute();
    }

    /**
     * Поворот у не поворачиваемого объекта
     *
     * @return void
     */
    public function testRotateFailure(): void
    {
        $this->expectError();

        $movableMock = $this
            ->getMockBuilder(MovableInterface::class)
            ->getMock();

        $moveCommand = new MoveCommand($movableMock);
        $moveCommand->execute();
    }
}
