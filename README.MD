# export-preview.php

Render Agency-Boilerplate Export with PHP.

## Installation

Installation requires [Composer](https://getcomposer.org/).

```
./agency-framework/export-preview.php $ composer install
```

## Use

```php

<?php

namespace AgencyFramework\ExportPreview;
use AgencyFramework\Handlebars\Core;

require __DIR__ . '/utils.php';
require __DIR__ . '/vendor/autoload.php';
$core = Core::init([
    'partialDir' => [__DIR__ . '/export/tmpl/', __DIR__ . '/tmpl/'],
]);

// Initialize data & load global data
$data = [
    'globals' => Utils::getGlobalData()
];
// Load index data
$data = array_merge($data, json_decode(file_get_contents(__DIR__ . '/data/index.json'), true));

// Render page "index" with data
echo html_entity_decode(Utils::renderPage($core, 'index', $data));

?>

```
