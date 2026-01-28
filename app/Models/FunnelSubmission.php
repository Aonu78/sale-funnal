<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunnelSubmission extends Model
{
    protected $fillable = [
        'funnel_id','name','email','phone','question_answer','ip_address','user_agent',
        'preferred_call_date_from','preferred_call_date_to','call_availability_description','replied'
    ];

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }
    public function answers()
    {
        return $this->hasMany(\App\Models\FunnelSubmissionAnswer::class);
    }

}
