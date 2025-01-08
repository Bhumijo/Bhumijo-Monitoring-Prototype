<?php

namespace App\Models;

use App\Models\Admin\Facility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSubscriptionPackage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'subscription_package_id',
        'facility_id',
        'can_be_used',
        'has_been_used',
        'start_date',
        'end_date',
        'recharged_by',
        'is_expired',
    ];

    /**
     * facility
     *
     * @return BelongsTo
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * rechargedBy
     *
     * @return BelongsTo
     */
    public function rechargedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recharged_by', 'id');
    }

    /**
     * subscriptionPackage
     *
     * @return BelongsTo
     */
    public function subscriptionPackage(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPackage::class, 'subscription_package_id', 'id');
    }
}
