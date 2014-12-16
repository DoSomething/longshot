<?php namespace Scholarship\Composers;

use Scholarship\Repositories\SettingRepository;

class PageComposer {

  protected $settings;

  public function __construct(SettingRepository $settings)
  {
    $this->settings    = $settings;
  }

  public function compose($view)
  {
    $favicon   = $this->settings->getSpecifiedSettingsVars(['favicon']);
    $ogd_vars  = $this->settings->getOpenGraphDataSettingsVars();
    $page_vars = $this->settings->getPageSettingsVars();

    $vars = (object) array_merge($favicon, $ogd_vars, $page_vars);

    $view->with('global_vars', $vars);
  }

}
