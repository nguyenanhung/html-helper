<?php
/**
 * Project html-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 31/01/2023
 * Time: 17:04
 */

namespace nguyenanhung\Libraries\HTML;

if (!class_exists(\nguyenanhung\Libraries\HTML\Highlight::class)) {
    class Highlight
    {
        public static function highlightSearchKeyword($keyword, $string, $font_color = null): string
        {
            $tag_close = '</mark>';
            if (!empty($font_color)) {
                $tag_open = "<mark style='" . $font_color . "'>";
            } else {
                $tag_open = '<mark>';
            }

            return highlight_keyword($string, $keyword, $tag_open, $tag_close);
        }

        public static function formatForHighlightSearchKeyword($keyword, $page)
        {
            return format_keyword_for_highlight_keyword($keyword, $page);
        }
    }
}
