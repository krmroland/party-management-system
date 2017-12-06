<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("/budgets", "BudgetsController");
Route::resource("/budget-categories", "BudgetCategoriesController");
Route::resource("budget-items", "BudgetItemsController");
