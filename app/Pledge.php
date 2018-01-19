<?php

namespace App;

class Pledge extends BaseModel
{
    use PledgeAtrributes,SetsTotal;
    /**
     * casts the following fields to native types.
     *
     * @var array
     */
    protected $casts = ['isCash' => 'boolean'];
    /**
     * append the following fields to an array.
     *
     * @var array
     */
    protected $appends = [
      'rawPaid',
      'rawBalance',
      'rawPledged',
    ];

    /**
     * initialize a pledge instance.
     *
     * @param array $paid
     *
     * @return self
     */
    public static function initialize($data)
    {
        return static::Create(
            array_except($data, ['paid', 'rawValue'])
        )->process($data);
    }

    public function process($data)
    {
        if ($paid = $data['paid']) {
            $this->saveContribution($paid, $this->date);
        }

        return $this;
    }

    protected function saveContribution($paid, $date)
    {
        $paid = intval($paid);
        $total = $paid * $this->unitCost;
        $this->contributions()->create([
            'date' => $date,
            'qty' => $paid,
            'total' => $total,
            'rawValue' => $this->pluralize($paid, $total),
        ]);
    }

    /**
     * A Pledge has very many contributions.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    /**
     * get all contributions.
     *
     * @return all
     */
    public static function getAll()
    {
        $data = static::with('contributions')->latest('date')->get();

        return collect([
                'items' => $data,
                'pledgedTotal' => $data->sum('total'),
                'paidTotal' => $data->sum('paidTotal'),
                'balanceTotal' => $data->sum('balanceTotal'),
        ]);
    }

    /**
     * Gets the paid attribute.
     *
     * @return int
     */
    public function getPaidAttribute()
    {
        return $this->contributions->sum('total');
    }

    public function getBalanceDescriptionAttribute()
    {
        return $this->describe($this->balance, $this->monetaryBalance);
    }

    protected function pluralizeUnits($amount)
    {
        return  number_format($amount).' '.str_plural($this->units, $amount);
    }

    public function setUnitsAttribute($units)
    {
        $this->attributes['units'] = str_singular($units);
    }

    public function delete()
    {
        optional($this->contributions->each)->delete();

        parent::delete();
    }

    public function addContribution($data)
    {
        $this->saveContribution($data['paid'], $data['date']);
    }

    public function getDateAttribute($date)
    {
        return $this->asDate($date)->format('d/m/Y');
    }
}
