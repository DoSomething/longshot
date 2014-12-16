<?php namespace Scholarship\Composers;

use Scholarship\Repositories\SettingRepository;
use Scholarship\Repositories\ScholarshipRepository;

class PageComposer {

  protected $settings;

  public function __construct(SettingRepository $settings, ScholarshipRepository $scholarship)
  {
    $this->settings    = $settings;
    $this->scholarship = $scholarship;
  }

  public function compose($view)
  {
    $favicon           = $this->settings->getSpecifiedSettingsVars(['favicon']);
    $ogd_vars          = $this->settings->getOpenGraphDataSettingsVars();
    $page_vars         = $this->settings->getPageSettingsVars();
    $scholarship_dates = $this->scholarship->getScholarshipEndDates();

    $vars = (object) array_merge($favicon, $ogd_vars, $page_vars, $scholarship_dates);

    $view->with('global_vars', $vars);
  }

}
