<?php

namespace AgencyFramework\ExportPreview;

class Utils {

    public static function getGlobalData()
    {
        $data = [];
        $files = glob(__DIR__ . '/export/data/globals/*.json');
        foreach ($files as $filename) {
            $name = preg_replace('/.*\/data\/(.*)\..*$/', '$1', $filename, 1);
            $fileData = json_decode(file_get_contents($filename), true);
            if (preg_replace('/.*\/([^\/]*)\..*$/', '$1', $filename, 1) === 'fonts') {
                for ($i = 0; $i < count($fileData); $i++) {
                    $fileData[$i]['path'] = 'export/' . $fileData[$i]['path'];
                }
            }
            \AgencyFramework\Handlebars\Core::setVarDeep($name, $fileData, $data);
        }

        return $data;
    }

    /**
     * @param \AgencyFramework\Handlebars\Core $core
     * @param string $pagePath
     * @param array $data
     * @return mixed
     */
    public static function renderPage($core, $pagePath, $data)
    {
        $body = $core->getEngine()->render('index', $data);
        return str_replace('{% body %}', $body, $core->getEngine()->render($core->getDefaultPartialData($pagePath)['layout'], $data));
    }

}

?>