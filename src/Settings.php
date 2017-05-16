<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\contactform\honeypot;

use craft\base\Model;

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
