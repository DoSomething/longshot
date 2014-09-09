<?php

class PageController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /page
   *
   * @return Response
   */
  public function index()
  {
   $pages = DB::table('pages')->get();
   return View::make('admin.page.index', compact('pages'));

  }

  /**
   * Show the form for creating a new resource.
   * GET /page/create
   *
   * @return Response
   */
  public function create()
  {
    return View::make('admin.page.create');
  }

  /**
   * Store a newly created resource in storage.
   * POST /page
   *
   * @return Response
   */
  public function store()
  {
    $input = Input::all();

    $page = new Page;
    if (Input::hasFile('hero_image'))
    {
      $file = Input::file('hero_image');
      $filename = $file->getClientOriginalName();
      $file->move(public_path() . '/pages/images/', $filename);
      $page->$key = $filename;
    }
    $page->title = $input['title'];
    $page->description = $input['description'];

    $page->save();

    $blocks = Input::get('blocks');

    foreach($blocks as $key=>$block)
    {
      $newBlock = new Block;
      $newBlock->block_title = $block['title'];
      $newBlock->block_description = $block['description'];
      $newBlock->block_body = $block['body'];
      $newBlock->page()->associate($page);

      $newBlock->save();
    }


    return Redirect::route('admin.page.index')->with('flash_message', 'Static page has been saved!');
  }

  /**
   * Display the specified resource.
   * GET /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   * GET /page/{id}/edit
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $page = Page::whereId($id)->firstOrFail();
    $blocks = Block::where('page_id', $id)->get();
    return View::make('admin.page.edit')->with(compact('page', 'blocks'));
  }

  /**
   * Update the specified resource in storage.
   * PUT /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $input = Input::except("blocks");
    $page = Page::whereId($id)->firstOrFail();
    $page->fill($input)->save();

    $blocks = Input::get("blocks");
    foreach($blocks as $key=>$block)
    {
      $currentBlock = Block::whereId($block['id'])->firstOrFail();

      if ($currentBlock)
      {
        $currentBlock->block_title = $block['title'];
        $currentBlock->block_description = $block['description'];
        $currentBlock->block_body = $block['body'];
        $currentBlock->save();
      }

      // else {
      //   // @TODO: this throws a no access error
      //   $newBlock = new Block;
      //   $newBlock->block_title = $block['title'];
      //   $newBlock->block_description = $block['description'];
      //   $newBlock->block_body = $block['body'];
      //   $newBlock->page()->associate($page);

      //   $newBlock->save();
      // }

    }
    return Redirect::route('admin.page.index')->with('flash_message', 'Static page has been updated!');
  }

  /**
   * Remove the specified resource from storage.
   * DELETE /page/{id}
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }

}