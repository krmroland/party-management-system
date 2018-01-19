<?php

namespace App;

trait PledgeAtrributes
{
    /**
     * Gets the paid total attribute.
     *
     * @return int the paid total attribute
     */
    public function getPaidTotalAttribute()
    {
        return optional($this->contributions)->sum('total');
    }

    /**
     * Gets the balance total attribute.
     *
     * @return int the balance total attribute
     */
    public function getBalanceTotalAttribute()
    {
        return $this->total - $this->paidTotal;
    }

    /**
     * Gets the paid qty attribute.
     *
     * @return int
     */
    public function getPaidQtyAttribute()
    {
        return optional($this->contributions)->sum('qty');
    }

    /**
     * Gets the balance qty attribute.
     *
     * @return int
     */
    public function getBalanceQtyAttribute()
    {
        return $this->qty - $this->paidQty;
    }

    /**
     * Gets the raw paid attribute.
     *
     * @return string
     */
    public function getRawPaidAttribute()
    {
        return $this->pluralize($this->paidQty, $this->paidTotal);
    }

    /**
     * Gets the raw balance attribute.
     *
     * @return string
     */
    public function getRawBalanceAttribute()
    {
        return $this->pluralize($this->balanceQty, $this->balanceTotal);
    }

    /**
     * Gets the raw pledged attribute.
     *
     * @return string
     */
    public function getRawPledgedAttribute()
    {
        return $this->pluralize($this->qty, $this->total);
    }

    /**
     * pluralize a give amount in base units.
     *
     * @param int $amount
     *
     * @return string
     */
    protected function pluralize($amount, $monetary = null)
    {
        $rawAmout = number_format($amount);

        return $this->isCash
              ? "$rawAmout shs"
              : vsprintf('%s %s (%s/=)', [
                $rawAmout,
                str_plural($this->units, $amount),
                number_format($monetary),
              ]);
    }
}
