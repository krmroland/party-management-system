<?php

namespace App;

trait SetsTotal
{
    public static function bootSetsTotal()
    {
        static::creating(function ($model) {
            $model->total = $model->unitCost * $model->qty;
        });
    }
}
