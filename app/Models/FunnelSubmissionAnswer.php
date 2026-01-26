<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunnelSubmissionAnswer extends Model
{
    protected $fillable = ['funnel_submission_id','funnel_question_id','answer_text','answer_json'];

    protected $casts = [
        'answer_json' => 'array',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(FunnelSubmission::class, 'funnel_submission_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(FunnelQuestion::class, 'funnel_question_id');
    }
}
