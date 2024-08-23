<?php

namespace Database\Factories;

use App\Models\ImageAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ImageAttachmentFactory extends Factory
{
    protected $model = ImageAttachment::class;

    public function definition(): array
    {
        return [
            'image_url' => $this->faker->url(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
