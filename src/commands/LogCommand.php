<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:24
 */

namespace app\commands;

use app\contracts\CommandInterface;

/**
 * Команда логирования
 *
 * Class LogCommand
 * @package app\commands
 */
class LogCommand implements CommandInterface
{
    /**
     * @param string $message
     */
    public function __construct(
        private readonly string $message,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        error_log($this->message);
    }
}
