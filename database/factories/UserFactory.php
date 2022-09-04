<?php

namespace Database\Factories;

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
//        php artisan make:factory UserFactory
        return [
            'username' => fake()->name(),
            'email_phone' => fake()->unique()->safeEmail(),
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//            'phone'=>fake()->phoneNumber(),
//            'address' => fake()->paragraph(),
            'address' => fake()->address(),
//           'img'=>fake()->imageUrl('40','60'),
            'status'=>fake()->randomElement(['active','inactive']),
            'registered_at'=>fake()->dateTime(),
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
//Tips :
//randomDigit for price
//sentence(5) for description
//Carbon::now()->format('Y-m-d H:i:s')
//randomKey([1,2,3])
