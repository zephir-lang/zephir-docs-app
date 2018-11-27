<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs\Cli\Tasks;

use Phalcon\CLI\Task;
use function asort;
use function Docs\Functions\app_path;
use function Docs\Functions\env;
use function file_put_contents;
use function json_decode;
use function sprintf;
use const PHP_EOL;

/**
 * GetLanguagesTask
 */
class GetLanguagesTask extends Task
{
    /**
     * Calls the Crowdin API to get the languages available
     */
    public function mainAction()
    {
        echo 'Getting Languages from Crowdin...' . PHP_EOL;
        $template = 'https://api.crowdin.com/api/project/zephir-documentation/info?key=%s&json';
        $url      = sprintf($template, env('CROWDIN_API_KEY'), '');

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, ['json' => 1]);

        $fileName         = app_path('/storage/crowdin/crowdin.json');
        $results          = curl_exec($handle);
        $errorNumber      = curl_errno($handle);
        $errorDescription = curl_error($handle);
        curl_close($handle);

        if ($errorNumber > 0) {
            $results = '[]';
            echo $errorDescription . PHP_EOL;
        }

        $crowdin   = json_decode($results, true);
        $languages = [];
        foreach ($crowdin['languages'] as $language) {
            $languages[$language['code']] = $language['name'];
        }

        $versions = [];
        foreach ($crowdin['files'] as $file) {
            if ('branch' === $file['node_type']) {
                $versions[] = $file['name'];
            }
        }

        asort($languages);
        arsort($versions);

        $data = [
            'languages' => $languages,
            'versions'  => $versions,
        ];

        file_put_contents($fileName, json_encode($data));

        echo 'Updated languages.' . PHP_EOL;
    }
}
