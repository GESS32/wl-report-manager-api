<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property-read int $id
 * @property-read string $uuid
 * @property string $nickname
 * @property string $password
 * @property int $grade
 * @property float $experience
 * @property int $role
 * @property int $specialization
 * @property array $responsibilities
 * @property array $permissions
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method static User|Builder query()
 * @method static User|null first()
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
        'id',
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

    public function getJWTIdentifier(): int
    {
        return $this->id;
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
