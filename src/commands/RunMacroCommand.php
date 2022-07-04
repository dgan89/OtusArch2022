<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 03.07.2022
 * Time: 20:03
 */

namespace app\commands;

use app\contracts\CommandInterface;
use app\exceptions\CommandException;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Throwable;

/**
 * Выполнение команд
 *
 * Class RunMacroCommand
 * @package app\commands
 */
class RunMacroCommand implements CommandInterface
{
    /**
     * @param CommandInterface[] $commands
     * @throws AssertionFailedException
     */
    public function __construct(
        private readonly array $commands,
    )
    {
        $this->validateCommands();
    }

    /**
     * @inheritDoc
     * @throws CommandException
     */
    public function execute(): void
    {
        try {
            $this->run();
        } catch (Throwable $exception) {
            throw new CommandException(
                message: $exception->getMessage(),
                previous: $exception,
            );
        }
    }

    /**
     *
     *
     * @return void
     */
    private function run(): void
    {
        $commands = $this->commands;

        foreach ($commands as $command) {
            $command->execute();
        }
    }

    /**
     * Валидация команд
     *
     * @return void
     * @throws AssertionFailedException
     */
    private function validateCommands(): void
    {
        Assertion::notEmpty($this->commands);
        Assertion::allIsInstanceOf($this->commands, CommandInterface::class);
    }
}
