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
use app\handlers\RepeatErrorHandler;
use PHPUnit\Framework\TestCase;

/**
 * Тест обработчика ошибок
 *
 * Class CommandHandlerTest
 */
class RepeatHandlerTest extends TestCase
{
    /**
     * Тест повторителя команды
     *
     * @return void
     */
    public function testRepeatCommandErrorHandler(): void
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
            ]);

        $queueMock
            ->expects($this->exactly(2))
            ->method('addCommand')
            ->withConsecutive(
                [new RepeatCommand($commandErrorMock)],
                [new LogCommand("Test")],
            );

        foreach ($queueMock->make() as $command) {
            try {
                $command->execute();
            } catch (Throwable $exception) {
                (new RepeatErrorHandler($command, $exception, $queueMock))->handle();
            }
        }
    }
}
