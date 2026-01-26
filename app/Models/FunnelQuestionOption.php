<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunnelQuestionOption extends Model
{
    protected $fillable = ['funnel_question_id','sort_order','label','value','is_active'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(FunnelQuestion::class, 'funnel_question_id');
    }
}
