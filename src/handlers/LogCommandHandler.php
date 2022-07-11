<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:36
 */

namespace app\handlers;

use app\contracts\QueueCommandInterface;
use app\factories\CommandFactory;
use Throwable;

/**
 * Логирование ошибки
 *
 * Class PushCommandHandler
 * @package app\handlers
 */
class LogCommandHandler
{
    /**
     * @param Throwable $exception
     * @param QueueCommandInterface $queue
     */
    public function __construct(
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
        $exception = $this->exception;
        $queue = $this->queue;

        $logCommand = CommandFactory::createLog($exception->getMessage());
        $queue->addCommand($logCommand);
    }
}
