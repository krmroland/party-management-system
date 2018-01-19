<?php

namespace App\Summaries;

use Illuminate\Support\Facades\DB;

class Pledges extends BaseSummary
{
    protected $paid = [];

    protected $balance = [];

    public function getCollection()
    {
        return DB::table('pledges')
        ->groupBy('units')
        ->leftJoin(
            'contributions',
            'contributions.pledge_id',
            'pledges.id'
        )->groupBy('units')
        ->selectRaw('
           sum(pledges.total) as total_pledged,
           sum(contributions.total) as total_paid,
           units,
           count(*) as pledge_count
        ')->get()->groupBy(['units'])->map([$this, 'finalize']);
    }

    public function finalize($item, $key)
    {
        $item = array_first($item);
        $units = title_case(
            'sh' == $item->units
            ? 'Cash'
            : str_plural($item->units)
        );
        $item->units = $units;
        $pledged = (int) $item->total_pledged;
        $paid = (int) $item->total_paid;
        $balance = $pledged - $paid;
        $item->balance = $balance;

        $balance > 0 ? $balance : $balance;

        $this->tableData[] = [
            'units' => $units,
            'paid' => $paid,
            'pledged' => $pledged,
            'balance' => $balance,
        ];
        $this->paid[] = $paid;

        $this->balance[] = $balance;

        return $item;
    }

    public function finishing($data)
    {
        $this
        ->addSummary($data)
        ->addColumnData($data)
        ->addPieData($data);
    }

    protected function addSummary($data)
    {
        $this->summary['pledged'] = $data->sum('total_pledged');
        $this->summary['paid'] = $data->sum('total_paid');
        $this->summary['balance'] = $data->sum('balance');

        return $this;
    }

    protected function addPieData($data)
    {
        $this->charts['pie'] = [
            [
                'y' => $this->summary['balance'],
                'name' => 'Balance',
            ],
            [
                'y' => $this->summary['paid'],
                'name' => 'Paid',
            ],
        ];

        return $this;
    }

    public function addColumnData($data)
    {
        $this->charts['column']['categories'] =
        $data->keyBy('units')->keys();
        $this->charts['column']['yAxis'] = 'Amount in shs';

        foreach (['paid', 'balance'] as $key) {
            $this->charts['column']['series'][] = [
                'name' => title_case($key),
                'data' => $this->{$key},
            ];
        }

        return $this;
    }
}
