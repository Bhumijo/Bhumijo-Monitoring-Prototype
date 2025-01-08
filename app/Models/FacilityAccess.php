<?php

namespace App\Models;

use App\Models\Admin\FacilityService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacilityAccess extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'user_id',
        'service_id',
        'gender',
        'price',
        'is_subscribed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_type' => 'string',
        'user_id' => 'integer',
        'service_id' => 'integer',
        'gender' => 'string',
        'price' => 'float',
        'is_subscribed' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * facility service
     *
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(FacilityService::class, 'service_id', 'id');
    }
}
