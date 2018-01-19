<?php

namespace App;

class Provider extends BaseModel
{
    /**
     * append the following attributes on json serialization.
     *
     * @var array
     */
    protected $appends = ['paid', 'exactAmount', 'balance'];

    /**
     * a providers provider a budget item.
     *
     * @return App\BudgetItem
     */
    public function item()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_item_id');
    }

    /**
     * a provider can be paid many times.
     *
     * @return App\Expenditure
     */
    public function payments()
    {
        return $this->hasMany(Expenditure::class);
    }

    /**
     * Gets the paid attribute.
     *
     * @return int
     */
    public function getPaidAttribute()
    {
        return (int) optional($this->payments)->sum('amount');
    }

    public function getExactAmountAttribute()
    {
        return (int) optional($this->item)->total;
    }

    public function getBalanceAttribute()
    {
        return -$this->exactAmount + $this->paid;
    }

    public function pay($data)
    {
        $data['description'] = $this->paymentDescription();

        return $this->payments()->create($data);
    }

    protected function paymentDescription()
    {
        $nthtime = Ordinal::make($this->payments()->count() + 1);
        $name = $this->item->name;

        return "$nthtime Payment for ($name)";
    }

    public function delete()
    {
        optional($this->payments)->each->delete();
        parent::delete();
    }

    public static function getAll()
    {
        return static::with(['payments', 'item'])->latest('name')->oldest('name')->get();
    }
}
