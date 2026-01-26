<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FunnelQuestion extends Model
{
    protected $fillable = [
        'funnel_id','sort_order','key','label','help_text','type','is_required','is_active'
    ];

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(FunnelQuestionOption::class)->orderBy('sort_order');
    }
}
