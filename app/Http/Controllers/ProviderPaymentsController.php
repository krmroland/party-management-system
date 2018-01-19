<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\Provider;
use Illuminate\Http\Request;

class ProviderPaymentsController extends Controller
{
    /**
     * persist a providers payment to the data base.
     *
     * @param \App\Provider            $provider
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function store(Provider $provider, Request $request)
    {
        $provider->pay($request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'budget_item_id' => 'nullable',
        ]));

        return BudgetCategory::getAll();
    }
}
