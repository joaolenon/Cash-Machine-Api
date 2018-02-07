<?php

namespace CashMachine\Application;

use CashMachine\Domain\CashMachine;

/**
 * Class WithdrawService
 * @package CashMachine\Application
 */
class WithdrawService
{
    /**
     * @var CashMachine
     */
    private $cacheMachine;

    /**
     * WithdrawService constructor.
     * @param CashMachine $cacheMachine
     */
    public function __construct(CashMachine $cacheMachine)
    {
        $this->cacheMachine = $cacheMachine;
    }

    /**
     * @param $value
     * @return array
     * @throws \CashMachine\Domain\NoteUnavailableException|\InvalidArgumentException
     */
    public function execute($value): array
    {
        return $this->cacheMachine->withdraw($value);
    }
}
