<?php

declare(strict_types=1);

namespace CraftCms\ContactForm\Honeypot;

use CraftCms\Cms\Plugin\Plugin as BasePlugin;
use CraftCms\Cms\Ui\Controls\Text;
use CraftCms\Cms\Ui\Enums\ControlMode;
use CraftCms\Cms\Ui\Nodes\Field;
use CraftCms\Cms\Ui\Ui;
use CraftCms\Cms\Ui\UiContext;
use CraftCms\Cms\Validation\Events\ValidationRulesResolving;
use CraftCms\ContactForm\Events\MessageSending;
use CraftCms\ContactForm\Validation\SubmissionRuleset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

use function CraftCms\Cms\t;

/**
 * @method Settings getSettings()
 */
class Plugin extends BasePlugin
{
    public bool $hasCpSettings = true;

    public function boot(): void
    {
        Event::listen(function (ValidationRulesResolving $event) {
            if (! $event->ruleset instanceof SubmissionRuleset) {
                return;
            }

            $param = $this->getSettings()->honeypotParam;

            if (! $param) {
                Log::warning('Couldn’t check honeypot field because the “Honeypot Form Param” setting is empty.');

                return;
            }

            // Permit any value, so the field reaches the message variables, where a filled-in value marks the submission as spam:
            $event->addRule($param, 'nullable');
        });

        Event::listen(function (MessageSending $event) {
            $param = $this->getSettings()->honeypotParam;

            // Empty values are converted to `null` by the request middleware, so only a filled-in field is set:
            if ($param && isset($event->message->variables[$param])) {
                $event->isSpam = true;
            }
        });
    }

    protected static function createSettings(): Settings
    {
        return new Settings;
    }

    public function settingsUi(UiContext $context = new UiContext): Ui
    {
        $control = Text::make('honeypotParam')->monospace();
        $field = Field::make(t('Honeypot Form Param', category: 'contact-form-honeypot'), $control)
            ->instructions(t('The `name` that the honeypot input is expected to have.', category: 'contact-form-honeypot'));

        // Settings defined by the config file can’t be changed here:
        if (array_key_exists('honeypotParam', config("craft.$this->handle", []))) {
            $control->mode(ControlMode::ReadOnly);
            $field->warning(t('This is being overridden by the {setting} config setting in your {file} config file.', [
                'setting' => '`honeypotParam`',
                'file' => '`config/craft/contact-form-honeypot.php`',
            ], 'contact-form-honeypot'));
        }

        return Ui::make([$field]);
    }
}
