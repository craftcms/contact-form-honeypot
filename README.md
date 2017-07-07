# Contact Form Honeypot plugin for Craft

This plugin allows you to add a [honeypot captcha](http://haacked.com/archive/2007/09/11/honeypot-captcha.aspx/) to your Craft CMS contact form.


## Requirements

This plugin requires Craft CMS 3.0.0-beta.20 or later, and the [Contact Form](https://github.com/craftcms/contact-form) plugin.


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require craftcms/contact-form-honeypot

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Contact Form Honeypot.


## Setup

To configure the plugin, go to Settings → Contact Form Honeypot, and choose a param name that your honeypot field should have.

Then edit your contact form template(s), and add the honeypot field.

```html
<input id="secretHoneypotParamName" name="secretHoneypotParamName" type="text">
```

You can hide the field with CSS:

```css
input#secretHoneypotParamName { display: none; }
```
