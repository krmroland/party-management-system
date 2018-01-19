<?php

namespace App;

class Ordinal
{
    /**
     * The number being converted.
     */
    protected $number;
    /**
     * The lookup dictionary.
     *
     * @var array
     */
    protected $dict = [
        1 => 'st',
        2 => 'nd',
        3 => 'rd',
    ];

    /**
     * make an instance.
     *
     * @param string $number
     *
     * @return string
     */
    public static function make($number)
    {
        return (new static())($number);
    }

    /**
     * invoke the class as a functioj.
     *
     * @param int $number
     *
     * @return string
     */
    public function __invoke(int $number)
    {
        $lastDigit = $this->calculateLastDigit($number);

        return $number.$this->ordinal($lastDigit);
    }

    /**
     * Calculates the last digit.
     *
     * @param int $number The number
     *
     * @return bool|int the last digit
     */
    protected function calculateLastDigit($number)
    {
        if ($number < 10) {
            return $number;
        }

        return ($number > 10 && $number <= 20) ? $number : $number % 10;
    }

    /**
     * determine the ordinal appends.
     *
     * @param number $number
     *
     * @return string
     */
    protected function ordinal($number)
    {
        return (isset($this->dict[$number]))
        ? $this->dict[$number]
        : 'th';
    }
}
