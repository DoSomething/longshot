<?php namespace Scholarship\Composers;

use Scholarship\Repositories\SettingRepository;

class PageComposer {

  protected $setting;

  public function __construct(SettingRepository $setting)
  {
    $this->setting = $setting;
  }

  public function compose($view)
  {
    // $favicon       = Setting::getSpecifiedSettingsVars(['favicon']);
    // $ogd_vars      = Setting::getOpenGraphDataSettingsVars();
    // $page_vars     = Setting::getPageSettingsVars();

    // $vars = (object) array_merge($page_vars, $nominate_vars, $ogd_vars, $favicon);

    // $view->with('vars', 'vars');
    $view->with('vars', $this->setting->getPageSettingsVars());
  }

}

