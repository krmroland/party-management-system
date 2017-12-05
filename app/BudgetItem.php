<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
	/**
	 * cats these items to primitive types
	 *
	 * @var        array
	 */
    protected $casts=["remarks"=>'collection'];

    /**
     * An item on the budget belongs to a category
     *
     * @return     BelongsTo  
     */

    public function categories()
    {
    	 return $this->belongsTo(BudgetCategory::class);
    }
}
