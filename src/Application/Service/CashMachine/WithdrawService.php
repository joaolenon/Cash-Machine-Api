<?php

namespace Bank\Application\Service\CashMachine;

use Bank\Domain\CashMachine\CashMachine;

class WithdrawService
{
    /**
     * @var CashMachine
     */
    private $cacheMachine;

    public function __construct(CashMachine $cacheMachine)
    {
        $this->cacheMachine = $cacheMachine;
    }

    /**
     * @param int $value
     */
    public function execute(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException;
        }

        return $this->cacheMachine->withdraw($value);
    }
}
