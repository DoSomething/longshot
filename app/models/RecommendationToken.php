<?php

class RecommendationToken extends \Eloquent
{
    public function recommendation()
    {
        return $this->belongsTo('Recommendation');
    }
}
