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

        $this->prepareStorageCallback($storageCallback);

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

    /**
     * @param NovaRequest $request
     * @return mixed[]
     */
    public function getUpdateRules(NovaRequest $request): array
    {
        $rules = parent::getUpdateRules($request);

        if (! array_key_exists($this->attribute, $rules)) {
            return $rules;
        }

        if (! in_array('required', $rules[$this->attribute])) {
            return $rules;
        }

        $model = $request->findModelOrFail($request->route('resourceId'));

        /** @var AttachmentInterface $attachment */
        $attachment = $model->getAttribute($this->attribute);

        if ($attachment->exists()) {
            $requiredIndex = array_search('required', $rules[$this->attribute]);

            unset($rules[$this->attribute][$requiredIndex]);
        }

        return $rules;
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
