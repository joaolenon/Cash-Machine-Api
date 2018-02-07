<?php

namespace CashMachine\Domain;

/**
 * Class CashMachine
 * @package CashMachine\Domain
 */
class CashMachine
{
    const AVAILABLE_NOTES = [100, 50, 20, 10];

    /**
     * @param int $value
     * @return array
     * @throws NoteUnavailableException
     */
    public function withdraw(int $value): array
    {
        if ($value < 0) {
            throw new \InvalidArgumentException;
        }

        if ($value % 10) {
            throw new NoteUnavailableException;
        }

        return $this->countNotes($value);
    }

    /**
     * @param int $value
     * @return array
     */
    private function countNotes(int $value): array
    {
        $notes = [];

        foreach (self::AVAILABLE_NOTES as $note) {
            if ($note > $value) {
                continue;
            }

            $numberOfNotes = floor($value / $note);
            $value -= $note * $numberOfNotes;

            $notes = array_merge($notes, array_fill(0, $numberOfNotes, $note));
        }

        return $notes;
    }
}
