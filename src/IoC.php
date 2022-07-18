<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 17.07.2022
 * Time: 15:17
 */

namespace app;

use InvalidArgumentException;

/**
 * IoC контейнер
 *
 * Class IoC
 * @package app
 */
class IoC
{
    /** @var string */
    public const REGISTER = "IoC.Register";

    /** @var string */
    public const NEW_SCOPE = "Scopes.New";

    /** @var string */
    public const CURRENT_SCOPE = "Scopes.Current";

    /** @var string */
    private const ROOT_SCOPE = "ROOT";

    /**
     * Текущий scope
     *
     * @var string
     */
    private static string $currentScope = self::ROOT_SCOPE;

    /**
     * Массив объявленных scopes
     *
     * @var array
     */
    private static array $scopes = [
        self::ROOT_SCOPE => [],
    ];

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Разрешение зависимости
     *
     * @param string $name
     * @param mixed|null $key
     * @param mixed|null $params
     * @return mixed
     */
    public static function resolve(string $name, mixed $key = null, mixed $params = null): mixed
    {
        return match ($name) {
            self::REGISTER => self::register($key, $params),
            self::NEW_SCOPE => self::newScope(),
            self::CURRENT_SCOPE => self::setScope($key),
            default => self::get($name, $key),
        };
    }

    /**
     * Регистрация зависимости
     *
     * @param string $key
     * @param callable|object $params
     * @return null
     */
    private static function register(string $key, mixed $params)
    {
        if (
            is_null($params) === true ||
            empty($params) === true
        ) {
            throw new InvalidArgumentException("Параметры зависимости не могут быть пустыми");
        }

        if (array_key_exists($key, self::$scopes[self::$currentScope]) === true) {
            return null;
        }

        self::$scopes[self::$currentScope][$key] = $params;

        return null;
    }

    /**
     * Получение зависимости
     *
     * @param string $key
     * @param mixed $params
     * @return mixed|null
     */
    private static function get(string $key, mixed $params): mixed
    {
        if (array_key_exists($key, self::$scopes[self::$currentScope]) === false) {
            return null;
        }

        $value = self::$scopes[self::$currentScope][$key];

        if (is_callable($value) === true) {
            if (is_array($params) === false) {
                $params = [$params];
            }

            return call_user_func_array($value, $params);
        }

        return $value;
    }

    /**
     * Создание нового scope
     *
     * @return string
     */
    private static function newScope(): string
    {
        $scopeKey = "scope_" . getmypid();
        self::$scopes[$scopeKey] = [];

        return $scopeKey;
    }

    /**
     * Установка текущего scope
     *
     * @param string $key
     * @return null
     */
    private static function setScope(string $key)
    {
        self::$currentScope = $key;

        return null;
    }
}
