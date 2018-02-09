<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceMgr\AwardsMgr;
use App\ResourceMgr\CommonMgr;

class AwardsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $call_mgr = new AwardsMgr();
        $resp = $call_mgr->getAllAwards();
        return view('awards.index')->with('data', $resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $call_mgr = new CommonMgr();
        $resp = $call_mgr->getAllBadges();

        $call_another_mgr = new AwardsMgr();
        $resp->employees = $call_another_mgr->getActiveEmployees($request, '');
        if ($request->ajax())
//            return $request;
            return view('awards.inc.ajax_emp_list')->with('data', $resp);

        return view('awards.create')->with('data', $resp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $call_mgr = new AwardsMgr();
        $resl = $call_mgr->store($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-awards')->with('success', 'award has been created successfully');

        return redirect()->route('create-award')->withInput()->withErrors($resl['dtls']);
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
    public function edit(Request $request, $id) {
        $call_mgr = new CommonMgr();
        $resp = $call_mgr->getAllBadges();

        $call_another_mgr = new AwardsMgr();
        $resp->award = $call_another_mgr->getAwardEdit($request, $id);
        $resp->employees = $call_another_mgr->getActiveEmployees($request, $resp->award->employee);
//        if ($request->ajax())
//            return view('awards.inc.ajax_emp_list')->with('data', $resp);

        return view('awards.edit')->with('data', $resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $call_mgr = new AwardsMgr();
        $resl = $call_mgr->update($request,$id);
        if ($resl['result'] == 'ok')
            return redirect()->route('edit-award',$id)->with('success', 'award has been updated successfully');

        return redirect()->route('edit-award',$id)->withInput()->withErrors($resl['dtls']);
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

}
