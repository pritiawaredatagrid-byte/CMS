<?php

namespace App\Shortcodes;

use App\Services\ShortcodeService;
use Exception;
use Illuminate\Support\Facades\Log;

class ShortcodeManager
{
    protected $handlers = [];

    public function __construct()
    {
        $this->registerHandlers();
    }

    public function handle_subscription_form($s): string
    {
        try {
            $html = ShortcodeService::getUnifyAMSForm();

            return $html;
        } catch (Exception $e) {
            Log::error('Subscription Form Shortcode Failed: '.$e->getMessage());

            return '<!-- Shortcode Error: Subscription Form -->';
        }
    }

    public function parseContent(string $content): string
    {

        $content = preg_replace_callback(
            '/\[(subscribe_form)([^\]]*)\]/',
            function ($matches) {
                $shortcode_name = $matches[1];

                if ($shortcode_name === 'subscribe_form') {

                    return $this->handle_subscription_form(null);
                }

                return $matches[0];
            },
            $content
        );

        return $content;
    }

    public function registerHandlers(): void
    {
        $this->handlers['subscribe_form'] = function ($attributes, $content = null) {
            return $this->handle_subscription_form($attributes);
        };

    }
}
