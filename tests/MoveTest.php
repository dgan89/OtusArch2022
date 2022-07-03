<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 26.06.2022
 * Time: 18:40
 */

use app\commands\MoveCommand;
use app\contracts\MovableInterface;
use app\contracts\RotatableInterface;
use app\factories\VectorFactory;
use PHPUnit\Framework\TestCase;

/**
 * Тест движения объекта
 *
 * Class MoveTest
 */
class MoveTest extends TestCase
{
    /**
     * Удачное изменение положения объекта
     *
     * @return void
     */
    public function testMoveSuccess(): void
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

        $movableMock
            ->expects($this->once())
            ->method('setPosition')
            ->with(
                VectorFactory::create(5, 8),
            );

        $moveCommand = new MoveCommand($movableMock);
        $moveCommand->execute();
    }

    /**
     * Тест без указания положения
     *
     * @return void
     */
    public function testWithEmptyPosition(): void
    {
        $this->expectError();

        $movableMock = $this
            ->getMockBuilder(MovableInterface::class)
            ->getMock();

        $moveCommand = new MoveCommand($movableMock);
        $moveCommand->execute();
    }

    /**
     * Тест без указания скорости
     *
     * @return void
     */
    public function testWithEmptyVelocity(): void
    {
        $this->expectError();

        $movableMock = $this
            ->getMockBuilder(MovableInterface::class)
            ->getMock();

        $movableMock
            ->method('getPosition')
            ->willReturnCallback(fn() => VectorFactory::create(12, 5));

        $moveCommand = new MoveCommand($movableMock);
        $moveCommand->execute();
    }

    /**
     * Изменение положения у не движущегося объекта
     *
     * @return void
     */
    public function testMoveFailure(): void
    {
        $this->expectError();

        $movableMock = $this
            ->getMockBuilder(RotatableInterface::class)
            ->getMock();

        $moveCommand = new MoveCommand($movableMock);
        $moveCommand->execute();
    }
}
