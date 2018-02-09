<?php

namespace App\Http\ViewComposers;

//use App\Group;
use App\Lib\hp_utils;
use Illuminate\Contracts\View\View;
//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Request;

class ViewDataComposer {
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    // protected $shop_managers;
    // protected $user_type;
    // protected $shop_id;
    // protected $category_dropdown;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository $users
     * @return void
     */
    public function __construct() {

        //Dependencies automatically resolved by service container...

        try {
            // $this->shop_managers = [];
            // $sw_shop_managers = DB::table('sw_shops')->whereNotNull('shop_manager')->pluck('shop_manager');
            // $userTypes = DB::table('users')->select('id', 'name')->whereNotIn('id', $sw_shop_managers)->where('user_type', 2)->get(); //undo
            // $this->shop_managers = sw_utils::CollectionToArray_ForDropDown($userTypes);
        } catch (\Illuminate\Database\QueryException $e1) {
            
        } catch (\ErrorException $e2) {
            
        } catch (Exception $e3) {
            
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view) {
//        $view->with('_shop_managers', $this->shop_managers);
    }

    public function ViewForProfile(View $view) {
        $sates = hp_utils::getAllStates();
        $view->with('_stateslist', $sates);

        $cities = hp_utils::getAllCities();
        $view->with('_citieslist', $cities);
    }

    public function ViewForAnnouncements(View $view) {
        $deps = hp_utils::getActiveDepartments();
        $view->with('_departments_list', $deps);
    }

    public function ViewForEmployees(View $view) {
        $deps = hp_utils::getActiveDepartments();
        $view->with('_departments_list', $deps);
        
        $locations = hp_utils::getCompanyLocations();
        $view->with('_locations_list', $locations);
        
        $designs = hp_utils::getCorporateDesignations();
        $view->with('_designations_list',$designs);
    }

}
