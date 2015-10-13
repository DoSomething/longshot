<?php

class ManagerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$role_query = function($query) {
	    $query->whereIn('name', ['administrator']);
	  };

	  $admins = User::whereHas('roles', $role_query)->get();

		return View::make('admin.manage.index', compact('admins'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.manage.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$user = new User;
		$user->fill($input)->save();
		$user->assignRole(1);

		return Redirect::route('admin.manage.index')->with('flash_message', ['text' => '<strong>Success:</strong> Admin has been created!', 'class' => 'alert-success']);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$admin = User::findOrFail($id);

		return View::make('admin.manage.edit', compact('admin'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

   	$admin = User::whereId($id)->firstOrFail();
    $admin->fill($input);
    $admin->save();
    	
		return Redirect::route('admin.manage.index')->with('flash_message', ['text' => '<strong>Success:</strong> Admin has been updated!', 'class' => 'alert-success']);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$admin = User::find($id);
		$admin->delete();

		return Redirect::route('admin.manage.index')->with('flash_message', ['text' => '<strong>Success:</strong> Admin has been deleted!', 'class' => 'alert-success']);

	}


}
