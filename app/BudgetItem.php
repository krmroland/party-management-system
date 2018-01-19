<?php

namespace App;

class BudgetItem extends BaseModel
{
    /**
     * Gets the total.
     *
     * @return int the total
     */
    public static function getTotal()
    {
        return static::sum('total');
    }

    /**
     * cats these items to primitive types.
     *
     * @var array
     */
    protected $casts = ['remarks' => 'collection', 'isCovered' => 'Boolean'];

    /**
     * An item on the budget belongs to a category.
     *
     * @return BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo(BudgetCategory::class);
    }

    /**
     * Sets the name attribute.
     *
     * @param string $name
     */
    public function getNameAttribute($name)
    {
        return title_case($name);
    }

    /**
     * A budget Item can be reviwed multiple times.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(BudgetReview::class);
    }

    /**
     * Review a budget item.
     *
     * @param array $data
     */
    public function review($data)
    {
        $this->fill(array_only($data, ['total', 'unitCost', 'qtyUnits', 'qty']));

        $after = $this->getDirty();

        $before = array_intersect_key($this->fresh()->toArray(), $after);

        $this->reviews()->create([
            'reviewed_at' => $data['reviewed_at'],
            'description' => $data['description'],
            'before' => $before,
            'after' => $after,
        ]);

        $this->save();
    }

    /**
     * A budget item has one and only one provider.
     *
     * @return HasOne
     */
    public function provider()
    {
        return $this->hasOne(Provider::class);
    }

    /**
     * add a provider for a given item.
     *
     * @param array $data The data
     */
    public function addProvider($data)
    {
        $this->provider
        ? $this->provider->update($data)
        : $this->provider()->create($data);
    }

    /**
     * delete this item from database.
     *
     * @return bool
     */
    public function delete()
    {
        !$this->provider ?: $this->provider->delete();

        return parent::delete();
    }
}
