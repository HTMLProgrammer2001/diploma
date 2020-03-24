<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $commissions = Commission::all();

        return view('admin.users.create', compact('departments', 'commissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'surname' => 'required',
           'patronymic' => 'required',
           'email' => 'required|email',
           'password' => 'required|confirmed|min:8',
           'avatar' => 'nullable|image|mimes:jpeg,png',
           'department' => 'nullable|exists:department',
           'commission' => 'nullable|exists:commission'
        ]);

        echo 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
