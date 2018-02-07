<?php

namespace CashMachine\Tests\Domain;

use CashMachine\Domain\CashMachine;
use PHPUnit\Framework\TestCase;

class CashMachineTest extends TestCase
{
    /**
     * @dataProvider withdrawProvider
     */
    public function testWithdraw($input, $expected)
    {
        $cacheMachine = new CashMachine();
        $this->assertEquals($expected, $cacheMachine->withdraw($input));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWithdrawUsingANegativeNumber()
    {
        $cacheMachine = new CashMachine();
        $cacheMachine->withdraw(-1);
    }

    /**
     * @dataProvider notMultiplesOfTen
     * @expectedException \CashMachine\Domain\NoteUnavailableException
     */
    public function testWithdrawUsingNumberNotMultipleOfTen($value)
    {
        $cacheMachine = new CashMachine();
        $cacheMachine->withdraw($value);
    }

    public function notMultiplesOfTen()
    {
        return [
            [1],
            [11],
            [22],
            [233],
            [344],
            [455],
            [566],
            [677],
            [788],
            [899],
            [988],
            [1099],
        ];
    }

    public function withdrawProvider()
    {
        return [
            [30, [20, 10]],
            [80, [50, 20, 10]],
            [260, [100, 100, 50, 10]],
            [350, [100, 100, 100, 50]],
        ];
    }

    public function tearDown()
    {
        $this->cashMachine = null;
    }
}
