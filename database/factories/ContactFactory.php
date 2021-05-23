<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::pluck('id')->toArray();
        return [
            'full_names' => $this->faker->name(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->freeEmail(),
            'birthday' => $this->faker->dateTimeBetween('1940-01-01', '2010-12-31'),
            'user_id' => $this->faker->randomElement($users),
        ];
    }
}
