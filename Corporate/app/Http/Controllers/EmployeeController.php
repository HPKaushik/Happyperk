<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceMgr\EmployeeMgr;

class EmployeeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $call_mgr = new EmployeeMgr();
        $resp = $call_mgr->getAllEmployees($request);
        if ($request->ajax())
            return view('employees.inc.ajax_emp_list')->with('data', $resp);

        return view('employees.index')->with('data', $resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $call_mgr = new EmployeeMgr();
        $resl = $call_mgr->store($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-employees')->with('success', 'employee has been created successfully');

        return redirect()->route('create-employee')->withInput()->withErrors($resl['dtls']);
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
    public function edit($id) {
        $call_mgr = new EmployeeMgr();
        $resl = $call_mgr->getEmployeeForEdit($id);
        return view('employees.edit')->with('data', $resl);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $call_mgr = new EmployeeMgr();
        $resl = $call_mgr->update($request, $id);
        if ($resl['result'] == 'ok')
            return redirect()->route('edit-employee', $id)->with('success', 'employee has been updated successfully');

        return redirect()->route('edit-employee', $id)->withInput()->withErrors($resl['dtls']);
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

    public function indexTransfers() {
        $call_mgr = new EmployeeMgr();
        $resp = $call_mgr->getAllEmployeeTransfers();
        return view('profile.partials.transactions.emp_transfers')->with('data', $resp);
    }

}
