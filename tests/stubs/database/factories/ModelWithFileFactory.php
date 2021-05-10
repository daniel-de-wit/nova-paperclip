<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\stubs\database\factories;

use DanielDeWit\NovaPaperclip\Tests\stubs\App\Models\ModelWithFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelWithFileFactory extends Factory
{
    protected $model = ModelWithFile::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file' => null,
        ];
    }
}
