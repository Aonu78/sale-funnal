<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunnelSubmission extends Model
{
    protected $fillable = [
        'funnel_id','name','email','phone','question_answer','ip_address','user_agent'
    ];

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }
}
