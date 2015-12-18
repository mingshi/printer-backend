<?php
/**
 * @FileName    :   global_function.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 16:52:29
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

function array_ch_key($key, $array)
{
    if (empty($array)) {
        return [];
    }

    $arr = [];
    foreach ($array as $a) {
        if (!$a->$key) {
            continue;
        }

        $arr[$a->$key] = $a;
    }

    return $arr;
}

