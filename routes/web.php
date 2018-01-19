<?php


Auth::routes();

Route::resource('/budgets', 'BudgetsController');
Route::resource('/budget-categories', 'BudgetCategoriesController');
Route::resource('budget-items', 'BudgetItemsController');

Route::resource('budget-items.reviews', 'BudgetReviewsController');
Route::resource('pledges.contributions', 'ContributionsController');
Route::resource('pledges', 'PledgesController');
Route::resource('budgetItems.providers', 'BudgetItemProvidersController');

Route::redirect('replies', '/');
Route::redirect('/', 'dashboard');
Route::redirect('/home', '/dashboard');
//cards
Route::resource('cards', 'CardsController');

//expenditures
Route::resource('providers', 'ProvidersController');
Route::post('providers/{provider}/payments', 'ProviderPaymentsController@store');
Route::resource('expenditures', 'ExpendituresController');
//dashboard

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::post('/summary', 'SummaryController@index');
Route::get('/summary', 'SummaryController@index');

Route::get('/test', function () {
    return \App\BudgetItem::getTotal();
});
