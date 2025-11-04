<?php

namespace App\Providers;

use App\Services\AI\Contracts\AIClientInterface;
use App\Services\AI\OllamaClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\Actor\Contracts\ActorDataParserInterface::class,
            \App\Services\Actor\ActorDataParser::class
        );

        $this->app->bind(AIClientInterface::class, function () {
            return new OllamaClient(
                config('services.ollama.base_url'),
                config('services.ollama.model')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
