<?php

use Michelf\MarkdownExtra;
use Scholarship\Repositories\SettingRepository;

class PagesController extends \BaseController {

  protected $settings;

  public function __construct(SettingRepository $settings)
  {
    $this->settings = $settings;
  }


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
    $types = Block::getTypes();
    return View::make('admin.page.create', compact('types'));
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
      $page->hero_image = '/pages/images' . $filename;
    }
    $page->title = $input['title'];
    if (! empty($input['description']))
    {
      $page->description = $input['description'];
      $page->description_html = MarkdownExtra::defaultTransform($input['description']);
    }

    // Save the page fields
    $page->save();

    // With page saved, now assign the path to it.
    // If no url entered, then use the title.
    // @TODO: can likely pull this out and add it to the model after passing through the values?
    $pathURL = $input['url'] ? $input['url'] : $input['title'];

    $path = new Path;
    $path->url = stringtoKebabCase($pathURL);
    $path->link_text  = $input['link_text'] ? $input['link_text'] : $input['title'];
    $page->assignPath($path);


    $blocks = Input::get('blocks');

    foreach($blocks as $key => $block)
    {
      // If none of the block fields are filled out, then don't save the block in the database.
      // @TODO: Pull this code out to DRY it up and make it a method of the Page class, to pass the block to.
      if (! empty($block['title']) || ! empty($block['body']) )
      {
        $newBlock = new Block;
        $newBlock->block_type = $block['type'];
        $newBlock->block_title = $block['title'];
        if (! empty($block['body']))
        {
          $newBlock->block_body = $block['body'];
          $newBlock->block_body_html = MarkdownExtra::defaultTransform($block['body']);
        }
        $newBlock->page()->associate($page);

        $newBlock->save();
      }
    }

    return Redirect::route('admin.page.index')->with('flash_message', ['text' => '<strong>Success:</strong> <em>Static</em> page has been saved!', 'class' => 'alert-success']);
  }


  /**
   * Display the specified resource.
   * GET /{path}
   *
   * @param  string  $path
   * @return Response
   */
  public function show($path)
  {
    $pathList = Path::lists('url');
    $pageRequest = stringtoKebabCase($path);
    $url = $pageRequest;

    if (!in_array($pageRequest, $pathList))
    {
      return App::abort(404);
    }

    $page = Path::getPageContent($pageRequest);

    if (View::exists('pages.' . $pageRequest))
    {
      return View::make('pages.' . $pageRequest, compact('page', 'url'));
    }

    // Otherwise, return the default static view template.
    return View::make('pages.static', compact('page', 'url'));
  }


  /**
   * Display the home page.
   * GET /
   *
   * @param  string patg
   * @return Response
   */
  public function home()
  {
    // @TODO: cache query to retrieve scholarship amount.
    $scholarshipAmount = Scholarship::getCurrentScholarship()->pluck('amount_scholarship');
    $page = Path::getPageContent('/');
    $winners = Winner::getLastYearWinners();
    $url = 'home';

    $vars = $this->settings->getSpecifiedSettingsVars(['nominate_text', 'nominate_image']);

    return View::make('pages.home', compact('page', 'winners', 'url', 'scholarshipAmount', 'vars'));
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
    $page = Page::with('path')->whereId($id)->firstOrFail();
    $page->path->disabled = 'true';
    $blocks = Block::where('page_id', $id)->get();
    $types = Block::getTypes();

    return View::make('admin.page.edit')->with(compact('page', 'blocks', 'types'));
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
    $inputText = Input::only('title', 'link_text', 'description');
    $inputImage = Input::only('hero_image');

    // @TODO: add image validation here.

    $page = Page::whereId($id)->firstOrFail();
    $path = Path::wherePageId($id)->firstOrFail();

    // @TODO: if image already exists, should we delete old one?
    if (Input::hasFile('hero_image'))
    {
      $file = Input::file('hero_image');
      $filename = $file->getClientOriginalName();
      $file->move(public_path() . '/pages/images/', $filename);
      $inputText['hero_image'] = '/pages/images/' . $filename;
    }

    $inputText['description_html'] = MarkdownExtra::defaultTransform($inputText['description']);

    $page->fill($inputText)->save();

    $path->link_text = $inputText['link_text'];
    $path->save();

    $blocks = Input::get('blocks');

    foreach($blocks as $key => $block)
    {
      if (isset($block['id']))
      {
        $currentBlock = Block::whereId($block['id'])->firstOrFail();
        $currentBlock->block_type = $block['type'];
        $currentBlock->block_title = $block['title'];
        if (! empty($block['body']))
        {
          $currentBlock->block_body = $block['body'];
          $currentBlock->block_body_html = MarkdownExtra::defaultTransform($block['body']);
        }
        $currentBlock->save();
      }
      else
      {
        // @TODO: Pull this code out to DRY it up and make it a method of the Page class, to pass the block to.
        if (! empty($block['title']) || ! empty($block['body']) )
        {
          $newBlock = new Block;
          $newBlock->block_type = $block['type'];
          $newBlock->block_title = $block['title'];
          if (! empty($block['body']))
          {
            $newBlock->block_body = $block['body'];
            $newBlock->block_body_html = MarkdownExtra::defaultTransform($block['body']);
          }
          $newBlock->page()->associate($page);

          $newBlock->save();
        }
      }

    }

    return Redirect::route('admin.page.index')->with('flash_message', ['text' => '<strong>Success:</strong> <em>Static</em> page has been updated!', 'class' => 'alert-success']);
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
