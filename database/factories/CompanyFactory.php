<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->company(),
            'country'=>$this->faker->country(),
            'address'=>$this->faker->address(),
            'zipcode'=>$this->faker->postcode(),
            'phone'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->email(),
        ];
    }
}
