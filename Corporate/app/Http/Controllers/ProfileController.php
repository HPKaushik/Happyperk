<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceMgr\ProfileMgr;
use Illuminate\Support\Facades\Auth;
use App\Lib\hp_utils;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $call_mgr = new ProfileMgr(); //call manager
        $resp = $call_mgr->getEditProfile($corporate_id); //get data
        return view('profile.edit')->with('data', $resp); //pass data
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $call_mgr = new ProfileMgr();
         $resl = $call_mgr->updateProfile($request);
               if ($resl['result'] == 'ok')
            return redirect()->route('edit-profile')->with('success', 'Profile has been updated successfully');

        return redirect()->route('edit-profile')->withInput()->withErrors($resl['dtls']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /* locations */

    public function indexLocations() {
//return $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $call_mgr = new ProfileMgr();
        $resp = $call_mgr->getAllLocations();
        return view('profile.partials.locations.index')->with('data', $resp);
    }

    public function createLocations() {
        return view('profile.partials.locations.create');
    }

    public function editLocations($id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_locations)->where('id', $id)->where('corporate_id', $corporate_id)->first();
        return view('profile.partials.locations.edit')->with('data', $resp);
    }

    public function storeLocations(Request $request) {
        $call_mgr = new ProfileMgr();
        $resl = $call_mgr->storeLocations($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-company-locations')->with('success', 'Location has been added successfully');

        return redirect()->route('create-company-location')->withInput()->withErrors($resl['dtls']);
    }

    public function updateLocations(Request $request, $id) {
        $call_mgr = new ProfileMgr();
        $resl = $call_mgr->updateLocations($request, $id);
        if ($resl['result'] == 'ok')
            return redirect()->route('edit-company-location', $id)->with('success', 'Location has been added successfully');

        return redirect()->route('edit-company-location', $id)->withInput()->withErrors($resl['dtls']);
    }

    /* locations end */


    /* departments */

    public function indexDepartments() {
        $call_mgr = new ProfileMgr();
        $resp = $call_mgr->getAllDepartments();
        return view('profile.partials.departments.index')->with('data', $resp);
    }

    public function createDepartments() {
        return view('profile.partials.departments.create');
    }

    public function storeDepartments(Request $request) {
        $call_mgr = new ProfileMgr();
        $resl = $call_mgr->storeDepartments($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-company-departments')->with('success', 'Department has been added successfully');

        return redirect()->route('create-company-department')->withInput()->withErrors($resl['dtls']);
    }

    public function editDepartments($id) {
        $corporate_id = hp_utils::getCurrentUserCorporateId();  //hp_utils:get current user corporate_id
        $resp = DB::table(hp_tbl_corporate_departments)->where('id', $id)->where('corporate_id', $corporate_id)->first();
        return view('profile.partials.departments.edit')->with('data', $resp);
    }

    public function updateDepartments(Request $request, $id) {
        $call_mgr = new ProfileMgr();
        $resl = $call_mgr->updateDepartments($request, $id);
        if ($resl['result'] == 'ok')
            return redirect()->route('edit-company-department', $id)->with('success', 'Department has been added successfully');

        return redirect()->route('edit-company-department', $id)->withInput()->withErrors($resl['dtls']);
    }

    /* departments end */

    public function indexActivity() {
        $call_mgr = new ProfileMgr();
        $resp = $call_mgr->companyActivityLog();
        return view('profile.partials.activity.index')->with('data', $resp);
    }

    public function indexTransactions() {
        $call_mgr = new ProfileMgr();
        $resp = $call_mgr->getAllTransactions();
        return view('profile.partials.transactions.index')->with('data', $resp);
    }

    public function indexDesignations() {
//        return hp_utils::getCorporateDesignations();
        $call_mgr = new ProfileMgr();
        $resp = $call_mgr->getAllDesignations();
        return view('profile.partials.designations.index')->with('data', $resp);
    }

    public function storeDesignations(Request $request) {
        $call_mgr = new ProfileMgr();
        $resl = $call_mgr->storeDesignations($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-company-designations')->with('success', 'Designations has been added successfully');

        return redirect()->route('all-company-designations')->withInput()->withErrors($resl['dtls']);
    }

}
