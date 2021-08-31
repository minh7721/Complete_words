<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 31/08/2021
 * Time: 14:17
 */

require_once "vendor/autoload.php";

use Nguyenhiep\CompleteWords\Complete_words;

$files = array_diff(scandir(__DIR__ . "/test"), ['.', '..']);
foreach ($files as $file) {
    if (!str_contains($file, "pdf")) {
        continue;
    }
    $info = pathinfo($file);
    if (file_exists($dictionary = __DIR__ . "/test/{$info['filename']}_text.txt")
        && file_exists($cases_file = __DIR__ . "/test/{$info['filename']}.txt")
        && $cases = array_filter(explode("\n", file_get_contents($cases_file)))) {
        dump("testing {$info['filename']}");
        $helper = new Complete_words($dictionary);
        foreach ($cases as $case) {
            dump($case, $helper->completeWords($case));
        }
    }
}

