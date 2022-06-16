<?php
/**
 * Project html-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/21/2021
 * Time: 03:21
 */

namespace nguyenanhung\Libraries\HTML;
if (!class_exists('nguyenanhung\Libraries\HTML\Common')) {
    /**
     * Class Common
     *
     * @package   nguyenanhung\Libraries\HTML
     * @author    713uk13m <dev@nguyenanhung.com>
     * @copyright 713uk13m <dev@nguyenanhung.com>
     */
    class Common
    {
        /**
         * Function htmlEscape - Returns HTML escaped variable.
         *
         * @param mixed $var           The input string or array of strings to be escaped.
         * @param bool  $double_encode $double_encode set to FALSE prevents escaping twice.
         *
         * @return    mixed|string            The escaped string or array of strings as a result.
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:22
         *
         */
        public function htmlEscape($var = '', $double_encode = true)
        {
            if (empty($var)) {
                return $var;
            }
            if (is_array($var)) {
                foreach (array_keys($var) as $key) {
                    $var[$key] = $this->htmlEscape($var[$key], $double_encode);
                }

                return $var;
            }

            return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', $double_encode);
        }

        /**
         * Function tableColor
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-19 22:43
         *
         * @param $current
         * @param $previous
         * @param $id
         *
         * @return string
         */
        public function tableColor($current, $previous, $id)
        {
            if (isset($previous->$id)) {
                if ($previous->$id > $current->$id) {
                    $style = "<b style='color: red'>" . number_format($current->$id) . "</b>";
                } elseif ($previous->$id < $current->$id) {
                    $style = "<b style='color: blue'>" . number_format($current->$id) . "</b>";
                } else {
                    $style = "<b style='color: black'>" . number_format($current->$id) . "</b>";
                }
            } else {
                $style = "<b style='color: green'>" . number_format($current->$id) . "</b>";
            }

            return $style;
        }

        /**
         * Function placeholder
         *
         * @param string $size
         * @param string $bg_color
         * @param string $text_color
         * @param string $text
         * @param string $domain
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:07
         *
         */
        public function placeholder($size = '300x250', $bg_color = '', $text_color = '', $text = '', $domain = 'https://via.placeholder.com/')
        {
            if (!empty($bg_color)) {
                $bg_color = '/' . $bg_color;
            }
            if (!empty($text_color)) {
                $text_color = '/' . $text_color;
            }
            if (!empty($text)) {
                $text = '/' . $text;
            }
            $link = trim($domain) . trim($size) . trim($bg_color) . trim($text_color) . trim($text);

            return '<img alt="Place-Holder" title="Place Holder" src="' . $link . '">';
        }

        /**
         * Function meta
         *
         * @param string|array $name
         * @param string       $content
         * @param string       $type
         * @param string       $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:17
         *
         */
        public function meta($name = '', $content = '', $type = 'name', $newline = "\n")
        {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($name)) {
                $name = array(
                    array(
                        'name'    => $name,
                        'content' => $content,
                        'type'    => $type,
                        'newline' => $newline
                    )
                );
            } elseif (isset($name['name'])) {
                // Turn single array into multidimensional
                $name = [$name];
            }

            $str = '';
            foreach ($name as $meta) {
                $type    = (isset($meta['type']) && $meta['type'] !== 'name') ? 'http-equiv' : 'name';
                $name    = isset($meta['name']) ? $meta['name'] : '';
                $content = isset($meta['content']) ? $meta['content'] : '';
                $newline = isset($meta['newline']) ? $meta['newline'] : "\n";

                $str .= '<meta ' . $type . '="' . $name . '" content="' . $content . '" />' . $newline;
            }

            return $str;
        }

        /**
         * Function metaProperty
         *
         * @param string|array $property
         * @param string       $content
         * @param string       $type
         * @param string       $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:09
         *
         */
        public function metaProperty($property = '', $content = '', $type = 'property', $newline = "\n")
        {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($property)) {
                $property = array(
                    array(
                        'property' => $property,
                        'content'  => $content,
                        'type'     => $type,
                        'newline'  => $newline
                    )
                );
            } elseif (isset($property['property'])) {
                // Turn single array into multidimensional
                $property = array(
                    $property
                );
            }
            $str = '';
            foreach ($property as $meta) {
                if (!empty($meta)) {
                    $type = (isset($meta['type']) && $meta['type'] !== 'property') ? 'itemprop' : 'property';
                }
                $property = isset($meta['property']) ? $meta['property'] : '';
                $content  = isset($meta['content']) ? $meta['content'] : '';
                $newline  = isset($meta['newline']) ? $meta['newline'] : "\n";
                $str      .= '<meta ' . $type . '="' . $property . '" content="' . $content . '" />' . $newline;
            }

            return $str;
        }

        /**
         * Function metaTagEquiv
         *
         * @param array $data
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:18
         *
         */
        public function metaTagEquiv($data = [])
        {
            $content    = array(
                array(
                    'name'    => 'X-UA-Compatible',
                    'content' => 'IE=edge',
                    'type'    => 'http-equiv'
                ),
                array(
                    'name'    => 'refresh',
                    'content' => isset($data['refresh']['content']) ? $data['refresh']['content'] : 1800,
                    'type'    => 'equiv'
                ),
                array(
                    'name'    => 'content-language',
                    'content' => 'vi',
                    'type'    => 'equiv'
                ),
                array(
                    'name'    => 'audience',
                    'content' => isset($data['audience']['content']) ? $data['audience']['content'] : 'general',
                    'type'    => 'equiv'
                )
            );
            $meta_equiv = $this->meta($content);

            return trim($meta_equiv);
        }

        /**
         * Function metaDnsPrefetch
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/30/18 16:17
         *
         */
        public function metaDnsPrefetch()
        {
            $meta = "<!-- DNS prefetch -->\n";
            $meta .= "<link rel='dns-prefetch' href = '//www.google-analytics.com/' > \n";
            $meta .= "<link rel='dns-prefetch' href = '//fonts.googleapis.com' > \n";
            $meta .= "<link rel='dns-prefetch' href='//ajax.googleapis.com'>\n";
            $meta .= "<link rel='dns-prefetch' href='//maps.google.com'>\n";
            $meta .= "<link rel='dns-prefetch' href='//connect.facebook.net/'>\n";

            return $meta;
        }

        /**
         * Function stripHtmlTag
         *
         * @param string $str
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 10/13/18 09:49
         *
         */
        public function stripHtmlTag($str = '')
        {
            $regex          = '/([^<]*<\s*[a-z](?:[0-9]|[a-z]{0,9}))(?:(?:\s*[a-z\-]{2,14}\s*=\s*(?:"[^"]*"|\'[^\']*\'))*)(\s*\/?>[^<]*)/i';
            $chunks         = preg_split($regex, $str, -1, PREG_SPLIT_DELIM_CAPTURE);
            $chunkCount     = count($chunks);
            $strippedString = '';
            for ($n = 1; $n < $chunkCount; $n++) {
                $strippedString .= $chunks[$n];
            }

            return $strippedString;
        }

        /**
         * Function stripIsTags
         *
         * Strip 1 tag cố định
         *
         * @param      $str
         * @param      $tags
         * @param bool $stripContent
         *
         * @return null|string|string[]
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 10/13/18 09:51
         *
         */
        public function stripIsTags($str, $tags, $stripContent = false)
        {
            $content = '';
            if (!is_array($tags)) {
                $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : [
                    $tags
                ]);
                if (end($tags) === '') {
                    array_pop($tags);
                }
            }
            foreach ($tags as $tag) {
                if ($stripContent) {
                    $content = '(.+</' . $tag . '(>|\s[^>]*>)|)';
                }
                $str = preg_replace('#</?' . $tag . '(>|\s[^>]*>)' . $content . '#is', '', $str);
            }

            return $str;
        }

        /**
         * Function stripQuotes
         *
         * @param string $str
         *
         * @return array|string|string[]
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 08/08/2021 11:13
         */
        public function stripQuotes($str = '')
        {
            return str_replace(['"', "'"], '', $str);
        }

        /**
         * Quotes to Entities
         *
         * Converts single and double quotes to entities
         *
         * @param string
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function quotesToEntities($str = '')
        {
            return str_replace(["\'", "\"", "'", '"'], ["&#39;", "&quot;", "&#39;", "&quot;"], $str);
        }

        /**
         * Reduce Double Slashes
         *
         * Converts double slashes in a string to a single slash,
         * except those found in http://
         *
         * http://www.some-site.com//index.php
         *
         * becomes:
         *
         * http://www.some-site.com/index.php
         *
         * @param string
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function reduceDoubleSlashes($str = '')
        {
            return preg_replace('#(^|[^:])//+#', '\\1/', $str);
        }

        /**
         * Reduce Multiples
         *
         * Reduces multiple instances of a particular character.  Example:
         *
         * Fred, Bill,, Joe, Jimmy
         *
         * becomes:
         *
         * Fred, Bill, Joe, Jimmy
         *
         * @param string
         * @param string    the character you wish to reduce
         * @param bool    TRUE/FALSE - whether to trim the character from the beginning/end
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function reduceMultiples($str = '', $character = ',', $trim = false)
        {
            $str = preg_replace('#' . preg_quote($character, '#') . '{2,}#', $character, $str);

            return ($trim === true) ? trim($str, $character) : $str;
        }

        /**
         * Function sitemapParse
         *
         * @param string       $domain
         * @param string|array $loc
         * @param string       $lastmod
         * @param string       $type
         * @param string       $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:11
         *
         */
        public function sitemapParse($domain = '', $loc = '', $lastmod = '', $type = 'property', $newline = "\n")
        {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($loc)) {
                $loc = [
                    [
                        'loc'     => $loc,
                        'lastmod' => $lastmod,
                        'type'    => $type,
                        'newline' => $newline
                    ]
                ];
            } elseif (isset($loc['loc'])) {
                // Turn single array into multidimensional
                $loc = [
                    $loc
                ];
            }
            $str = '';
            foreach ($loc as $meta) {
                $type    = 'loc';
                $loc     = isset($meta['loc']) ? $meta['loc'] : '';
                $lastmod = isset($meta['lastmod']) ? $meta['lastmod'] : '';
                $newline = isset($meta['newline']) ? $meta['newline'] : "\n";
                $str     .= "\n<sitemap>\n";
                $str     .= '<' . $type . '>' . trim($domain) . trim($loc) . '.xml' . '</loc>';
                $str     .= "\n<lastmod>" . $lastmod . "</lastmod>";
                $str     .= "\n</sitemap>";
                $str     .= $newline;
            }

            return $str;
        }

        /**
         * Convert Reserved XML characters to Entities
         *
         * @param string
         * @param bool
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:11
         *
         */
        public function xmlConvert($str, $protect_all = false)
        {
            $temp = '__TEMP_AMPERSANDS__';

            // Replace entities to temporary markers so that
            // ampersands won't get messed up
            $str = preg_replace('/&#(\d+);/', $temp . '\\1;', $str);

            if ($protect_all === true) {
                $str = preg_replace('/&(\w+);/', $temp . '\\1;', $str);
            }

            $str = str_replace(
                ['&', '<', '>', '"', "'", '-'],
                ['&amp;', '&lt;', '&gt;', '&quot;', '&apos;', '&#45;'],
                $str
            );

            // Decode the temp markers back to entities
            $str = preg_replace('/' . $temp . '(\d+);/', '&#\\1;', $str);

            if ($protect_all === true) {
                return preg_replace('/' . $temp . '(\w+);/', '&\\1;', $str);
            }

            return $str;
        }

        /**
         * Function viewPagination
         *
         * @param array $input_data
         *
         * @return null|string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:16
         *
         */
        public function viewPagination($input_data = [])
        {
            // $page_type           = $input_data['page_type'] ?? '';

            $page_link           = isset($input_data['page_link']) ? $input_data['page_link'] : '';
            $page_title          = isset($input_data['page_title']) ? $input_data['page_title'] : '';
            $page_prefix         = isset($input_data['page_prefix']) ? $input_data['page_prefix'] : '';
            $page_suffix         = isset($input_data['page_suffix']) ? $input_data['page_suffix'] : '';
            $current_page_number = isset($input_data['current_page_number']) ? $input_data['current_page_number'] : 1;
            $total_item          = isset($input_data['total_item']) ? $input_data['total_item'] : 0;
            $item_per_page       = isset($input_data['item_per_page']) ? $input_data['item_per_page'] : 10;
            $begin               = isset($input_data['pre_rows']) ? $input_data['pre_rows'] : 3;
            $end                 = isset($input_data['suf_rows']) ? $input_data['suf_rows'] : 3;
            $first_link          = isset($input_data['first_link']) ? $input_data['first_link'] : '&nbsp;';
            $last_link           = isset($input_data['last_link']) ? $input_data['last_link'] : '&nbsp;';

            /**
             * Kiểm tra giá trị page_number truyền vào
             * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
             */
            if (empty($current_page_number)) {
                $current_page_number = 1;
            }

            // Tính tổng số page có
            $total_page = ceil($total_item / $item_per_page);
            if ($total_page <= 1) {
                return null;
            }

            $output_html = '';
            if ($current_page_number !== 1) {
                $output_html .= '<li class="left"><a href="' . trim($page_link) . trim($page_suffix) . '" title="' . trim($page_title) . '">' . trim($first_link) . '</a></li>';
            }

            for ($page_number = 1; $page_number <= $total_page; $page_number++) {
                if ($page_number < ($current_page_number - $begin) || $page_number > ($current_page_number + $end)) {
                    continue;
                }

                if ($page_number === $current_page_number) {
                    $output_html .= '<li class="selected"><a href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) . '" title="' . $page_title . ' trang ' . $page_number . '">' . $page_number . '</a></li>';
                } else {
                    $output_html .= '<li><a href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) . '" title="' . $page_title . ' trang ' . $page_number . '">' . $page_number . '</a></li>';
                }
            }

            unset($page_number);

            if ($current_page_number !== $total_page) {
                $output_html .= '<li class="right"><a href="' . trim($page_link) . trim($page_prefix) . trim($total_page) . trim($page_suffix) . '" title="' . trim($page_title) . ' - trang cuối">' . trim($last_link) . '</a></li>';
            }

            return $output_html;
        }

        /**
         * Function viewVideoTVPagination
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2019-02-20 10:09
         *
         * @param array $input_data
         *
         * @return string|null
         */
        public function viewVideoTVPagination($input_data = array())
        {
            $page_link           = isset($input_data['page_link']) ? $input_data['page_link'] : '';
            $page_title          = isset($input_data['page_title']) ? $input_data['page_title'] : '';
            $page_prefix         = isset($input_data['page_prefix']) ? $input_data['page_prefix'] : '';
            $page_suffix         = isset($input_data['page_suffix']) ? $input_data['page_suffix'] : '';
            $current_page_number = isset($input_data['current_page_number']) ? $input_data['current_page_number'] : 1;
            $total_item          = isset($input_data['total_item']) ? $input_data['total_item'] : 0;
            $item_per_page       = isset($input_data['item_per_page']) ? $input_data['item_per_page'] : 10;
            $begin               = isset($input_data['pre_rows']) ? $input_data['pre_rows'] : 3;
            $end                 = isset($input_data['suf_rows']) ? $input_data['suf_rows'] : 3;
            $first_link          = isset($input_data['first_link']) ? $input_data['first_link'] : 'Đầu';
            $last_link           = isset($input_data['last_link']) ? $input_data['last_link'] : 'Cuối';

            /**
             * Kiểm tra giá trị page_number truyền vào
             * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
             */
            if (empty($current_page_number)) {
                $current_page_number = 1;
            }
            // Tính tổng số page có
            $total_page = ceil($total_item / $item_per_page);
            if ($total_page <= 1) {
                return null;
            }
            $output_html = '';
            if ($current_page_number <> 1) {
                $output_html .= '<li class="page-item prev">
<a class="page-link" href="' . trim($page_link) . trim($page_suffix) . '" title="' . trim($page_title) . '">
' . trim($first_link) . '</a></li>';
            }
            for ($page_number = 1; $page_number <= $total_page; $page_number++) {
                if ($page_number < ($current_page_number - $begin) || $page_number > ($current_page_number + $end)) {
                    continue;
                }
                if ($page_number == $current_page_number) {
                    $output_html .= '<li class="page-item active">
<a class="page-link" href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) .
                                    '" title="' . $page_title . ' trang ' . $page_number . '">
' . $page_number . '</a></li>';
                } else {
                    $output_html .= '<li>
<a class="page-link" href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) .
                                    '" title="' . $page_title . ' trang ' . $page_number . '">
                ' . $page_number . '</a></li>';
                }
            }
            unset($page_number);
            if ($current_page_number <> $total_page) {
                $output_html .= '<li class="page-item next">
<a class="page-link" href="' . trim($page_link) . trim($page_prefix) . trim($total_page) . trim($page_suffix) .
                                '" title="' . trim($page_title) . ' - trang cuối">
' . trim($last_link) . '</a></li>';
            }

            return $output_html;
        }

        /**
         * Function cleanPaginationUrl
         *
         * @param string $str
         *
         * @return string
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 09/09/2021 17:10
         */
        public function cleanPaginationUrl($str = '')
        {
            $str = str_replace(array('trang-', 'Trang-', '/page/'), '', $str);

            return trim($str);
        }

        /**
         * Function getPageNumber
         *
         * @param string $pageNumber
         *
         * @return array|string|string[]
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 08/30/2021 02:48
         */
        public function getPageNumber($pageNumber = '')
        {
            return str_replace('trang-', '', trim($pageNumber));
        }
    }
}
