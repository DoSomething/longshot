<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendationToken extends Model
{
    public function recommendation()
    {
        return $this->belongsTo('App\Models\Recommendation');
    }
}
