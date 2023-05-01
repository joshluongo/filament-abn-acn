<?php

namespace Joshluongo\FilamentAbnAcn;

use Spatie\LaravelPackageTools\Package;

class AbnAcnServiceProvider extends \Spatie\LaravelPackageTools\PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-abn-acn')
            ->hasTranslations();
    }
}
