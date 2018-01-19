<?php

namespace App\Http\Controllers;

use App\BudgetCategory;
use App\BudgetItem;
use App\Http\Requests\BudgetItemRequest;

class BudgetItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetItemRequest $request)
    {
        return BudgetItem::Create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BudgetItem $budgetItem)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetItemRequest $request, BudgetItem $budgetItem)
    {
        $budgetItem->update($request->validated());

        return BudgetCategory::getAll();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(BudgetItem $budget_item)
    {
        $budget_item->delete();

        return BudgetCategory::getAll();
    }
}
