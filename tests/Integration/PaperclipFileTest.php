<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\Integration;

use DanielDeWit\NovaPaperclip\Tests\stubs\App\Models\ModelWithFile;
use DanielDeWit\NovaPaperclip\Tests\stubs\App\Nova\Resources\ModelWithFileResource;
use Illuminate\Http\UploadedFile;

class PaperclipFileTest extends AbstractIntegrationTest
{
    /**
     * @test
     */
    public function it_updates_a_resource_without_a_file_for_a_model_that_has_a_file(): void
    {
        $model = ModelWithFile::factory()->create([
            'file' => UploadedFile::fake()->create('document.pdf', 1024),
        ]);

        $this->putJson('nova-api/' . ModelWithFileResource::uriKey() . '/' . $model->getKey())
            ->assertJsonMissingValidationErrors('file');
    }

    /**
     * @test
     */
    public function it_returns_an_error_when_updating_a_resource_without_a_file_for_a_model_that_does_not_have_a_file(): void
    {
        $model = ModelWithFile::factory()->create([
            'file' => null,
        ]);

        $this->putJson('nova-api/' . ModelWithFileResource::uriKey() . '/' . $model->getKey())
            ->assertJsonValidationErrors('file');
    }

    /**
     * @test
     */
    public function it_returns_an_error_when_updating_a_resource_without_a_file_for_a_model_that_had_a_file(): void
    {
        $model = ModelWithFile::factory()->create([
            'file' => UploadedFile::fake()->create('document.pdf', 1024),
        ]);

        $this->deleteJson('nova-api/' . ModelWithFileResource::uriKey() . '/' . $model->getKey() . '/field/file')
            ->assertStatus(200);

        $this->putJson('nova-api/' . ModelWithFileResource::uriKey() . '/' . $model->getKey())
            ->assertJsonValidationErrors('file');
    }
}
