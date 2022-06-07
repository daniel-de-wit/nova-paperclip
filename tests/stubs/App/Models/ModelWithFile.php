<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\stubs\App\Models;

use Czim\Paperclip\Contracts\AttachableInterface;
use Czim\Paperclip\Model\PaperclipTrait;
use DanielDeWit\NovaPaperclip\Tests\stubs\database\factories\ModelWithFileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelWithFile extends Model implements AttachableInterface
{
    use HasFactory;
    use PaperclipTrait;

    protected $table = 'models_with_file';

    /**
     * @var string[]
     */
    protected $fillable = [
        'file',
    ];

    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->hasAttachedFile('file');

        parent::__construct($attributes);
    }

    protected static function newFactory(): ModelWithFileFactory
    {
        return new ModelWithFileFactory();
    }
}
