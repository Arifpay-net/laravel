<?php

namespace Arifpay\Arifpay;

use Arifpay\Arifpay\Commands\ArifpayCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ArifpayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('arifpay')
            ->hasConfigFile()
            ->hasMigration('create_arifpay_table')
            ->hasRoute('api')
            ->hasCommand(ArifpayCommand::class);
    }
}
