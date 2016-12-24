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
    'relativeToRoot' => './',
    'globals' => Utils::getGlobalData(),
    'options' => [
        'scripts' => [
            'css' => [
                'main' => './export/css/style.css',
                'critical' => './export/css/critical.css'
            ],
            'js' => [
                'main' => './export/js/app.js',
                'embed' => [
                    "./export/js/embed/_main.js",
                    "./export/js/embed/animationFrame.js",
                    "./export/js/embed/agency_pkg_polyfills.js",
                    "./export/js/embed/agency_pkg_service_dev_tools.js"
                ]
            ]
        ],
        'server' => [
            'dest' => './'
        ]
    ]
];
// Load index data
$data = array_merge($data, json_decode(file_get_contents(__DIR__ . '/data/index.json'), true));

// Render page "index" with data
echo html_entity_decode(Utils::renderPage($core, 'index', $data));

?>
