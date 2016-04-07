<?php

use Illuminate\Filesystem\Filesystem;
use App\Models\Scholarship;
use App\Models\User;
use App\Models\Winner;

class WinnerController extends \Controller
{
    public function index()
    {
        $filter_by = Request::get('filter_by');

        $query = DB::table('winners');

        if ($filter_by) {
            $query->where('winners.scholarship_id', '=', $filter_by);
        }

        $winners = $query->get();

        $scholarships = Scholarship::all();

        return view('admin.winners.index', compact('winners', 'scholarships'));
    }

  /**
   * Store a single winnner record.
   * 
   * @return Response
   */
  public function store()
  {
      $user_id = Input::get('user_id');

      $user = (new User())->getFullBios($user_id);

      $winner = new Winner();
      $winner->setUserData($user);

      $winner->save();

    // Clear cache since scholarship winner's information was updated.
    Event::fire('data.update', ['winners', $winner->scholarship_id]);

      return redirect()->back()->with('flash_message', ['text' => 'Success: Awesome, we got that person as a winner for you!', 'class' => 'alert-success']);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return Response
   */
  public function edit($id)
  {
      $winner = Winner::findOrFail($id);

      return view('admin.winners.edit', compact('winner'));
  }

  /**
   * Update the specified resource.
   * 
   * @return Response
   */
  public function update($id)
  {
      $input = Input::except('photo');
      $winner = Winner::with('user')->where('id', $id)->firstOrFail();
      $winner->fill($input);

      $image = Input::file('photo');
      if (Input::hasFile('photo')) {
          $filename = time().'-'.stringtoKebabCase($image->getClientOriginalName());
          $image->move(uploadedContentPath('images').'/winners/', $filename);
          $winner->photo = '/content/images/winners/'.$filename;
      }

      $winner->save();

    // Clear cache since scholarship winner's information was updated.
    Event::fire('data.update', ['winners', $winner->scholarship_id]);

      return redirect()->back()->with('flash_message', ['text' => 'Success: BAM, that\'s saved!', 'class' => 'alert-success']);
  }

  /**
   * Delete a single winner record.
   * 
   * @return Response
   */
  public function destroy()
  {
      $user_id = Input::get('user_id');
      $record = Winner::where('user_id', $user_id)->firstOrFail();

      // Clean up and remove the associated winner profile image.
      $image_path = public_path().$record->photo;
      $image = new Filesystem();

      if ($image->exists($image_path)) {
          $image->delete($image_path);
      }

      $record->delete();

      // Clear cache since scholarship winner was removed.
      Event::fire('data.update', ['winners', $record->scholarship_id]);

      return redirect()->back()->with('flash_message', ['text' => 'Success: All set. Scholarship award has been revoked.', 'class' => 'alert-success']);
  }
}
