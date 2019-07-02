<?php

namespace DanielDeWit\NovaPaperclip;

use Czim\Paperclip\Attachment\Attachment;
use Czim\Paperclip\Contracts\AttachmentInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class PaperclipFile extends File
{
    /**
     * @param string $name
     * @param string $attribute
     * @param string|null $disk
     * @param callable|null $storageCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = 'public', $storageCallback = null)
    {
        parent::__construct($name, $attribute, $disk, $storageCallback);

        $this
            ->resolveUsing(function (AttachmentInterface $file) {
                return $file->exists() ? $file->originalFilename() : null;
            })
            ->download(function ($request, $model) {
                /** @var Attachment $attachment */
                $attachment = $model->{$this->attribute};

                /** @var Storage $storage */
                $storage = $model->{$this->attribute}->getStorage();

                return Storage::disk($storage)->download($attachment->path(), $attachment->originalFilename());
            })
            ->delete(function (NovaRequest $request, Model $model) {
                if ( ! $this->value) {
                    return;
                }

                $model->{$this->attribute} = Attachment::NULL_ATTACHMENT;
                $model->save();

                return;
            });
    }

    public function mimes(array $mimes)
    {
        $this->withMeta([
            'mimes' => $mimes,
        ]);

        return $this;
    }

    public function min(int $min)
    {
        $this->withMeta([
            'min' => $min,
        ]);

        return $this;
    }

    public function max(int $max)
    {
        $this->withMeta([
            'max' => $max,
        ]);

        return $this;
    }

    public function size(int $size)
    {
        $this->withMeta([
            'size' => $size,
        ]);

        return $this;
    }
}
