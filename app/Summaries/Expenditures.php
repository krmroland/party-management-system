<?php

namespace App\Summaries;

use Illuminate\Support\Facades\DB;

class Expenditures extends BaseSummary
{
    protected $total = 0;
    /**
     * turn off the summary.
     *
     * @var bool
     */
    protected $hasSummary = false;

    public function getCollection()
    {
        return  DB::table('expenditures')
        ->leftJoin('budget_items', 'budget_items.id', 'expenditures.budget_item_id')
        ->selectRaw('
          sum(amount) as total_spent,
          count(*) as total_count,
          budget_items.type
        ')
        ->groupBy('budget_items.type')
        ->get()->groupBy('type')->map([$this, 'finalize'])->keyBy('type');
    }

    public function finalize($items)
    {
        $value = array_first($items);

        $value->type ?: $value->type = 'miscellaneous';

        $value->label = str_plural(title_case($value->type));

        $this->charts['pie'][] = [
            'name' => $value->label,
            'y' => (int) $value->total_spent,
        ];
        $this->tableData[] = [
            'total' => $value->total_spent,
            'item_count' => $value->total_count,
            'label' => $value->label,
        ];
        $this->total += $value->total_spent;

        return $value;
    }

    public function finishing($data)
    {
        $data['total'] = $this->total;

        return $data;
    }
}
