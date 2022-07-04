<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.07.2022
 * Time: 18:13
 */

use app\commands\ChangeVelocityCommand;
use app\contracts\VelocityInterface;
use PHPUnit\Framework\TestCase;

/**
 * Тест изменения вектора скорости
 *
 * Class ChangeVelocityTest
 */
class ChangeVelocityTest extends TestCase
{
    /**
     * Проверка у движущегося объекта
     *
     * @return void
     */
    public function testCanMovable(): void
    {
        $velocityMock = $this
            ->getMockBuilder(VelocityInterface::class)
            ->getMock();

        $velocityMock
            ->method('isMovable')
            ->willReturn(true);

        $velocityMock
            ->expects($this->once())
            ->method('setVelocity')
            ->with(10);

        $velocityCommand = new ChangeVelocityCommand($velocityMock, 10);
        $velocityCommand->execute();
    }

    /**
     * Проверка у неподвижного объекта
     *
     * @return void
     */
    public function testCanUnMovable(): void
    {
        $velocityMock = $this
            ->getMockBuilder(VelocityInterface::class)
            ->getMock();

        $velocityMock
            ->method('isMovable')
            ->willReturn(false);

        $velocityMock
            ->expects($this->never())
            ->method('setVelocity');

        $velocityCommand = new ChangeVelocityCommand($velocityMock, 10);
        $velocityCommand->execute();
    }
}
