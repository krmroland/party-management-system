<?php

namespace App;

class Summary
{
    protected static $summaries = [
      'budget' => \App\Summaries\Budget::class,
       'providers' => \App\Summaries\Providers::class,
       'cards' => \App\Summaries\Cards::class,
       'expenditures' => \App\Summaries\Expenditures::class,
       'pledges' => \App\Summaries\Pledges::class,
    ];

    public static function all()
    {
        return collect(static::$summaries)
        ->map(function ($summary) {
            return  app($summary);
        });
    }

    public static function pdf()
    {
        return [
            'budget' => BudgetCategory::latest('created_at')->with('items')->get(),
            'budget_total' => number_format(BudgetItem::getTotal()),
            'pledges' => Pledge::getAll(),
            'providers' => Provider::getAll(),
            'expenditures' => Expenditure::getAll(),
            'cards' => Card::getAll(),
        ];
    }
}
