<?php

namespace App\Models\Admin;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_bn',
        'address',
        'address_bn',
        'disable_friendly',
        'lat',
        'lng',
        'navigation_note',
        'navigation_note_bn',
        'additional_note',
        'is_active',
    ];

    /**
     * devices.
     *
     * @return HasMany
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'facility_id', 'id');
    }

    /**
     * services
     *
     * @return HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(FacilityService::class, 'facility_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'facility_id', 'id');
    }

    /**
     * get average rating
     *
     * @return float
     */
    public function getAverageRatingAttribute()
    {
        return round($this->feedbacks()->avg('rating'), 1);
    }

    public function environmentalQualities()
    {
        return $this->hasMany(EnvironmentQuality::class, 'facility_id', 'id');
    }
}
