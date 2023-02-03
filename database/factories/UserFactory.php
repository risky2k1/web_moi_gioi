<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password,
            'role'=>fake()->randomElement(UserRoleEnum::asArray()),
//            'role' => $this->faker->randomElement(UserRoleEnum::getValues()),
            'bio' => fake()->boolean ? fake()->realText : null, //Có chỗ có bio có chỗ không
            'position' => fake()->jobTitle(),
            'gender' => fake()->boolean(),
            'phone' => fake()->phoneNumber(),
            'link' => fake()->boolean ? fake()->url : null,
            'city' => fake()->city(),
            'company_id' => Company::query()->inRandomOrder()->value('id'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
