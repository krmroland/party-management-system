<?php

namespace App\Summaries;

use Illuminate\Support\Facades\DB;

class Budget extends BaseSummary
{
    public function getCollection()
    {
        return DB::table('budget_categories')
                    ->leftJoin(
                        'budget_items',
                        'budget_categories.id',
                        'budget_items.budget_category_id'
                    )
                    ->selectRaw('
                       sum(total) as total_cost,
                       budget_categories.name as category
                    ')
                    ->groupBy('budget_categories.name')
                    ->get()
                    ->groupBy('category')
                    ->map([$this, 'finalize']);
    }

    public function finalize($data)
    {
        $item = array_first($data);
        $category = title_case($item->category);
        $total_cost = (int) $item->total_cost;

        $this->charts['pie']['series'][] = [
            'name' => $category,
            'y' => $total_cost,
        ];
        $this->tableData[] = [
            'category' => $category,
            'total' => $total_cost,
        ];

        return $item;
    }

    public function finishing($data)
    {
        $this->summary['total'] = $data->sum('total_cost');
    }
}
