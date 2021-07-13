<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\Integration;

use DanielDeWit\NovaPaperclip\Tests\stubs\App\Models\ModelWithImage;
use DanielDeWit\NovaPaperclip\Tests\stubs\App\Nova\Resources\ModelWithImageResource;
use Illuminate\Http\UploadedFile;

class PaperclipImageTest extends AbstractIntegrationTest
{
    /**
     * @test
     */
    public function it_updates_a_resource_without_an_image_for_a_model_that_has_an_image(): void
    {
        $model = ModelWithImage::factory()->create([
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $this->putJson('nova-api/' . ModelWithImageResource::uriKey() . '/' . $model->getKey())
            ->assertJsonMissingValidationErrors('image');
    }

    /**
     * @test
     */
    public function it_returns_an_error_when_updating_a_resource_without_an_image_for_a_model_that_does_not_have_an_image(): void
    {
        $model = ModelWithImage::factory()->create([
            'image' => null,
        ]);

        $this->putJson('nova-api/' . ModelWithImageResource::uriKey() . '/' . $model->getKey())
            ->assertJsonValidationErrors('image');
    }

    /**
     * @test
     */
    public function it_returns_an_error_when_updating_a_resource_without_an_image_for_a_model_that_had_an_image(): void
    {
        $model = ModelWithImage::factory()->create([
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $this->deleteJson('nova-api/' . ModelWithImageResource::uriKey() . '/' . $model->getKey() . '/field/image')
            ->assertStatus(200);

        $this->putJson('nova-api/' . ModelWithImageResource::uriKey() . '/' . $model->getKey())
            ->assertJsonValidationErrors('image');
    }
}
