<?php

class Pagination
{

    public static function uriDeleteKeyword($key)
    {
        $path = Request::path();
        $query = '';
        if (isset($_SERVER['QUERY_STRING'])) {
            $query = $_SERVER['QUERY_STRING'];
        }

        $query_list = empty($query) ? array() : explode('&', $query);
        $query_result = array();
        foreach ($query_list as $q) {
            if (preg_match('/page=/', $q))
                continue;
            $query_result[] = $q;
        }
        if (empty($query_result)) {
            return $path;
        }
        return $path . '?' . join('&', $query_result);
    }

    public static function getPageSize($count, $page_size = 20)
    {
        if ($count == 0) {
            return 1;
        }
        if ($count % $page_size == 0) {
            return $count / $page_size;
        }
        return ceil($count / $page_size);
    }

    public static function render($page_size)
    {
        $link = self::uriDeleteKeyword('page');
        $link = strpos($link, '?') === false ? $link . '?page=' : $link . '&page=';
        $page = intval(Input::get('page', 1));

        $range = 10;
        $start_pos = floor(($page - 1) / $range) * $range + 1;
        $end_pos = $start_pos + $range - 1;
        if ($end_pos > $page_size)
            $end_pos = $page_size;

        $html = '<ul class="pagination" style="margin:5px;">';
        $prev_page = $page - 1 <= 0 ? 1 : $page - 1;
        $html .= "<li><a href=\"/{$link}{$prev_page}\">&laquo;</a></li>";

        foreach (range($start_pos, $end_pos) as $p) {
            if ($page == $p)
                $html .= "<li class=\"active\"><a href=\"/{$link}{$p}\">{$p}</a></li>";
            else
                $html .= "<li><a href=\"/{$link}{$p}\">{$p}</a></li>";
        }

        $next_page = $page + 1 > $page_size ? $page_size : $page + 1;
        $html .= "<li><a href=\"/{$link}{$next_page}\">&raquo;</a></li>";
        $html .= '</ul>';

        return $html;
    }

}
