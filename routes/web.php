<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index');
//me
Route::get('me', 'MeController@show');
Route::put('me', 'MeController@update');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/beneficiaries/{id}/avatars/prepare', 'BeneficiaryController@prepare_avatar');
Route::post('/beneficiaries/{id}/avatars', 'BeneficiaryController@store_avatar');
Route::get('/beneficiaries/{id}/address/create', 'BeneficiaryController@create_address');
Route::post('/beneficiaries/{id}/address', 'BeneficiaryController@store_address');
Route::get('/beneficiaries/{id}/residents/create', 'BeneficiaryController@create_resident');
Route::post('/beneficiaries/{id}/residents', 'BeneficiaryController@store_resident');
Route::get('/beneficiaries/{id}/researches/create', 'BeneficiaryController@create_research');
Route::get('/beneficiaries/{id}/documents/create', 'BeneficiaryController@create_document');
Route::post('/beneficiaries/{id}/documents', 'BeneficiaryController@store_document');

//roles
Route::post('/roles/assign-permissions', 'RoleController@assign_permission');

Route::resource('/beneficiaries', 'BeneficiaryController');
Route::resource('/areas', 'AreaController');
Route::resource('/cities', 'CityController');
Route::resource('/banks', 'BankController');
Route::resource('/jobs', 'JobController');
Route::resource('/roles', 'RoleController');
Route::resource('/departments', 'DepartmentController');
Route::resource('/graduations', 'GraduationController');
Route::resource('/education-specialties', 'EducationSpecialtyController');
Route::resource('/documents', 'DocumentController');
Route::resource('/marital-statuses', 'MaritalStatusController');
Route::resource('/family-roles', 'FamilyRoleController');
Route::resource('/incomes', 'IncomeController');
Route::resource('/expenses', 'ExpenseController');
Route::resource('/professions', 'ProfessionController');
Route::resource('/nationalities', 'NationalityController');
Route::resource('/money-needs', 'MoneyNeedController');
Route::resource('/item-needs', 'ItemNeedController');
Route::resource('/distributions', 'DistributionController');

// ======= RESEARCHES =======
Route::get('/researches', 'ResearchController@index');
Route::get('/researches/create', 'ResearchController@create');
Route::get('/researches/{id}/edit', 'ResearchController@edit');
Route::get('/researches/{id}/print', 'ResearchController@print_research');
Route::get('/researches/{id}', 'ResearchController@show');


Route::get('users/{id}/avatars/prepare', 'UserController@prepare_avatar');
Route::post('users/{id}/avatars', 'UserController@store_avatar');
Route::get('users/{id}/delete_confirmation', 'UserController@delete_confirmation');
Route::delete('users', 'UserController@destroy');
Route::resource('/users', 'UserController');
Route::resource('/employees', 'EmployeeController');




//RESEARCH KIND
Route::get('/research-kinds', 'ResearchKindController@index');

Route::get('/beneficiaries/createavatar', 'BeneficiaryController@createavatar');


//local ajax apis
Route::prefix('ajax')->group(function() {
    //beneficiary
    Route::post('/getbeneficiary', 'BeneficiaryController@ajax_show');
    Route::put('/beneficiaries/{id}', 'BeneficiaryController@ajax_update');

    //area
    Route::get('/areas', 'AreaController@ajax_index');
    Route::post('/areas', 'AreaController@ajax_store');
    Route::post('/areas/edit', 'AreaController@ajax_update');
    Route::delete('/areas', 'AreaController@ajax_destroy');

    //departments
    Route::get('/departments', 'DepartmentController@ajax_index');
    Route::post('/departments', 'DepartmentController@ajax_store');
    Route::post('/departments/edit', 'DepartmentController@ajax_update');
    Route::delete('/departments', 'DepartmentController@ajax_destroy');

    //cities
    Route::get('/cities', 'CityController@ajax_index');
    Route::post('/cityarea', 'CityController@city_area');
    Route::post('/cities', 'CityController@ajax_store');
    Route::post('/cities/edit', 'CityController@ajax_update');
    Route::delete('/cities', 'CityController@ajax_destroy');

    //jobs
    Route::get('/jobs', 'JobController@ajax_index');
    Route::post('/jobs', 'JobController@ajax_store');
    Route::post('/jobs/edit', 'JobController@ajax_update');
    Route::delete('/jobs', 'JobController@ajax_destroy');

    //graduation
    Route::get('/graduations', 'GraduationController@ajax_index');
    Route::post('/graduations', 'GraduationController@ajax_store');
    Route::post('/graduations/edit', 'GraduationController@ajax_update');
    Route::delete('/graduations', 'GraduationController@ajax_destroy');

    //education specialties
    Route::get('/education-specialties', 'EducationSpecialtyController@ajax_index');
    Route::post('/education-specialties', 'EducationSpecialtyController@ajax_store');
    Route::post('/education-specialties/edit', 'EducationSpecialtyController@ajax_update');
    Route::delete('/education-specialties', 'EducationSpecialtyController@ajax_destroy');

    //marital statuses
    Route::get('/marital-statuses', 'MaritalStatusController@ajax_index');
    Route::post('/marital-statuses', 'MaritalStatusController@ajax_store');
    Route::post('/marital-statuses/edit', 'MaritalStatusController@ajax_update');
    Route::delete('/marital-statuses', 'MaritalStatusController@ajax_destroy');

    //professions
    Route::get('/professions', 'ProfessionController@ajax_index');
    Route::post('/professions', 'ProfessionController@ajax_store');
    Route::post('/professions/edit', 'ProfessionController@ajax_update');
    Route::delete('/professions', 'ProfessionController@ajax_destroy');

    //professions
    Route::get('/expertises', 'ExpertiseController@ajax_index');
    Route::post('/expertises', 'ExpertiseController@ajax_store');
    Route::post('/expertises/edit', 'ExpertiseController@ajax_update');
    Route::delete('/expertises', 'ExpertiseController@ajax_destroy');

    //banks
    Route::get('/banks', 'BankController@ajax_index');
    Route::post('/banks', 'BankController@ajax_store');
    Route::post('/banks/edit', 'BankController@ajax_update');
    Route::delete('/banks', 'BankController@ajax_destroy');

    //incomes
    Route::get('/incomes', 'IncomeController@ajax_index');
    Route::post('/incomes', 'IncomeController@ajax_store');
    Route::post('/incomes/edit', 'IncomeController@ajax_update');
    Route::delete('/incomes', 'IncomeController@ajax_destroy');

    //expenses
    Route::get('/expenses', 'ExpenseController@ajax_index');
    Route::post('/expenses', 'ExpenseController@ajax_store');
    Route::post('/expenses/edit', 'ExpenseController@ajax_update');
    Route::delete('/expenses', 'ExpenseController@ajax_destroy');

    //nationalities
    Route::get('/nationalities', 'NationalityController@ajax_index');
    Route::post('/nationalities', 'NationalityController@ajax_store');
    Route::post('/nationalities/edit', 'NationalityController@ajax_update');
    Route::delete('/nationalities', 'NationalityController@ajax_destroy');

    //family roles
    Route::get('/family-roles', 'FamilyRoleController@ajax_index');
    Route::post('/family-roles', 'FamilyRoleController@ajax_store');
    Route::post('/family-roles/edit', 'FamilyRoleController@ajax_update');
    Route::delete('/family-roles', 'FamilyRoleController@ajax_destroy');

    Route::get('/guardians', 'GuardianController@ajax_index');
    Route::post('/guardians', 'GuardianController@ajax_store');
    Route::post('/guardians/edit', 'GuardianController@ajax_update');
    Route::delete('/guardians', 'GuardianController@ajax_destroy');

    //money needs
    Route::get('/money-needs', 'MoneyNeedController@ajax_index');
    Route::post('/money-needs', 'MoneyNeedController@ajax_store');
    Route::post('/money-needs/edit', 'MoneyNeedController@ajax_update');
    Route::delete('/money-needs', 'MoneyNeedController@ajax_destroy');

    //item needs
    Route::get('/item-needs', 'ItemNeedController@ajax_index');
    Route::post('/item-needs', 'ItemNeedController@ajax_store');
    Route::post('/item-needs/edit', 'ItemNeedController@ajax_update');
    Route::delete('/item-needs', 'ItemNeedController@ajax_destroy');

    //researches
    Route::post('/researches', 'ResearchController@ajax_store');
    Route::post('/researches/edit', 'ResearchController@ajax_update');

    //research kinds
    Route::get('/research-kinds', 'ResearchKindController@ajax_index');
    Route::post('/research-kinds', 'ResearchKindController@ajax_store');
    Route::post('/research-kinds/edit', 'ResearchKindController@ajax_update');
    Route::delete('/research-kinds', 'ResearchKindController@ajax_destroy');

    //addresses
    Route::put('/addresses/{id}', 'AddressController@ajax_update');

    //resident_kind
    Route::post('/resident-kinds', 'ResidentKindController@ajax_store');

    //residents
    Route::post('/residents', 'ResidentController@ajax_store');
    Route::put('/residents/{id}', 'ResidentController@ajax_update');

    //employees
    Route::delete('/employees', 'EmployeeController@ajax_destroy');

    //distributions
    Route::put('/distributions/{id}', 'DistributionController@ajax_update');
    Route::delete('/distributions', 'DistributionController@ajax_destroy');
    Route::post('/distribution-kinds', 'DistributionKindController@ajax_store');

    //items
    Route::post('/items', 'ItemController@ajax_store');

    //distribution-items
    Route::post('/distribution-items', 'DistributionItemController@ajax_store');

    //documents
    Route::delete('/documents', 'DocumentController@ajax_destroy');


    //roles
    Route::get('/roles', 'RoleController@ajax_index');
    Route::post('/roles', 'RoleController@ajax_store');
    Route::put('/roles/{id}', 'RoleController@ajax_update');
    Route::delete('/roles', 'RoleController@ajax_destroy');

    Route::delete('/users', 'UserController@ajax_destroy');
    Route::post('/users/ban', 'UserController@ajax_ban_user');
    Route::post('/users/unban', 'UserController@ajax_unban_user');


});
