<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\stubs\database\factories;

use DanielDeWit\NovaPaperclip\Tests\stubs\App\Models\User;
use Orchestra\Testbench\Factories\UserFactory as BaseUserFactory;

class UserFactory extends BaseUserFactory
{
    protected $model = User::class;
}
