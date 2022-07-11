<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 20:41
 */

use app\commands\LogCommand;
use app\commands\RepeatCommand;
use app\contracts\CommandInterface;
use app\contracts\QueueCommandInterface;
use app\handlers\LogCommandHandler;
use app\handlers\RepeatCommandHandler;
use PHPUnit\Framework\TestCase;

/**
 * Тест обработчика ошибок
 *
 * Class CommandHandlersTest
 */
class CommandHandlersTest extends TestCase
{
    /**
     * Тест обработчика логирования
     *
     * @return void
     */
    public function testLogHandler(): void
    {
        $queueMock = $this
            ->getMockBuilder(QueueCommandInterface::class)
            ->getMock();

        $queueMock
            ->expects($this->once())
            ->method('addCommand')
            ->with(new LogCommand("Test"));

        $handler = new LogCommandHandler(new Exception('Test'), $queueMock);
        $handler->handle();
    }

    /**
     * Тест обработчика повторителя команды
     *
     * @return void
     */
    public function testRepeatHandler(): void
    {
        $commandMock = $this
            ->getMockBuilder(CommandInterface::class)
            ->getMock();

        $queueMock = $this
            ->getMockBuilder(QueueCommandInterface::class)
            ->getMock();

        $queueMock
            ->expects($this->once())
            ->method('addCommand')
            ->with(new RepeatCommand($commandMock));

        $handler = new RepeatCommandHandler($commandMock, $queueMock);
        $handler->handle();
    }
}
