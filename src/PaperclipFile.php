<?php

namespace DanielDeWit\NovaPaperclip;

use Czim\Paperclip\Attachment\Attachment;
use Czim\Paperclip\Contracts\AttachmentInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;

class PaperclipFile extends File
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @param  string  $name
     * @param  string  $attribute
     * @param  string|null  $disk
     * @param  callable|null  $storageCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = 'public', $storageCallback = null)
    {
        parent::__construct($name, $attribute, $disk, $storageCallback);

        $this->prepareStorageCallback($storageCallback);

        $this
            ->resolveUsing(function (AttachmentInterface $file) {
                return null;
            })
            ->thumbnail(function () {
                return null;
            })
            ->preview(function () {
                return null;
            })
            ->download(function () {
                return $this->value ? $this->value : null;
            })
            ->delete(function (NovaRequest $request, Model $model) {
                $model->{$this->attribute} = Attachment::NULL_ATTACHMENT;
                $model->save();
                return;
            });
    }

    /**
     * Prepare the storage callback.
     *
     * @param  callable|null  $storageCallback
     * @return void
     */
    protected function prepareStorageCallback($storageCallback)
    {
        $this->storageCallback = function ($request, $model) {
            if ($request->{$this->attribute}) {
                $model->{$this->attribute} = $request->{$this->attribute};
            }
        };
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
