<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   MIT
 */

namespace craft\contactform\honeypot;

use craft\base\Model;

/**
 * Class Settings
 */
class Settings extends Model
{
    /**
     * @var string|null
     */
    public $honeypotParam;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['honeypotParam'], 'string'],
        ];
    }
}
