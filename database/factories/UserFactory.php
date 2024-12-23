<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake();
        $grades = array_map(static fn (GradeEnum $case): int => $case->value, GradeEnum::cases());
        $roles = array_map(static fn (RoleEnum $case): int => $case->value, RoleEnum::cases());

        $responsibilities = array_map(
            static fn (ResponsibilitiesEnum $case): int
            => $case->value, ResponsibilitiesEnum::cases()
        );

        return [
            'nickname' => $faker->userName(),
            'uuid' => $faker->uuid(),
            'password' => Hash::make('12345678'),
            'role' => $faker->randomElement($roles),
            'grade' => $faker->randomElement($grades),
            'experience' => $faker->randomFloat(1, max: 10),
            'responsibilities' => $faker->randomElements(
                $responsibilities,
                $faker->numberBetween(1, count($responsibilities))
            ),
            'permissions' => null,
        ];
    }
}
