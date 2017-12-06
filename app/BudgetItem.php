<?php

namespace App;

class BudgetItem extends BaseModel
{
    /**
     * cats these items to primitive types
     *
     * @var        array
     */
    protected $casts=["remarks"=>'collection','isCovered'=>'Boolean'];

    /**
     * An item on the budget belongs to a category
     *
     * @return     BelongsTo
     */

    public function categories()
    {
        return $this->belongsTo(BudgetCategory::class);
    }

    /**
     * Sets the name attribute.
     *
     * @param      string  $name
     */
    public function getNameAttribute($name)
    {
        return title_case($name);
    }
}
