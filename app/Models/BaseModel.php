<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use InvalidArgumentException;
use Laravel\Sanctum\HasApiTokens;
use LogicException;

class BaseModel extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * Create a auth token.
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws Exception
     * @throws InvalidCastException
     * @throws LogicException
     */
    public function getAccessToken($tokenName = null)
    {
        $token = $this->createToken($tokenName);

        return [
            'access_token' => $token->plainTextToken,
            'type' => 'bearer',
        ];
    }
}
