<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property-read int $id
 * @property-read string $uuid
 * @property string $nickname
 * @property string $password
 * @property int grade
 * @property float experience
 * @property int role
 * @property array $responsibilities
 * @property array $permissions
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /** @var string[] */
    protected $fillable = [
        'password',
    ];

    /** @var string[] */
    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'responsibilities' => 'array',
            'permissions' => 'array',
        ];
    }

    public function getJWTIdentifier(): string
    {
        return $this->uuid;
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'uuid' => $this->uuid,
            'nickname' => $this->nickname,
            'permissions' => $this->permissions,
        ];
    }
}
