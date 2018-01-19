<?php

namespace App\Summaries;

use Illuminate\Support\Facades\DB;

class Cards extends BaseSummary
{
    public function getCollection()
    {
        return DB::table('cards')
        ->groupBy('issued_by')->selectRaw('
            count(*) as total,
            issued_by
        ')->get()->groupBy('issued_by')
        ->map([$this, 'finalize']);
    }

    public function finalize($data)
    {
        $item = array_first($data);
        $this->charts['pie']['series'][] = [
            'y' => (int) $item->total,
            'name' => $item->issued_by,
        ];

        return $item;
    }

    public function finishing($data)
    {
        $this->summary['total'] = $data->sum('total');
    }
}
