# Contact Form Honeypot plugin for Craft

This plugin allows you to add a [honeypot captcha](http://haacked.com/archive/2007/09/11/honeypot-captcha.aspx/) to your Craft CMS contact form.


## Requirements

This plugin requires Craft CMS 6.0 or later, PHP 8.5 or later, and [Contact Form](https://github.com/craftcms/contact-form) 4.0 or later. It doesn’t need the `craftcms/yii2-adapter` package.


## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Contact Form Honeypot”. Then click on the “Install” button in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require craftcms/contact-form-honeypot

# tell Craft to install the plugin
php artisan craft:plugin:install contact-form-honeypot
```

## Setup

To configure the plugin, go to Settings → Contact Form Honeypot, and choose a param name that your honeypot field should have.

You can also set it in `config/craft/contact-form-honeypot.php`, which overrides the control panel setting:

```php
<?php

return [
    'honeypotParam' => 'secretHoneypotParamName',
];
```

Then edit your contact form template(s), and add the honeypot field.

```html
<input id="secretHoneypotParamName" name="secretHoneypotParamName" type="text">
```

You can hide the field with CSS:

```css
input#secretHoneypotParamName { display: none; }
```

Any non-empty value in the honeypot field marks the submission as spam, so Contact Form doesn’t send it and responds with its generic error message. Values containing only whitespace are trimmed to empty by Laravel, so they aren’t treated as spam.
