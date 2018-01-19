<?php

namespace App;

class Expenditure extends BaseModel
{
    /**
     * cast the following fields to dates.
     *
     * @var array
     */
    protected $dates = ['date'];

    /**
     * Gets the date attribute.
     *
     * @param string $date
     *
     * @return string
     */
    public function getDateAttribute($date)
    {
        return $this->asDate($date)->format('d/m/Y');
    }

    public static function getAll()
    {
        return static::latest('date')->get();
    }
}
