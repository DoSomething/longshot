<?php namespace Scholarship\Repositories;

class ScholarshipRepository {

  public function getScholarshipEndDates()
  {
    // @TODO: may be useful to cache this, but good for now.
    $scholarships = \Scholarship::get(['application_start', 'application_end', 'nomination_end']);
    $scholarships = $scholarships->first();

    return $scholarships->toArray();
  }

}
