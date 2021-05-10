<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\stubs\App\Models;

use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use DanielDeWit\NovaPaperclip\Tests\stubs\database\factories\ModelWithImageFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelWithImage extends Model implements AttachableInterface
{
    use HasFactory;
    use PaperclipTrait;

    protected $table = 'models_with_image';

    /**
     * @var string[]
     */
    protected $fillable = [
        'image',
    ];

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('image');

        parent::__construct($attributes);
    }

    protected static function newFactory(): Factory
    {
        return new ModelWithImageFactory();
    }
}
