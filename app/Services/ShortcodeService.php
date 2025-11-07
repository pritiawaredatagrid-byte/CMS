<?php

namespace App\Services;

use App\Shortcodes\ShortcodeManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ShortcodeService
{
    protected $manager;

    public function __construct(ShortcodeManager $manager)
    {
        $this->manager = $manager;
    }

    public function parse(string $content): string
    {

        return $this->manager->parseContent($content);
    }

    public static function getUnifyAMSForm(): string
    {
        try {

            if (View::exists('shortcodes.subscribe_form')) {
                return View::make('shortcodes.subscribe_form')->render();
            }

            return '<!-- ERROR: Shortcode view "shortcodes.subscribe_form" not found. Ensure the file exists in resources/views/shortcodes/subscribe_form.blade.php -->';
        } catch (\Exception $e) {
            Log::error('Shortcode View Rendering Failed: '.$e->getMessage());

            return '<!-- ERROR: View failed to render -->';
        }
    }
}
