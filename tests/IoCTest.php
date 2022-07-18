<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 17.07.2022
 * Time: 15:49
 */

use app\IoC;
use PHPUnit\Framework\TestCase;

/**
 * Тест IoC контейнер
 *
 * Class IoCTest
 * @package ${NAMESPACE}
 */
class IoCTest extends TestCase
{
    /**
     * Установка числа
     *
     * @return void
     */
    public function testNumber(): void
    {
        IoC::resolve(IoC::REGISTER, 'number', 100);
        $resolve = IoC::resolve('number');

        $this->assertEquals(100, $resolve);
    }

    /**
     * Установка строки
     *
     * @return void
     */
    public function testString(): void
    {
        IoC::resolve(IoC::REGISTER, 'string', "abc");
        $resolve = IoC::resolve('string');

        $this->assertEquals("abc", $resolve);
    }

    /**
     * Установка объекта
     *
     * @return void
     */
    public function testObject(): void
    {
        $mockObject = $this
            ->getMockBuilder(stdClass::class)
            ->getMock();

        IoC::resolve(IoC::REGISTER, 'mockObject1', $mockObject);
        $resolve = IoC::resolve('mockObject1');

        $this->assertInstanceOf(stdClass::class, $resolve);
    }

    /**
     * Установка вызываемого объекта с параметрами
     *
     * @return void
     */
    public function testCallable(): void
    {
        IoC::resolve(IoC::REGISTER, 'mockObject2', function ($arg1, $arg2) {
            $mockObject = $this
                ->getMockBuilder(stdClass::class)
                ->addMethods(['getArg1', 'getArg2'])
                ->getMock();

            $mockObject
                ->expects($this->once())
                ->method('getArg1')
                ->willReturn($arg1);

            $mockObject
                ->expects($this->once())
                ->method('getArg2')
                ->willReturn($arg2);

            return $mockObject;
        });

        $resolve = IoC::resolve('mockObject2', [100, "abc"]);

        $this->assertInstanceOf(stdClass::class, $resolve);
        $this->assertEquals(100, $resolve->getArg1());
        $this->assertEquals("abc", $resolve->getArg2());
    }

    /**
     * Ошибка если не установлено значение зависимости
     *
     * @return void
     */
    public function testFailure(): void
    {
        $this->expectException(InvalidArgumentException::class);

        IoC::resolve(IoC::REGISTER, 'unknown');
    }

    /**
     * Тестирование scope
     *
     * @return void
     * @throws Throwable
     */
    public function testScope(): void
    {
        IoC::resolve(IoC::REGISTER, 'string', "abc");

        $scopeKey = IoC::resolve(IoC::NEW_SCOPE);
        IoC::resolve(IoC::CURRENT_SCOPE, $scopeKey);

        IoC::resolve(IoC::REGISTER, 'string', "def");
        $resolve = IoC::resolve('string');

        $this->assertEquals("def", $resolve);
    }
}
