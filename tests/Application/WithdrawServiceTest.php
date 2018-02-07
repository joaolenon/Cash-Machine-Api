<?php

namespace CashMachine\Tests\Application;

use CashMachine\Application\WithdrawService;
use CashMachine\Domain\CashMachine;
use PHPUnit\Framework\TestCase;

class WithdrawServiceTest extends TestCase
{
    public function testExecute()
    {
        $cacheMachine = new WithdrawService(new CashMachine());
        $notes = $cacheMachine->execute(100);

        $this->assertInternalType('array', $notes);
    }
}
