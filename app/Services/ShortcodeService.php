<?php

use Illuminate\Support\Facades\View;
use Shortcode\ShortcodeInterface;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ShortcodeManager
{
    // ... (Your handler registration logic)

    public function handle_register(ShortcodeInterface $s)
    {
        try {
            // 1. Set any required variables (like page title, using trans() for translations)
            $page_title = trans('auth.register');
            request()->merge(['page_title' => $page_title]);

            // 2. Get parameters passed to the shortcode (if any)
            $view_data = $s->getParameters();

            // 3. Render the Blade view and return the HTML output
            // Ensure the path below correctly resolves to your saved file.
            $html = View::make('shortcodes.cms_register', $view_data)->render();

            return $html;
        } catch (\Exception $e) {
            \Log::error('UnifyAMS Register Shortcode Failed: '.$e->getMessage());

            return '';
        }
    }

    // 4. Register the handler so the system knows what to call
    public function registerHandlers()
    {
        $this->handlers->add('cms_register', function (ShortcodeInterface $s) {
            return $this->handle_register($s);
        });
    }
}
