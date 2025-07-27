<?php

namespace App\Providers;

use Illuminate\Support\HtmlString;

/**
 * Для возможности держать vite часть отдельно от backend для дева
 * Vite очень дыряв в dev режиме, поэтому открытыми портами держать его нельзя
 */
class ViteServiceProvider
{
    public function asset(string $entry): HtmlString
    {
        if (!app()->environment('production')) {
            $viteCookie = request()->cookie('VITE_DEV', '');
            if (!empty($viteCookie)) {
                $devHost = match ($viteCookie) {
                    'TRUE' => config('app.frontend_url'),
                    default => $viteCookie,
                };

                return new HtmlString("
                    <script type=\"module\" src=\"{$devHost}/@vite/client\"></script>
                    <script type=\"module\" src=\"{$devHost}/{$entry}\"></script>
                ");
            }
        }

        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);

        if (!isset($manifest[$entry])) {
            throw new \Exception("Vite asset not found: $entry");
        }

        $path = asset("build/" . $manifest[$entry]['file']);

        return new HtmlString("<script type=\"module\" src=\"{$path}\"></script>");
    }
}
