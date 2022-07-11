<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.07.2022
 * Time: 17:02
 */

namespace app\contracts;

/**
 * Очередь команд
 *
 * Class QueueCommandInterface
 * @package app\contracts
 */
interface QueueCommandInterface
{
    /**
     * Получить команды
     *
     * @return CommandInterface[]
     */
    public function make(): array;

    /**
     * Добавить команду
     *
     * @param CommandInterface $command
     * @return void
     */
    public function addCommand(CommandInterface $command): void;
}