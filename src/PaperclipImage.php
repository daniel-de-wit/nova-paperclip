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
     * @var string
     */
    public $component = 'paperclip-image';

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
            ->resolveUsing(function (AttachmentInterface $image) {
                return $image->exists() ? $image->url() : null;
            })
            ->thumbnail(function () {
                return $this->value ? $this->value : null;
            })
            ->preview(function () {
                return $this->value ? $this->value : null;
            })
            ->download(function () {
                return $this->value ? $this->value : null;
            });
    }

    public function width(int $width)
    {
        $this->withMeta([
            'width' => $width,
        ]);

        return $this;
    }

    public function minWidth(int $width)
    {
        $this->withMeta([
            'minWidth' => $width,
        ]);

        return $this;
    }

    public function maxWidth(int $width)
    {
        $this->withMeta([
            'maxWidth' => $width,
        ]);

        return $this;
    }

    public function height(int $height)
    {
        $this->withMeta([
            'height' => $height,
        ]);

        return $this;
    }

    public function minHeight(int $height)
    {
        $this->withMeta([
            'minHeight' => $height,
        ]);

        return $this;
    }

    public function maxHeight(int $height)
    {
        $this->withMeta([
            'maxHeight' => $height,
        ]);

        return $this;
    }
}
