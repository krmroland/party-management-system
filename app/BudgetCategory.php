<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetCategory extends BaseModel
{
    /**
     * a budget category has many items
     *
     * @return     Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }

    /**
     * get all budegt categories with all their items
     *
     * @return     Illuminate\Support\Collection All.
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
