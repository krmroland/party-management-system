<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * turn off mass assignment exceptions.
     *
     * @var array
     */
    protected $guarded = [];
}
