<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   MIT
 */

namespace craft\contactform\honeypot;

use Craft;
use craft\contactform\events\SendEvent;
use craft\contactform\Mailer;
use yii\base\Event;

/**
 * Class Plugin
 *
 * @property Settings $settings
 * @method Settings getSettings()
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(Mailer::class, Mailer::EVENT_BEFORE_SEND, function(SendEvent $e) {
            $settings = $this->getSettings();

            if (!$settings->honeypotParam) {
                Craft::warning('Couldn\'t check honeypot field because the "Honeypot Form Param" setting isn\'t set yet.');
                return;
            }

            $val = Craft::$app->getRequest()->getBodyParam($settings->honeypotParam);

            if ($val === null) {
                Craft::warning('Couldn\'t check honeypot field because no POST parameter named "'.$settings->honeypotParam.'" exists.');
                return;
            }

            // All conditions are favorable
            if ($val !== '') {
                $e->isSpam = true;
            }
        });
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->id));

        return Craft::$app->view->renderTemplate('contact-form-honeypot/_settings', [
            'settings' => $this->getSettings(),
            'overrides' => array_keys($overrides),
        ]);
    }
}
