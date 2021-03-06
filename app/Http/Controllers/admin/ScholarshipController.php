<?php

use App\Models\Scholarship;

class ScholarshipController extends \Controller
{
    /**
     * Display a listing of the resource.
     * GET /scholarship.
     *
     * @return Response
     */
    public function index()
    {
        $scholarships = Scholarship::get(['id', 'title', 'amount_scholarship', 'application_start', 'application_end']);

        return view('admin.scholarship.index')->with(compact('scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /scholarship/create.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.scholarship.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /scholarship.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $scholarship = new Scholarship();

        foreach ($input as $key => $field) {
            // skip form token
            if ($key !== '_token') {
                $scholarship->$key = $field;
            }
        }
        $scholarship->save();

        return redirect()->route('admin.scholarship.index')->with('flash_message', ['text' => 'Success: New Scholarship has been created!', 'class' => 'alert-success']);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /scholarship/{id}/edit.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $scholarship = Scholarship::whereId($id)->firstOrFail();

        return view('admin.scholarship.edit')->with(compact('scholarship'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /scholarship/{id}.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();

        $scholarship = Scholarship::whereId($id)->firstOrFail();

        // Must explicity get checkbox content to save as boolean, since a non-checked  box doesn't return anything from a form submit.
        $scholarship->display_optional_rec_question = Input::get('display_optional_rec_question');
        $scholarship->image_uploads = Input::get('image_uploads');

        $scholarship->fill($input)->save();

        // Maybe this should go to scholarship/show?
        return redirect()->back()->with('flash_message', ['text' => 'Success: Scholarship information has been saved!', 'class' => 'alert-success']);
    }
}
