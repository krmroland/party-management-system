<?php

namespace App;

class BudgetCategory extends BaseModel
{
    /**
     * a budget category has many items.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(BudgetItem::class);
    }

    /**
     * get all budegt categories with all their items.
     *
     * @return Illuminate\Support\Collection all
     */
    public static function getAll()
    {
        return static::latest('created_at')->with(['items' => function ($query) {
            $query->latest('name')->with(['reviews' => function ($query) {
                return $query->latest('reviewed_at');
            }, 'provider']);
        }])->get()->keyBy('id');
    }

    /**
     * Sets the name attribute.
     *
     * @param string $name The name
     */
    public function getNameAttribute($name)
    {
        return title_case($name);
    }

    public function delete()
    {
        $this->items->each->delete();
        parent::delete();
    }
}
