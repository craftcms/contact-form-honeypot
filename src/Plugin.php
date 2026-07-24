<?php

namespace CraftCms\ContactForm\Honeypot;

use CraftCms\Cms\Plugin\Plugin as BasePlugin;
use CraftCms\Cms\Validation\Events\ValidationRulesResolving;
use CraftCms\ContactForm\Events\MessageSending;
use CraftCms\ContactForm\Validation\SubmissionRuleset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

use function CraftCms\Cms\template;

class Plugin extends BasePlugin
{
    public bool $hasCpSettings = true;

    public function boot(): void
    {
        Event::listen(function (ValidationRulesResolving $event) {
            if (! $event->ruleset instanceof SubmissionRuleset) {
                return;
            }

            /** @todo Investigate why $this->getSettings() doesn’t work in here! */
            /** @var Settings $settings */
            $settings = Plugin::getInstance()->getSettings();

            if (! $settings->honeypotParam) {
                Log::warning('Couldn’t check honeypot field because the “Honeypot Form Param” setting is empty.');

                return;
            }

            // $event->addRule($settings->honeypotParam, 'prohibited');
            // What if we just permit the value, and check its presence later?
            $event->addRule($settings->honeypotParam, ['nullable', 'string']);
        });

        Event::listen(function (MessageSending $event) {
            /** @var Settings $settings */
            $settings = Plugin::getInstance()->getSettings();

            if (isset($event->message->variables[$settings->honeypotParam])) {
                $event->isSpam = true;
            }
        });
    }

    protected function createSettingsModel(): ?Settings
    {
        return new Settings;
    }

    protected function settingsHtml(): ?string
    {
        // Get the settings that are being defined by the config file
        $overrides = config('craft.'.strtolower($this->handle), []);

        return template('contact-form-honeypot/_settings', [
            'settings' => $this->getSettings(),
            'overrides' => array_keys($overrides),
        ]);
    }
}
