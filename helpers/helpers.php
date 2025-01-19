<?php

/**
 * Project html-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/21/2021
 * Time: 03:18
 */
if (!function_exists('attrs')) {
    /**
     * Function attrs
     *
     * @param $attrs
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function attrs($attrs): string
    {
        $str = '';

        foreach ($attrs as $key => $value) {
            $str .= $key . '="' . $value . '" ';
        }

        return $str;
    }
}
if (!function_exists('css')) {
    /**
     * Function css
     *
     * @param string $href
     * @param array $attrs
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function css(string $href = '', array $attrs = []): string
    {
        return '<link rel="stylesheet" type="text/css" href="' . $href . '" ' . attrs($attrs) . '>';
    }
}
if (!function_exists('less')) {
    /**
     * Function less
     *
     * @param string $href
     * @param array $attrs
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function less(string $href = '', array $attrs = []): string
    {
        return '<link rel="stylesheet/less" type="text/css" href="' . $href . '"' . attrs($attrs) . '>';
    }
}
if (!function_exists('js')) {
    /**
     * Function js
     *
     * @param string|null $src
     * @param string|null $default
     * @param array $attrs
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function js(?string $src = '', ?string $default = '', array $attrs = []): string
    {
        return '<script type="text/javascript" src="' . $src . '" ' . attrs($attrs) . '>' . $default . '</script>';
    }
}
if (!function_exists('img')) {
    /**
     * Function img
     *
     * @param string|null $src
     * @param array $attrs
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function img(?string $src = '', array $attrs = []): string
    {
        return '<img src="' . $src . '" ' . attrs($attrs) . '/>';
    }
}
if (!function_exists('fontawesome')) {
    /**
     * Function fontawesome
     *
     * @param string $version
     * @param string|null $href
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:49
     *
     */
    function fontawesome(string $version = '4.7.0', ?string $href = ''): string
    {
        if (empty($href)) {
            $href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/' . $version . '/css/font-awesome.min.css';
        }
        return '<link rel="stylesheet" type="text/css" href="' . $href . '">';
    }
}
if (!function_exists('jquery')) {
    /**
     * Function jquery
     *
     * @param string $version
     * @param string|null $src
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:50
     *
     */
    function jquery(string $version = '3.2.1', ?string $src = ''): string
    {
        if (empty($src)) {
            $src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/' . $version . '/jquery.min.js';
        }

        return '<script type="text/javascript" src="' . $src . '"></script>';
    }
}
if (!function_exists('bootstrap_js')) {
    /**
     * Function bootstrap_js
     *
     * @param string $version
     * @param string|null $src
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:50
     *
     */
    function bootstrap_js(string $version = '4.0.0-alpha.6', ?string $src = ''): string
    {
        if (empty($src)) {
            $src = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/' . $version . '/js/bootstrap.min.js';
        }

        return '<script type="text/javascript" src="' . $src . '"></script>';
    }
}
if (!function_exists('bootstrap_css')) {
    /**
     * Function bootstrap_css
     *
     * @param string $version
     * @param string|null $href
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:50
     *
     */
    function bootstrap_css(string $version = '4.0.0-alpha.6', ?string $href = ''): string
    {
        if (empty($href)) {
            $href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/' . $version . '/css/bootstrap.min.css';
        }
        return '<link rel="stylesheet" type="text/css" href="' . $href . '">';
    }
}
if (!function_exists('icon')) {
    /**
     * Function icon
     *
     * @param string $icon
     * @param string $tag
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:50
     *
     */
    function icon(string $icon = '', string $tag = 'i'): string
    {
        return '<' . $tag . ' class="fa fa-' . $icon . '"></' . $tag . '>';
    }
}
if (!function_exists('google_analytics')) {
    /**
     * Function google_analytics
     *
     * @param string $ua
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-27 22:50
     *
     */
    function google_analytics(string $ua = ''): string
    {
        $out = "<script async src=\"https://www.googletagmanager.com/gtag/js?id=" . $ua . "\"></script>";
        $out .= "<script>";
        $out .= "window.dataLayer = window.dataLayer || [];";
        $out .= "  function gtag() {";
        $out .= "dataLayer.push(arguments);";
        $out .= " }";
        $out .= "   gtag('js', new Date());";
        $out .= "  gtag('config', '" . $ua . "');";
        $out .= "</script>";

        return $out;
    }
}
if (!function_exists('meta_property')) {
    /**
     * Function meta_property
     *
     * @param array|string $property
     * @param string $content
     * @param string $type
     * @param string $newline
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-03-25 14:28
     *
     */
    function meta_property(
        array|string $property = '',
        string $content = '',
        string $type = 'property',
        string $newline = "\n"
    ): string {
        return (new nguyenanhung\Libraries\HTML\Common())->metaProperty($property, $content, $type, $newline);
    }
}
if (!function_exists('placeholder_img')) {
    /**
     * Function placeholder_img
     *
     * @param string $size
     * @param string $background_color
     * @param string $text_color
     * @param string $text
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-03-25 14:28
     *
     */
    function placeholder_img(
        string $size = '300x250',
        string $background_color = '',
        string $text_color = '',
        string $text = ''
    ): string {
        return (new nguyenanhung\Libraries\HTML\Common())->placeholder($size, $background_color, $text_color, $text);
    }
}
if (!function_exists('clean_title')) {
    /**
     * Function clean_title
     *
     * @param string $str
     *
     * @return string
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-03-25 14:28
     *
     */
    function clean_title(string $str = ''): string
    {
        $str = strip_tags($str);
        $str = htmlspecialchars($str, ENT_QUOTES);
        if (function_exists('html_escape')) {
            $str = html_escape($str);
        }
        if (function_exists('escapeHtmlAttr')) {
            $str = escapeHtmlAttr($str);
        }

        return trim($str);
    }
}
if (!function_exists('get_pagination_number')) {
    /**
     * Function get_pagination_number
     *
     * @param $str
     *
     * @return int
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 14/02/2023 26:52
     */
    function get_pagination_number($str): int
    {
        return (new nguyenanhung\Libraries\HTML\Common())->getPageNumber($str);
    }
}
if (!function_exists('view_pagination')) {
    /**
     * Function view_pagination
     *
     * @param array $data
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 55:48
     */
    function view_pagination(array $data = array()): ?string
    {
        return (new nguyenanhung\Libraries\HTML\Common())->viewPagination($data);
    }
}
if (!function_exists('view_pagination_for_video_tv')) {
    /**
     * Function view_pagination_for_video_tv
     *
     * @param array $data
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 14/02/2023 26:17
     */
    function view_pagination_for_video_tv(array $data = array()): ?string
    {
        return (new nguyenanhung\Libraries\HTML\Common())->viewVideoTVPagination($data);
    }
}
if (!function_exists('view_more_pagination')) {
    /**
     * Function view_more_pagination
     *
     * @param array $data
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 55:48
     */
    function view_more_pagination(array $data = array()): ?string
    {
        return (new nguyenanhung\Libraries\HTML\Common())->viewMorePagination($data);
    }
}
if (!function_exists('view_select_page_pagination')) {
    /**
     * Function view_select_page_pagination
     *
     * @param array $data
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 55:48
     */
    function view_select_page_pagination(array $data = array()): ?string
    {
        return (new nguyenanhung\Libraries\HTML\Common())->viewSelectPagination($data);
    }
}
if (!function_exists('seo_meta_tag_equiv')) {
    /**
     * Function seo_meta_tag_equiv
     *
     * @param array $data
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 10:20
     */
    function seo_meta_tag_equiv(array $data = []): string
    {
        return (new nguyenanhung\Libraries\HTML\Common())->meta($data);
    }
}
if (!function_exists('form_label')) {
    /**
     * Creates a label for an input
     *
     * @param string $text The label text
     * @param string|null $fieldName Name of the input element
     * @param array $attributes HTML attributes
     *
     * @return string
     */
    function form_label(string $text, string $fieldName = null, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::label($text, $fieldName, $attributes);
    }
}
if (!function_exists('form_text')) {
    /**
     * Creates a text field
     *
     * @param string $name
     * @param string|null $value
     * @param array $attributes HTML attributes
     *
     * @return string
     */
    function form_text(string $name, ?string $value = null, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::text($name, $value, $attributes);
    }
}
if (!function_exists('form_password')) {
    /**
     * Creates a password input field
     *
     *
     *
     * @param string $name
     * @param string|null $value
     * @param array $attributes HTML attributes
     *
     * @return string
     */
    function form_password(string $name, ?string $value = null, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::password($name, $value, $attributes);
    }
}
if (!function_exists('form_hidden')) {
    /**
     * Creates a hidden input field
     *
     *
     *
     * @param string $name
     * @param string $value
     * @param array $attributes
     *
     * @return string
     */
    function form_hidden(string $name, string $value, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::hidden($name, $value, $attributes);
    }
}
if (!function_exists('form_textArea')) {
    /**
     * Creates a textarea
     *
     * @param string $name
     * @param string|null $text
     * @param array $attributes HTML attributes
     *
     * @return string
     */
    function form_textArea(string $name, ?string $text = null, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::textArea($name, $text, $attributes);
    }
}
if (!function_exists('form_checkBox')) {
    /**
     * Creates a checkbox.
     * By default, creates a hidden field with the value of 0, so that the field is present in $_POST even when not checked
     *
     * @param string $name
     * @param bool $checked
     * @param int|string|null $value Checked value
     * @param array $attributes HTML attributes
     * @param bool|string $withHiddenField Pass false to omit the hidden field or "array" to return both parts as an array
     *
     * @return string|array
     */
    function form_checkBox(
        string $name,
        bool $checked = false,
        int|string|null $value = 1,
        array $attributes = array(),
        bool|string $withHiddenField = true
    ): array|string {
        return nguyenanhung\Libraries\HTML\Form::checkBox($name, $checked, $value, $attributes, $withHiddenField);
    }
}
if (!function_exists('form_collectionCheckBoxes')) {
    /**
     * Creates multiple checkboxes for a has-many association.
     *
     * @param string $name
     * @param array $collection
     * @param iterable $checked Collection of checked values
     * @param array $labelAttributes
     * @param bool $returnAsArray
     *
     * @return string|array
     * @throws InvalidArgumentException
     */
    function form_collectionCheckBoxes(
        string $name,
        array $collection,
        iterable $checked,
        array $labelAttributes = array(),
        bool $returnAsArray = false
    ): array|string {
        return nguyenanhung\Libraries\HTML\Form::collectionCheckBoxes(
            $name,
            $collection,
            $checked,
            $labelAttributes,
            $returnAsArray
        );
    }
}
if (!function_exists('form_radio')) {
    /**
     * Creates a radio button
     *
     *
     *
     * @param string $name
     * @param string $value
     * @param bool $checked
     * @param array $attributes
     *
     * @return string
     */
    function form_radio(string $name, string $value, bool $checked = false, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::radio($name, $value, $checked, $attributes);
    }
}
if (!function_exists('form_collectionRadios')) {
    /**
     * Creates multiple radio buttons with labels
     *
     *
     *
     * @param string $name
     * @param array $collection
     * @param mixed $checked Checked value
     * @param array $labelAttributes
     * @param bool $returnAsArray
     *
     * @return array|string
     */
    function form_collectionRadios(
        string $name,
        array $collection,
        mixed $checked,
        array $labelAttributes = array(),
        bool $returnAsArray = false
    ): array|string {
        return nguyenanhung\Libraries\HTML\Form::collectionRadios(
            $name,
            $collection,
            $checked,
            $labelAttributes,
            $returnAsArray
        );
    }
}
if (!function_exists('form_select')) {
    /**
     * Creates a select tag
     * <code>
     * // Simple select
     * select('coffee_id', array('b' => 'black', 'w' => 'white'));
     *
     * // With option groups
     * select('beverage', array(
     *     'Coffee' => array('bc' => 'black', 'wc' => 'white'),
     *     'Tea' => array('gt' => 'Green', 'bt' => 'Black'),
     * ));
     * </code>
     *
     * @param string $name Name of the attribute
     * @param array $collection An associative array used for the option values
     * @param mixed|null $selected Selected option Can be array or scalar
     * @param array $attributes HTML attributes
     *
     * @return string
     */
    function form_select(string $name, array $collection, mixed $selected = null, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::select($name, $collection, $selected, $attributes);
    }
}
if (!function_exists('form_option')) {
    /**
     * Creates an option tag
     *
     * @param string $value
     * @param string $label
     * @param array $selected
     *
     * @return string
     */
    function form_option(string $value, string $label, array $selected): string
    {
        return nguyenanhung\Libraries\HTML\Form::option($value, $label, $selected);
    }
}
if (!function_exists('form_file')) {
    /**
     * Function form_file - Creates a file input field
     *
     * @param       $name
     * @param array $attributes
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 15:31
     */
    function form_file($name, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::file($name, $attributes);
    }
}
if (!function_exists('form_button')) {
    /**
     * Function form_button
     *
     * @param       $name
     * @param       $text
     * @param array $attributes
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 15:22
     */
    function form_button($name, $text, array $attributes = array()): string
    {
        return nguyenanhung\Libraries\HTML\Form::button($name, $text, $attributes);
    }
}
if (!function_exists('form_autoId')) {
    /**
     * Function form_autoId - Generate an ID given the name of an input
     *
     * @param $name
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/18/2021 15:13
     */
    function form_autoId($name): ?string
    {
        return nguyenanhung\Libraries\HTML\Form::autoId($name);
    }
}
if (!function_exists('highlight_search_keyword')) {
    /**
     * Function highlight_search_keyword
     *
     * @param $keyword
     * @param $string
     * @param string $font_color
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 11/08/2023 18:09
     */
    function highlight_search_keyword($keyword, $string, string $font_color = 'background:#d46220'): string
    {
        return nguyenanhung\Libraries\HTML\Highlight::highlightSearchKeyword($keyword, $string, $font_color);
    }
}
if (!function_exists('format_keyword_for_highlight_search_keyword')) {
    /**
     * Function format_keyword_for_highlight_search_keyword
     *
     * @param $keyword
     * @param $page
     *
     * @return mixed|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 16/02/2023 47:15
     */
    function format_keyword_for_highlight_search_keyword($keyword, $page): mixed
    {
        return nguyenanhung\Libraries\HTML\Highlight::formatForHighlightSearchKeyword($keyword, $page);
    }
}
if (!function_exists('html_tag')) {
    /**
     * Create a XHTML tag
     *
     * @param string $tag The tag name
     * @param array|string $attr The tag attributes
     * @param bool|string $content The content to place in the tag, or false for no closing tag
     *
     * @return    string
     */
    function html_tag(string $tag, array|string $attr = array(), bool|string $content = false): string
    {
        // list of void elements (tags that can not have content)
        static $void_elements = array(
            // html4
            "area",
            "base",
            "br",
            "col",
            "hr",
            "img",
            "input",
            "link",
            "meta",
            "param",
            // html5
            "command",
            "embed",
            "keygen",
            "source",
            "track",
            "wbr",
            // html5.1
            "menuitem",
        );

        // construct the HTML
        $html = '<' . $tag;
        $html .= (!empty($attr)) ? ' ' . (is_array($attr) ? array_to_attr($attr) : $attr) : '';

        // a void element?
        if (in_array(mb_strtolower($tag), $void_elements)) {
            // these can not have content
            $html .= ' />';
        } else {
            // add the content and close the tag
            $html .= '>' . $content . '</' . $tag . '>';
        }

        return $html;
    }
}
if (!function_exists('array_to_attr')) {
    /**
     * Takes an array of attributes and turns it into a string for an html tag
     *
     * @param array $attr
     *
     * @return    string
     */
    function array_to_attr(array $attr): string
    {
        $attr_str = '';
        foreach ($attr as $property => $value) {
            // Ignore null/false
            if ($value === null || $value === false) {
                continue;
            }

            // If the key is numeric then it must be something like selected="selected"
            if (is_numeric($property)) {
                $property = $value;
            }

            $attr_str .= $property . '="' . str_replace('"', '&quot;', $value) . '" ';
        }

        // We strip off the last space for return
        return trim($attr_str);
    }
}
