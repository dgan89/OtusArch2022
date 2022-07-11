<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.07.2022
 * Time: 17:23
 */

namespace app\contracts;

/**
 *
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