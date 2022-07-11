<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:31
 */

namespace app\handlers;

use app\commands\RepeatCommand;
use app\contracts\CommandInterface;
use app\contracts\QueueCommandInterface;
use Throwable;

/**
 * Обработчик ошибок команд
 *
 * Class CommandErrorHandler
 * @package app\handlers
 */
class RepeatErrorHandler
{
    /**
     * @param CommandInterface $command
     * @param Throwable $exception
     * @param QueueCommandInterface $queue
     */
    public function __construct(
        private readonly CommandInterface      $command,
        private readonly Throwable             $exception,
        private readonly QueueCommandInterface $queue,
    )
    {
    }

    /**
     *
     *
     * @return void
     */
    public function handle(): void
    {
        $command = $this->command;
        $exception = $this->exception;
        $queue = $this->queue;

        match ($command::class) {
            RepeatCommand::class => (new LogCommandHandler($exception, $queue))->handle(),
            default => (new RepeatCommandHandler($command, $queue))->handle(),
        };
    }
}
