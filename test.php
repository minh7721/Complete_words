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
if (file_exists("result.txt")) {
    unlink("result.txt");
}
foreach ($files as $file) {
    if (str_contains($file,"_text")){
        continue;
    }
    $info = pathinfo($file);
    $results = [];
    if (file_exists($dictionary = __DIR__ . "/test/{$info['filename']}_text.txt")
        && file_exists($cases_file = __DIR__ . "/test/{$info['filename']}.txt")
        && $cases = array_filter(explode("\n", file_get_contents($cases_file)))) {
        dump($results[] = "testing {$info['filename']}:");
        $helper = new Complete_words($dictionary);
        foreach ($cases as $case) {
            dump($results[] = $case, $results[] = "=====>" . $helper->completeWords($case));
        }
        file_put_contents('result.txt', implode(PHP_EOL, $results) . PHP_EOL . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}

