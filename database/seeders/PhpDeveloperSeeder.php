<?php

declare(strict_types=1);

namespace Database\Seeders;

use Architecture\Domains\User\Enums\GradeEnum;
use Architecture\Domains\User\Enums\ResponsibilitiesEnum;
use Architecture\Domains\User\Enums\RoleEnum;
use Architecture\Domains\User\Enums\SpecializationEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PhpDeveloperSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        $currentTimestamp = now();

        if (DB::table('users')->where('nickname', 'developer')->exists()) {
            DB::table('users')->where('nickname', 'developer')->delete();
        }

        DB::table('users')->insert([
            'nickname' => 'developer',
            'uuid' => $faker->uuid(),
            'password' => Hash::make('12345678'),
            'role' => RoleEnum::DEVELOPER->value,
            'grade' => GradeEnum::MIDDLE->value,
            'specialization' => SpecializationEnum::PHP,
            'experience' => $faker->randomFloat(1, 4, 8),
            'responsibilities' => json_encode([
                ResponsibilitiesEnum::FULLSTACK->value,
                ResponsibilitiesEnum::TECH_LEAD->value,
                ResponsibilitiesEnum::LARAVEL->value,
            ]),
            'permissions' => null,
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);
    }
}
