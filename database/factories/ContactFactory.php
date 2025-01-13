<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'position' => $this->faker->jobTitle,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'topic' => $this->faker->sentence(3),
            'short_message' => $this->faker->paragraph,
        ];
    }
}
