<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResourceMgr\AnnouncementsMgr;

class AnnouncementsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $call_mgr = new AnnouncementsMgr();
        $resp = $call_mgr->getAllAnnouncements();
        return view('announcements.index')->with('data', $resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $call_mgr = new AnnouncementsMgr();
        $resl = $call_mgr->store($request);
        if ($resl['result'] == 'ok')
            return redirect()->route('all-announcements')->with('success', 'announcements has been created successfully');

        return redirect()->route('create-announcement')->withInput()->withErrors($resl['dtls']);
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
        $call_mgr = new AnnouncementsMgr();
        $resp = $call_mgr->getAnnouncementForEdit($id);
        return view('announcements.edit')->with('data', $resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $call_mgr = new AnnouncementsMgr();
        $resl = $call_mgr->update($request, $id);
        if ($resl['result'] == 'ok')
            return redirect()->route('edit-announcement', $id)->with('success', 'announcements has been updated successfully');

        return redirect()->route('edit-announcement', $id)->withInput()->withErrors($resl['dtls']);
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
