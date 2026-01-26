<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FunnelRoutingRule extends Model
{
    protected $fillable = ['funnel_id','tag','priority','conditions','thankyou_title','thankyou_body','is_active'];

    protected $casts = [
        'conditions' => 'array',
        'is_active' => 'boolean',
    ];

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }
}
