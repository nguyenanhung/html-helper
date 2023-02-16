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
        public static function highlightSearchKeyword($keyword, $string, $font_color = 'background:#d46220')
        {
            $string = trim($string);
            $unwanted_array = array(
                "Á" => "á",
                "À" => "à",
                "Ả" => "ả",
                "Ã" => "ã",
                "Ạ" => "ạ",
                "Ă" => "ă",
                "Ắ" => "ắ",
                "Ằ" => "ằ",
                "Ặ" => "ặ",
                "Â" => "â",
                "ẩ" => "ẩ",
                "Ầ" => "ầ",
                "Ậ" => "Ậ",
                "Ẫ" => "ẫ",
                "Ấ" => "ấ",
                "Ê" => "ê",
                "Ế" => "ế",
                "Ễ" => "ễ",
                "Ề" => "ề",
                "Ể" => "ể",
                "Ệ" => "Ệ",
                "Í" => "í",
                "Ị" => "ị",
                "Ỉ" => "ỉ",
                "Ì" => "ì",
                "Ĩ" => "ĩ",
                "Ô" => "ô",
                "Ồ" => "ồ",
                "Ổ" => "ổ",
                "Ộ" => "ộ",
                "Ố" => "Ố",
                "Ỗ" => "ỗ",
                "Ò" => "ò",
                "Ó" => "ó",
                "Ỏ" => "ỏ",
                "Ọ" => "ọ",
                "Õ" => "õ",
                "Ơ" => "ơ",
                "Ở" => "ở",
                "Ờ" => "ờ",
                "Ớ" => "ớ",
                "Ợ" => "ợ",
                "Ỡ" => "ỡ",
                "Ũ" => "u",
                "Ù" => "ù",
                "Ú" => "ú",
                "Ủ" => "ủ",
                "Ụ" => "ụ",
                "Ư" => "ư",
                "Ử" => "ử",
                "Ữ" => "ữ",
                "Ừ" => "ừ",
                "Ứ" => "Ứ",
                "Ỷ" => "ỷ",
                "Ý" => "ý",
                "Ỳ" => "ỳ",
                "Ỵ" => "y",
                "Ỹ" => "ỹ"
                //    "ế"=>"e","ắ"=>"a","V"=>"v"
            );

            if (isset($keyword) && !empty($keyword)) {
                $text_search = str_replace('%', ' ', $keyword);
                $arr_text_search = explode(" ", $text_search);
                if ($arr_text_search[0] === '') {
                    $arr_text_search[0] = $arr_text_search[1];
                    unset($arr_text_search[1]);
                }

                // $arr = explode(" ", $string);
                // $text_replace = "";

                $str = strtr($string, $unwanted_array);
                $str = strtolower($str);

                if (!empty($font_color)) {
                    $mark_begin = '<mark style="' . $font_color . '">';
                } else {
                    $mark_begin = '<mark>';
                }
                $mark_end = '</mark>';

                for ($j = 0; $j <= count($arr_text_search) - 1; $j++) {
                    $ki_tu_can_tim_convert = strtolower(strtr($arr_text_search[$j], $unwanted_array));
                    if (stripos($str, strtolower($ki_tu_can_tim_convert)) > 0) {
                        $ki_tu_chuoi_can_xu_ly = substr($string, stripos($string, $ki_tu_can_tim_convert), strlen($arr_text_search[$j]));
                        if (strpos($mark_begin, $ki_tu_chuoi_can_xu_ly) === false || strpos($mark_end, $ki_tu_chuoi_can_xu_ly) === false) {
                            $string = str_replace($ki_tu_chuoi_can_xu_ly, $mark_begin . $ki_tu_chuoi_can_xu_ly . $mark_end, $string);
                        }
                    }
                }
            }

            return $string;
        }

        /**
         * Function formatForHighlightSearchKeyword
         *
         * @param $keyword
         * @param $page
         *
         * @return mixed|string
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 16/02/2023 46:21
         */
        public static function formatForHighlightSearchKeyword($keyword, $page)
        {
            $keyword = trim($keyword);
            if (empty($keyword)) {
                return '';
            }
            $keyword = explode(" ", $keyword);
            // nếu page khác null hoặc 1
            if (count($keyword) > 1) {
                if (strlen($keyword[count($keyword) - 1]) === 1) {
                    $keyword[count($keyword) - 1] = "";
                }
                $keyword = implode('%', $keyword);
            } elseif ($page !== null || $page >= 1) {
                $keyword = $keyword[0];
            } else {
                $keyword = "%" . $keyword[0];
            }

            return $keyword;
        }
    }
}
