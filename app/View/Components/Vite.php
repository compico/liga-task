<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\HtmlString;

class Vite extends Component
{
    public string $asset;

    public function __construct(string $asset)
    {
        $this->asset = $asset;
    }

    public function render(): HtmlString
    {
        if (!app()->environment('production')) {
            $viteCookie = request()->cookie('VITE_DEV', '');
            if (!empty($viteCookie)) {
                $devHost = match ($viteCookie) {
                    'TRUE' => config('app.frontend_url'),
                    default => $viteCookie,
                };
                return new HtmlString(implode("\n", [
                    "<script type=\"module\" src=\"{$devHost}/@vite/client\"></script>",
                    "<script type=\"module\" src=\"{$devHost}/{$this->asset}\"></script>",
                ]));
            }
        }

        $manifestPath = public_path('build/manifest.json');

        if (!file_exists($manifestPath)) {
            throw new \Exception("Vite manifest not found");
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (!isset($manifest[$this->asset])) {
            throw new \Exception("Vite asset not found: {$this->asset}");
        }

        $path = asset("build/" . $manifest[$this->asset]['file']);

        return new HtmlString("<script type=\"module\" src=\"{$path}\"></script>");
    }
}
