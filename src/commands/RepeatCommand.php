<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:43
 */

namespace app\commands;

use app\contracts\CommandInterface;

/**
 * Повторное выполнение команды
 *
 * Class RepeatCommand
 * @package app\commands
 */
class RepeatCommand implements CommandInterface
{
    /**
     * @param CommandInterface $command
     */
    public function __construct(
        private readonly CommandInterface $command,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this
            ->command
            ->execute();
    }
}
