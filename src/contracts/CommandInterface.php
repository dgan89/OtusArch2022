<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 20:01
 */

namespace app\contracts;

/**
 * Команда
 *
 * Class CommandInterface
 * @package app\contracts
 */
interface CommandInterface
{
    /**
     * Выполнение команды
     *
     * @return void
     */
    public function execute(): void;
}