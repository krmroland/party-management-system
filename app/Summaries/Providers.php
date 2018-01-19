<?php

namespace App\Summaries;

use Illuminate\Support\Facades\DB;

class Providers extends BaseSummary
{
    /**
     * collect all the debts together.
     *
     * @var array
     */
    protected $debt = [];
    /**
     * collect the paid the attributes together.
     *
     * @var array
     */
    protected $paid = [];
    /**
     * protected string.
     *
     * @var array
     */
    protected $date = [];

    /**
     * Gets the collection.
     *
     * @return Illuminate\Database\Eloquent\Collection collection
     */
    public function getCollection()
    {
        return DB::table('providers')->leftJoin(
            'expenditures',
            'expenditures.provider_id',
            'providers.id'
        )->leftJoin(
            'budget_items',
            'budget_items.id',
            'providers.id'
        )->groupBy('providers.name')
        ->selectRaw('
            sum(amount) as total_paid,
            providers.name as provider_name,
            sum(budget_items.total) as total_amount,
            budget_items.type
        ')->get()->map([$this, 'finalize'])->keyBy('provider_name');
    }

    public function finalize($provider)
    {
        $provider->type = str_plural(title_case($provider->type));
        $this->addDebt($provider);
        $this->paid[] = (int) $provider->total_paid;
        $this->debt[] = (int) $provider->debt;
        $this->tableData[] = $provider;

        return $provider;
    }

    public function addDebt($provider)
    {
        $provider->debt = -$provider->total_paid + $provider->total_amount;
    }

    public function finishing($data)
    {
        $this->addColumnData($data)->addPieData($data);
        $this->summary['paid'] = array_sum($this->paid);
        $this->summary['debt'] = array_sum($this->debt);
        $this->summary['count'] = $data->groupBy('type')
        ->map(function ($item) {
            return count($item);
        });
    }

    protected function addPieData($data)
    {
        $this->charts['pie'] = [
            [
                'y' => (int) $data->sum('total_paid'),
                'name' => 'Paid',
            ],
            [
                'y' => (int) $data->sum('debt'),
                'name' => 'Debts',
            ],
        ];

        return $this;
    }

    /**
     * Adds a column data.
     *
     * @param Illuminate\Database\Eloquent\Collection $data The data
     *
     * @return self
     */
    public function addColumnData($data)
    {
        $this->charts['column']['categories'] =
        $data->keys();
        $this->charts['column']['yAxis'] = 'Amount in shs';

        foreach (['paid', 'debt'] as $key) {
            $this->charts['column']['series'][] = [
                'name' => title_case($key),
                'data' => $this->{$key},
            ];
        }

        return $this;
    }
}
