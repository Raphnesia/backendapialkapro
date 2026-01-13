<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Number;

class IntlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register polyfill for intl extension
        if (!extension_loaded('intl')) {
            // Load polyfill classes
            if (!class_exists('NumberFormatter')) {
                require_once __DIR__ . '/../../vendor/symfony/polyfill-intl-icu/Intl/NumberFormatter.php';
            }
            if (!class_exists('IntlDateFormatter')) {
                require_once __DIR__ . '/../../vendor/symfony/polyfill-intl-icu/Intl/DateFormatter.php';
            }
            if (!class_exists('Locale')) {
                require_once __DIR__ . '/../../vendor/symfony/polyfill-intl-icu/Locale.php';
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override Number::format method if intl extension is not available
        if (!extension_loaded('intl')) {
            // Override the ensureIntlExtensionIsInstalled method
            Number::macro('ensureIntlExtensionIsInstalled', function () {
                // Do nothing - bypass the check
                return true;
            });
            
            // Override the format method
            Number::macro('format', function ($number, $locale = null) {
                // Simple number formatting fallback
                return number_format($number, 2);
            });
            
            // Override the currency method
            Number::macro('currency', function ($number, $currency = 'USD', $locale = null) {
                // Simple currency formatting fallback
                return $currency . ' ' . number_format($number, 2);
            });
            
            // Override the percentage method
            Number::macro('percentage', function ($number, $precision = 0, $locale = null) {
                // Simple percentage formatting fallback
                return number_format($number, $precision) . '%';
            });
            
            // Override the fileSize method
            Number::macro('fileSize', function ($bytes, $precision = 2) {
                // Simple file size formatting fallback
                $units = ['B', 'KB', 'MB', 'GB', 'TB'];
                $bytes = max($bytes, 0);
                $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
                $pow = min($pow, count($units) - 1);
                $bytes /= pow(1024, $pow);
                return round($bytes, $precision) . ' ' . $units[$pow];
            });
        }
    }
}
