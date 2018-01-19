<?php

namespace App;

class BudgetReview extends BaseModel
{
    protected $casts = [
        'before' => 'collection',
        'after' => 'collection',
    ];

    protected $dates = ['reviewed_at'];

    public function item()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_item_id');
    }

    public function getReviewedAtAttribute($reviewed_at)
    {
        return $this->asDate($reviewed_at)->format('d/m/Y');
    }
}
