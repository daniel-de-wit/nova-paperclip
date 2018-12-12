# nova-paperclip
Laravel Nova fields for laravel-paperclip attachments.

![Screenshot](https://github.com/daniel-de-wit/nova-paperclip/raw/master/screenshot.png)

## Installation

```
composer update daniel-de-wit/nova-paperclip
```

## Fields

 - PaperclipFile
 - PaperclipImage
 - PaperclipVideo

## Usage

Add to Nova resource

```php
<?php

namespace App\Nova;

use DanielDeWit\NovaPaperclip\PaperclipImage;


class MyResource extends Resource
{
    public function fields(Request $request): array
    {
        return [
            PaperclipImage::make('My Paperclip Image', 'image')
                ->mimes(['png'])
                ->width(1080)
                ->height(1080)
                ->rules(
                    'required',
                    'mimetypes:image/png',
                    'mimes:png',
                    'dimensions:width=1080,height=1080'
                ),
        ];
    }
}
```

The extra methods such as `width()` and `height()` are currently only used for display. Rules should still be set manually.
