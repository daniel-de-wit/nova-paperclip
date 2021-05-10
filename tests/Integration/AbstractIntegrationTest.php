<?php

declare(strict_types=1);

namespace DanielDeWit\NovaPaperclip\Tests\Integration;

use Czim\Paperclip\Providers\PaperclipServiceProvider;
use DanielDeWit\NovaPaperclip\Tests\stubs\App\Models\User;
use DanielDeWit\NovaPaperclip\Tests\stubs\App\Providers\NovaServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Nova\NovaCoreServiceProvider;
use Orchestra\Testbench\TestCase;

class AbstractIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::factory()->create());
    }

    /**
     * @param Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            NovaCoreServiceProvider::class,
            NovaServiceProvider::class,
            PaperclipServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom($this->getStubsPath('database' . DIRECTORY_SEPARATOR . 'migrations'));
    }

    /**
     * @param Application $app
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('paperclip.storage.disk', 'public');
    }

    protected function getStubsPath(string $path): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $path;
    }
}
