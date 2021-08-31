<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 25/08/2021
 * Time: 17:07
 */

require_once __DIR__ . "/vendor/autoload.php";

use Illuminate\Support\Arr;

class Complete_words
{
    protected string $dictionary;

    public function __construct(string $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Complete vietnamese words was wrong space
     *
     *
     * @param string $input
     * @return string
     */
    public function completeWords(string $input): string
    {
        $found_in   = explode(" ", $input);
        $acceptable = [];
        $max        = count($found_in);
        for ($i = 0; $i < $max; $i++) {
            $tmp_word = Arr::get($found_in, $i);
            if ($this->checkValidWord($tmp_word)) {
                $acceptable[] = $tmp_word;
                $this->completeWord($tmp_word, $i, $acceptable, $found_in, false, 1, false);
            } else if ($this->completeWord($tmp_word, $i, $acceptable, $found_in, true, 1)
                && $this->completeWord($tmp_word, $i, $acceptable, $found_in)) {
                $acceptable[] = Arr::get($found_in, $i, "");
            }
        }
        return $this->optimizeAcceptable($acceptable);
    }

    /**
     * optimize acceptable by merge single character with before element
     * or split before element acceptable and merge with single character
     *
     *
     * @param array $acceptable
     * @return string
     */
    protected function optimizeAcceptable(array $acceptable): string
    {
        foreach ($acceptable as $key => $item) {
            if ($key && mb_strlen($item) === 1) {
                if (mb_strlen(Arr::get($acceptable, $key + 1, "")) === 1) {
                    $acceptable[$key + 1] = $item . $acceptable[$key + 1];
                    unset($acceptable[$key]);
                    continue;
                }
                if ($this->checkValidWord($new_item = $acceptable[$key - 1] . $item)
                    || ($this->checkValidWord($new_item = substr($acceptable[$key - 1], 0, -1))
                        && $this->checkValidWord($new_item1 = substr($acceptable[$key - 1], -1) . $item))) {
                    $acceptable[$key - 1] = $new_item;
                    if (isset($new_item1)) {
                        $acceptable[$key] = $new_item1;
                    } else {
                        unset($acceptable[$key]);
                    }
                    continue;
                }
            }
            if ($this->checkValidWord($new_item = $item . Arr::get($acceptable, $key + 1, "")) &&
                !$this->checkValidWord(Arr::get($acceptable, $key + 1, ""))) {
                $acceptable[$key + 1] = $new_item;
                unset($acceptable[$key]);
            }
        }
        return implode(" ", $acceptable);
    }

    /**
     * Complete word by merge next element with last acceptable found or current string
     *
     *
     * @param string $current_string
     * @param int $current_position
     * @param array $acceptable
     * @param array $found_in
     * @param bool $use_current
     * @param int $step
     * @param bool $break
     * @return string
     */
    protected function completeWord(string &$current_string, int &$current_position, array &$acceptable, array $found_in, bool $use_current = false, int $step = 0, bool $break = true): string
    {
        $next      = $current_position + $step;
        $tries     = 0;
        $max       = count($found_in);
        $_tmp_word = $use_current ? $current_string : Arr::get($acceptable, $last_accept = array_key_last($acceptable), "");
        if (is_array($_tmp_word)) {
            $_tmp_word = "";
        }
        do {
            $_tmp_word .= Arr::get($found_in, $next, "");
            if ($valid = $this->checkValidWord($_tmp_word)) {
                if (isset($last_accept)) {
                    $acceptable[$last_accept] = $_tmp_word;
                } else {
                    $acceptable[] = $_tmp_word;
                }
                $current_string   = "";
                $current_position = $next;
                if ($break) {
                    break;
                }
            }
            if (!$break) {
                $valid = false;
            }
        } while ($next++ < $max && !$valid && $tries++ < 5);
        return $current_string;
    }

    /**
     * Find word in dictionary
     *
     *
     * @param $word
     * @return bool
     */
    protected function checkValidWord($word): bool
    {
        $word_lower      = mb_strtolower($word, 'UTF-8');
        $dictionary_file = $this->dictionary;
        return shell_exec("cat $dictionary_file | grep -w '$word'") ||
            shell_exec("cat $dictionary_file | grep -w '$word_lower'");
    }
}