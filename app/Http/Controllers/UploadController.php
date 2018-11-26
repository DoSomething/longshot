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
        // If the user is authorized to view this file, load it from S3 and
        // return in the response. Otherwise, tell them no way!
        if ((Auth::user()->id == $user_id || Auth::user()->hasRole('administrator'))) {
            // TODO: Update this to just Storage::download() in Laravel 5.6+.
            $file = Storage::get('uploads/'.$user_id.'/'.$filename);

            return Image::make($file)->response();
        }

        return redirect()->home()->with('flash_message', ['text' => 'You are not authorized to view that page.', 'class' => '-error']);
    }
}
