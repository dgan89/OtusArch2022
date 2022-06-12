<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.06.2022
 * Time: 15:06
 */

namespace tests;

use app\SquareRoot;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;

/**
 * Тест решения квадратного уравнения
 *
 * Class SquareRootTest
 * @package tests
 */
class SquareRootTest extends TestCase
{
    /**
     * Корней нет
     *
     * @return void
     * @throws Exception
     */
    public function testShouldBeEmpty()
    {
        $squareRoot = new SquareRoot();
        $result = $squareRoot->solve(1, 0, 1);

        $this->assertEmpty($result);
    }

    /**
     * Есть два корня кратности 1
     *
     * @return void
     * @throws Exception
     */
    public function testShouldHasTwoRoots()
    {
        $squareRoot = new SquareRoot();
        $result = $squareRoot->solve(1, 0, -1);

        $this->assertCount(2, $result);
        $this->assertContainsEquals(1, $result);
        $this->assertContainsEquals(-1, $result);
    }

    /**
     * Есть один корень кратности 2
     *
     * @return void
     * @throws Exception
     */
    public function testShouldHasOneRoot()
    {
        $squareRoot = new SquareRoot();
        $result = $squareRoot->solve(1, -2, 1);
        list ($root1, $root2) = $result + [null, null];

        $this->assertCount(2, $result);
        $this->assertContainsEquals(1, $result);
        $this->assertThat($root1, $this->equalTo($root2));
    }

    /**
     * Коэффициент $a не может быть равен 0
     *
     * @return void
     * @throws Exception
     */
    public function testIsNotZero()
    {
        $this->expectException(InvalidArgumentException::class);

        $squareRoot = new SquareRoot();
        $squareRoot->solve(0.0, 1, 1);
    }

    /**
     * Есть один корень кратности 2 и дискриминантом близким к 0
     *
     * @return void
     * @throws Exception
     */
    public function testDiscriminantIsZero()
    {
        $squareRoot = new SquareRoot();
        $result = $squareRoot->solve(0.0000001, 0.0000002, 0.0000001);
        list ($root1, $root2) = $result + [null, null];

        $this->assertCount(2, $result);
        $this->assertContainsEquals(-1, $result);
        $this->assertThat($root1, $this->equalTo($root2));
    }

    /**
     * Параметры должны быть числами
     *
     * @return void
     * @throws Exception
     */
    public function testParamsShouldNumbers()
    {
        $this->expectException(TypeError::class);

        $squareRoot = new SquareRoot();
        $squareRoot->solve("a", "b", "c");
    }
}
