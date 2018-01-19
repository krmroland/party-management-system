<?php

namespace App;

class Contribution extends BaseModel
{
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($builder) {
            $builder->latest('date');
        });
    }

    public function pledge()
    {
        return $this->belongsTo(Pledge::class);
    }
}
