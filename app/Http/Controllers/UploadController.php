<?php

use Illuminate\Http\Request;

class UploadController extends \Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($user_id, $filename, Request $request)
    {
         if(Auth::user() && (Auth::user()->id == $user_id || Auth::user()->hasRole('administrator')))
         {
            return response()->download(storage_path('app/uploads/'.$user_id.'/'.$filename), null, [], 'inline');
         }

         return redirect()->home()->with('flash_message', ['text' => 'You are not authorized to view that page.', 'class' => '-error']);
    }
}
