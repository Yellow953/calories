<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (! function_exists('gtrans')) {
    /**
     * Translate a string to the current locale, cached for 30 days.
     *
     * Returns the original text for English (or on any failure) so a slow or
     * failing Google Translate request can never block or break a page render.
     */
    function gtrans(?string $text): string
    {
        $text = trim((string) $text);
        $locale = app()->getLocale();

        if ($text === '' || $locale === 'en') {
            return $text;
        }

        return Cache::remember(
            'gtrans:' . $locale . ':' . md5($text),
            now()->addDays(30),
            function () use ($text, $locale) {
                try {
                    return (new GoogleTranslate())->setTarget($locale)->translate($text) ?? $text;
                } catch (\Throwable $e) {
                    Log::warning('gtrans failed: ' . $e->getMessage());

                    return $text;
                }
            }
        );
    }
}
