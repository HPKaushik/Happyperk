<?php

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

Route::get('/', function () {
    if (Auth::check()) { // if user tries to access login page eventhough he's logged in:: redirect to dashboard
        return Redirect::to('dashboard');
    }
    return view('auth.login'); //else display login
});
//    Route::get('/adminlogin', 'loginController@index')->name('dashboard');

Auth::routes(); // login routes
Route::group(['middleware' => ['auth']], function () { //authentication
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    /* company profile routes */
    //profile
    Route::get('company/profile', 'ProfileController@edit')->name('edit-profile'); // show profile form
    Route::post('company/profile/update', 'ProfileController@update')->name('update-profile'); //update profile details
    /*
     * locations
     */
    Route::get('company/locations', 'ProfileController@indexLocations')->name('all-company-locations'); // show locations list
    Route::get('company/locations/create', 'ProfileController@createLocations')->name('create-company-location'); // locations add form
    Route::post('company/locations/store', 'ProfileController@storeLocations')->name('store-company-location'); // locations store
    Route::get('company/locations/{id}/edit', 'ProfileController@editLocations')->name('edit-company-location'); // locations edit form
    Route::post('company/locations/{id}/update', 'ProfileController@updateLocations')->name('update-company-location'); // locations update
    /* departments
     * 
     */
    Route::get('company/departments', 'ProfileController@indexDepartments')->name('all-company-departments'); // show locations list
    Route::get('company/departments/create', 'ProfileController@createDepartments')->name('create-company-department'); // locations add form
    Route::post('company/departments/store', 'ProfileController@storeDepartments')->name('store-company-department'); // locations store
    Route::get('company/departments/{id}/edit', 'ProfileController@editDepartments')->name('edit-company-department'); // locations edit form
    Route::post('company/departments/{id}/update', 'ProfileController@updateDepartments')->name('update-company-department'); // locations update
    // activity routes
    Route::get('company/activities', 'ProfileController@indexActivity')->name('all-company-activities'); // show activities

    /*
     * Designation
     */
    Route::get('company/designations', 'ProfileController@indexDesignations')->name('all-company-designations'); // Drag and drop
    Route::post('company/designations/store', 'ProfileController@storeDesignations')->name('store-designation'); // Drag and drop

    /* company profile routes ends */


    /* Recognizance
     * 
     */
    //announcements routes
    Route::get('announcements', 'AnnouncementsController@index')->name('all-announcements'); // show announcements list
    Route::get('announcements/create', 'AnnouncementsController@create')->name('create-announcement'); // show create form
    Route::post('announcements/store', 'AnnouncementsController@store')->name('store-announcement'); // store new announcement
    Route::get('announcements/{id}/edit', 'AnnouncementsController@edit')->name('edit-announcement'); // edit form
    Route::post('announcements/{id}/update', 'AnnouncementsController@update')->name('update-announcement'); // update data
    //announcements routes ends
    //Awards routes
    Route::get('awards', 'AwardsController@index')->name('all-awards'); // show awards list
    Route::any('awards/create', 'AwardsController@create')->name('create-award'); // show create form
    Route::post('awards/store', 'AwardsController@store')->name('store-award'); // store new awards
    Route::any('awards/{id}/edit', 'AwardsController@edit')->name('edit-award'); // edit form
    Route::post('awards/{id}/update', 'AwardsController@update')->name('update-award'); // update data
    //Awards routes ends

    /*
     * Employee routes
     */
    Route::get('employees', 'EmployeeController@index')->name('all-employees'); // show all records list
    Route::any('employee/create', 'EmployeeController@create')->name('create-employee'); // show create form
    Route::post('employee/store', 'EmployeeController@store')->name('store-employee'); // store new record
    Route::any('employee/{id}/edit', 'EmployeeController@edit')->name('edit-employee'); // edit form
    Route::post('employee/{id}/update', 'EmployeeController@update')->name('update-employee'); // update data

    Route::get('employees/transfers', 'EmployeeController@indexTransfers')->name('all-employees-transfers'); // show all transfers

    /* comapny transactions routes
     * 
     */
    Route::get('company/transactions', 'ProfileController@indexTransactions')->name('all-company-transactions');
});

//Route::get('/category', 'CategoryController@index')->name('all-categories');

// User Links
// User main page
//Route::get('users', 'UserController@index')->name('all-users'); //list of users
//Route::get('users/create', 'UserController@create')->name('create-user'); //create form
//Route::post('users/store', 'UserController@store')->name('store-user'); // store data
//end users routes

//Route::get('vendors', 'VendorController@index')->name('all-vendors');


