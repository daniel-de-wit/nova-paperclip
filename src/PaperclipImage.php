<?php

namespace DanielDeWit\NovaPaperclip;

use Czim\Paperclip\Contracts\AttachmentInterface;

class PaperclipImage extends PaperclipFile
{
    /**
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string  $attribute
     * @param  string|null  $disk
     * @param  callable|null  $storageCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = 'public', $storageCallback = null)
    {
        parent::__construct($name, $attribute, $disk, $storageCallback);

        $this
            ->resolveUsing(function ($image, $resource, $attribute) {
                /** @var AttachmentInterface $image */
                return $image->exists() ? $image->url() : null;
            })
            ->thumbnail(function ($value, string $disk, $resource): ?string {
                /** @var string|null $thumbnail */
                $thumbnail = $this->value;

                return $thumbnail;
            });
    }

    public function width(int $width): self
    {
        $this->withMeta([
            'width' => $width,
        ]);

        return $this;
    }

    public function minWidth(int $width): self
    {
        $this->withMeta([
            'minWidth' => $width,
        ]);

        return $this;
    }

    public function maxWidth(int $width): self
    {
        $this->withMeta([
            'maxWidth' => $width,
        ]);

        return $this;
    }

    public function height(int $height): self
    {
        $this->withMeta([
            'height' => $height,
        ]);

        return $this;
    }

    public function minHeight(int $height): self
    {
        $this->withMeta([
            'minHeight' => $height,
        ]);

        return $this;
    }

    public function maxHeight(int $height): self
    {
        $this->withMeta([
            'maxHeight' => $height,
        ]);

        return $this;
    }
}
