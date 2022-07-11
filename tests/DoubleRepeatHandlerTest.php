<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 20:41
 */

use app\commands\DoubleRepeatCommand;
use app\commands\LogCommand;
use app\commands\RepeatCommand;
use app\contracts\CommandInterface;
use app\contracts\QueueCommandInterface;
use app\handlers\DoubleRepeatErrorHandler;
use PHPUnit\Framework\TestCase;

/**
 * Тест обработчика ошибок
 *
 * Class DoubleRepeatHandlerTest
 */
class DoubleRepeatHandlerTest extends TestCase
{
    /**
     * Тест двойного повторителя команды
     *
     * @return void
     */
    public function testDoubleRepeatCommandErrorHandler(): void
    {
        $commandErrorMock = $this
            ->getMockBuilder(CommandInterface::class)
            ->getMock();
        $commandErrorMock
            ->method('execute')
            ->willThrowException(new Exception("Test"));

        $queueMock = $this
            ->getMockBuilder(QueueCommandInterface::class)
            ->getMock();
        $queueMock
            ->method('make')
            ->willReturn([
                $commandErrorMock,
                new RepeatCommand($commandErrorMock),
                new DoubleRepeatCommand(new RepeatCommand($commandErrorMock)),
            ]);

        $queueMock
            ->expects($this->exactly(3))
            ->method('addCommand')
            ->withConsecutive(
                [new RepeatCommand($commandErrorMock)],
                [new DoubleRepeatCommand(new RepeatCommand($commandErrorMock))],
                [new LogCommand("Test")],
            );

        foreach ($queueMock->make() as $command) {
            try {
                $command->execute();
            } catch (Throwable $exception) {
                (new DoubleRepeatErrorHandler($command, $exception, $queueMock))->handle();
            }
        }
    }
}
