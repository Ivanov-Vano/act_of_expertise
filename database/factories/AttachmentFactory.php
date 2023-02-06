<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Act;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'act_id' => Act::all()->random()->id,
            'name' => $this->faker->sentence(3),
            'file_path' => $this->faker->image(storage_path('app/public/attachments'), 50,50, null, true ),
        ];
    }
}
