<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends BaseModel
{
    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }

    /**
     * get all budegt categories with all their items
     *
     * @return     Collection All.
     */
    public static function getAll()
    {
        return static::latest("created_at")->with(["items"=>function ($query) {
            $query->latest("name");
        }])->get();
    }

    /**
     * Sets the name attribute.
     *
     * @param      string  $name   The name
     */
    public function getNameAttribute($name)
    {
        return title_case($name);
    }
}
