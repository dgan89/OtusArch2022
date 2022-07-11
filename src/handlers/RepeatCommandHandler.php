<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:55
 */

namespace app\handlers;

use app\commands\RepeatCommand;
use app\contracts\CommandInterface;
use app\contracts\QueueCommandInterface;
use app\factories\CommandFactory;

/**
 * Повторная отправка команды в очередь
 *
 * Class RepeatCommandHandler
 * @package app\handlers
 */
class RepeatCommandHandler
{
    /**
     * @param CommandInterface $command
     * @param QueueCommandInterface $queue
     */
    public function __construct(
        private readonly CommandInterface      $command,
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
        $queue = $this->queue;

        $repeatCommand = match ($command::class) {
            RepeatCommand::class => CommandFactory::createDoubleRepeat($command),
            default => CommandFactory::createRepeat($command),
        };

        $queue->addCommand($repeatCommand);
    }
}
