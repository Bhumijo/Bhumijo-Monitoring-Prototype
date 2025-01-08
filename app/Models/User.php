<?php

namespace App\Models;

use App\Models\Payment\UserWallet;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseModel
{
    const USER_TYPE_USER = 'user';

    const USER_TYPE_MANGER = 'manager';

    const USER_TYPE_SUBSCRIPTION_PACKAGE_USER = 'package_user';

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'email',
        'free_access',
        'gender',
        'phone_number',
        'address',
        'blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uid' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'string',
        'free_access' => 'boolean',
        'address' => 'string',
    ];

    /**
     * Get the access device associated with the user.
     *
     * Syntax: return $this->hasOne(AccessDevice::class, 'foreign_key', 'local_key');
     *
     * Example: return $this->hasOne(AccessDevice::class, 'user_id', 'id');
     */
    public function accessDevice()
    {
        return $this->hasOne(AccessDevice::class);
    }

    /**
     * Get the User Wallet associated with the user.
     *
     * Syntax: return $this->hasOne(UserWallet::class, 'foreign_key', 'local_key');
     *
     * Example: return $this->hasOne(UserWallet::class, 'user_id', 'id');
     */
    public function userWallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function getIsManagerAttribute()
    {
        return $this->free_access;
    }
}
