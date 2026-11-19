<?php

namespace Yu\SecurityCheck;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Yu\SecurityCheck\Livewire\SecurityCheckComponent;

class SecurityCheckServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/security-check.php', 'security-check');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'security-check');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'security-check');

        // The name is required: without it Livewire 4 makes up a hash and <livewire:security-check /> is not found
        Livewire::component('security-check', SecurityCheckComponent::class);
    }
}
