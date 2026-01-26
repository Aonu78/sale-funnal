<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funnel extends Model
{
    protected $fillable = [
        'slug','title','seo_title','seo_description','hero_image_path',
        'question_label','question_type','footer_text','is_active'
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(FunnelSubmission::class);
    }
    public function questions()
    {
        return $this->hasMany(\App\Models\FunnelQuestion::class)->orderBy('sort_order');
    }

    public function routingRules()
    {
        return $this->hasMany(\App\Models\FunnelRoutingRule::class)->orderByDesc('priority');
    }

}
