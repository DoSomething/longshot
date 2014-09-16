<p>{{ $applicant }} is applying to the scholarship!</p>

{{link_to_route('recommendation.edit', "Please provide a recommendation", array($recommendation_id,'token' => $token))}}