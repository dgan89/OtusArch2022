<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 20:34
 */

namespace app\factories;

use app\commands\DoubleRepeatCommand;
use app\commands\LogCommand;
use app\commands\RepeatCommand;
use app\contracts\CommandInterface;

/**
 * Фабрика создания команд
 *
 * Class CommandFactory
 * @package app\factories
 */
class CommandFactory
{
    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Команда логирования
     *
     * @param string $message
     * @return CommandInterface
     */
    public static function createLog(string $message): CommandInterface
    {
        return new LogCommand($message);
    }

    /**
     * Команда повторной отправки команды
     *
     * @param CommandInterface $command
     * @return CommandInterface
     */
    public static function createRepeat(CommandInterface $command): CommandInterface
    {
        return new RepeatCommand($command);
    }

    /**
     * Команда повторной отправки команды
     *
     * @param CommandInterface $command
     * @return CommandInterface
     */
    public static function createDoubleRepeat(CommandInterface $command): CommandInterface
    {
        return new DoubleRepeatCommand($command);
    }
}
