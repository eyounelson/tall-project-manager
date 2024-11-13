<?php

namespace Modules\ProjectManager\Http\Controllers;

use Illuminate\Http\Request;

class ProjectManagerController
{
    public function index()
    {
        return view('projectmanager::index');
    }

    public function create()
    {
        return view('projectmanager::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('projectmanager::show');
    }

    public function edit($id)
    {
        return view('projectmanager::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
