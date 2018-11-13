yii2-jsdata
===========

This package provides a framework for passing data from Yii 2.0
applications to Javascript.


Installation
------------

```
$ composer require flaviovs/yii2-jsdata
```


Setup
-----

**Step 1** -- Setup **yii2-jsdata** as a standard Yii2 component in
your web app configuration:

```php
[
	'components' => [
		'jsdata' => [
			'class' => \fv\yii\jsdata\Component::class,
		],
	]
]
```

**Step 2** -- Bootstrap the component in the web app:

```php
[
	'bootstrap' => ['jsdata'],
]
```


Usage
-----

Use the `data` attribute in the `jsdata` component to pass data from PHP to
Javascript. Use the `appData` object in Javascript to get the data. Examples:

```php
// Pass a simple value to Javascript (this goes in a controller or view.)
\Yii::$app->jsdata->data['message'] = 'Hello World!';
```

```javascript
// Now access the data in Javascript.
alert(window.appData.message);
```

Notice that you can pass any values or data structure that can be converted
from PHP to Javascript. You can also use [yii\web\JsExpression] to pass
complex Javascript expressions:

```php
// Pass a simple value to Javascript (this goes in a controller or view.)
\Yii::$app->jsdata->data['now'] = new \yii\web\JsExpression('new Date()');
```

**Note**: Usually Javascript data is initialized _before_ any other script
is run in the page. That means that you cannot use expressions that depends
on other scripts (for example, jQuery).


Options
-------

The `jsdata` component accepts the following options:

* `varName` -- the name of the global Javascript data variable. Default
"appData".

* `encodeOptions` -- Javascript encoding options. See
http://php.net/manual/en/function.json-encode.php for all available
constants. **Note**: for security reasons, `JSON_UNESCAPED_UNICODE` and
`JSON_UNESCAPED_SLASHES` are always removed.


Issues
------

Visit: https://github.com/flaviovs/yii2-jsdata

[yii\web\JsExpression]: http://www.yiiframework.com/doc-2.0/yii-web-jsexpression.html
