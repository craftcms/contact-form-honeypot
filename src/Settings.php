<?php

namespace CraftCms\ContactForm\Honeypot;

use CraftCms\Cms\Plugin\PluginSettings;

class Settings extends PluginSettings
{
    public ?string $honeypotParam = null;

    public function getRules(): array
    {
        return [
            'honeypotParam' => 'string',
        ];
    }
}
