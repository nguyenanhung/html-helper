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

use nguyenanhung\Libraries\Pagination\Pagination\SimplePagination;

if (!class_exists(\nguyenanhung\Libraries\HTML\Common::class)) {
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
         * @param null|string $var The input string or array of strings to be escaped.
         * @param bool $double_encode $double_encode set to FALSE prevents escaping twice.
         *
         * @return    array|string|null            The escaped string or array of strings as a result.
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:22
         *
         */
        public function htmlEscape(null|string $var = '', bool $double_encode = true): array|string|null
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
         * @param $current
         * @param $previous
         * @param $id
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-19 22:43
         *
         */
        public function tableColor($current, $previous, $id): string
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
        public function placeholder(
            string $size = '300x250',
            string $bg_color = '',
            string $text_color = '',
            string $text = '',
            string $domain = 'https://placehold.co/'
        ): string {
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
         * @param array|string $name
         * @param string $content
         * @param string $type
         * @param string $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:17
         *
         */
        public function meta(
            array|string $name = '',
            string $content = '',
            string $type = 'name',
            string $newline = "\n"
        ): string {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($name)) {
                $name = array(
                    array(
                        'name' => $name,
                        'content' => $content,
                        'type' => $type,
                        'newline' => $newline
                    )
                );
            } elseif (isset($name['name'])) {
                // Turn single array into multidimensional
                $name = array($name);
            }

            $str = '';
            foreach ($name as $meta) {
                $type = (isset($meta['type']) && $meta['type'] !== 'name') ? 'http-equiv' : 'name';
                $name = $meta['name'] ?? '';
                $content = $meta['content'] ?? '';
                $newline = $meta['newline'] ?? "\n";

                // Remove XSS or Html Tag
                $type = strip_tags($type);
                $name = strip_tags($name);
                $content = strip_tags($content);

                $str .= '<meta ' . $type . '="' . $name . '" content="' . $content . '" />' . $newline;
            }

            return $str;
        }

        /**
         * Function metaProperty
         *
         * @param array|string $property
         * @param string $content
         * @param string $type
         * @param string $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:09
         *
         */
        public function metaProperty(
            array|string $property = '',
            string $content = '',
            string $type = 'property',
            string $newline = "\n"
        ): string {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($property)) {
                $property = array(
                    array(
                        'property' => $property,
                        'content' => $content,
                        'type' => $type,
                        'newline' => $newline
                    )
                );
            } elseif (isset($property['property'])) {
                // Turn single array into multidimensional
                $property = array($property);
            }
            $str = '';
            foreach ($property as $meta) {
                if (!empty($meta)) {
                    $type = (isset($meta['type']) && $meta['type'] !== 'property') ? 'itemprop' : 'property';
                }
                $property = $meta['property'] ?? '';
                $content = $meta['content'] ?? '';
                $newline = $meta['newline'] ?? "\n";

                // Remove XSS or Html Tag
                $type = strip_tags($type);
                $property = strip_tags($property);
                $content = strip_tags($content);

                $str .= '<meta ' . $type . '="' . $property . '" content="' . $content . '" />' . $newline;
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
        public function metaTagEquiv(array $data = []): string
        {
            $content = array(
                array(
                    'name' => 'X-UA-Compatible',
                    'content' => 'IE=edge',
                    'type' => 'http-equiv'
                ),
                array(
                    'name' => 'refresh',
                    'content' => $data['refresh']['content'] ?? 1800,
                    'type' => 'equiv'
                ),
                array(
                    'name' => 'content-language',
                    'content' => 'vi',
                    'type' => 'equiv'
                ),
                array(
                    'name' => 'audience',
                    'content' => $data['audience']['content'] ?? 'general',
                    'type' => 'equiv'
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
        public function metaDnsPrefetch(): string
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
        public function stripHtmlTag(string $str = ''): string
        {
            $regex = '/([^<]*<\s*[a-z](?:[0-9]|[a-z]{0,9}))(?:(?:\s*[a-z\-]{2,14}\s*=\s*(?:"[^"]*"|\'[^\']*\'))*)(\s*\/?>[^<]*)/i';
            $chunks = preg_split($regex, $str, -1, PREG_SPLIT_DELIM_CAPTURE);
            $chunkCount = count($chunks);
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
        public function stripIsTags($str, $tags, bool $stripContent = false): array|string|null
        {
            $content = '';
            if (!is_array($tags)) {
                $tags = (mb_strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : [
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
        public function stripQuotes(string $str = ''): array|string
        {
            return str_replace(['"', "'"], '', $str);
        }

        /**
         * Quotes to Entities
         *
         * Converts single and double quotes to entities
         *
         * @param string $str
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function quotesToEntities(string $str = ''): string
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
         * @param string $str
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function reduceDoubleSlashes(string $str = ''): string
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
         * @param string $str
         * @param string $character the character you wish to reduce
         * @param bool $trim TRUE/FALSE - whether to trim the character from the beginning/end
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:25
         *
         */
        public function reduceMultiples(string $str = '', string $character = ',', bool $trim = false): string
        {
            $str = preg_replace('#' . preg_quote($character, '#') . '{2,}#', $character, $str);

            return ($trim === true) ? trim($str, $character) : $str;
        }

        /**
         * Function sitemapParse
         *
         * @param string $domain
         * @param array|string $loc
         * @param string $lastmod
         * @param string $type
         * @param string $newline
         *
         * @return string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:11
         *
         */
        public function sitemapParse(
            string $domain = '',
            array|string $loc = '',
            string $lastmod = '',
            string $type = 'property',
            string $newline = "\n"
        ): string {
            // Since we allow the data to be passes as a string, a simple array
            // or a multidimensional one, we need to do a little prepping.
            if (!is_array($loc)) {
                $loc = [
                    [
                        'loc' => $loc,
                        'lastmod' => $lastmod,
                        'type' => $type,
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
                $type = 'loc';
                $loc = $meta['loc'] ?? '';
                $lastmod = $meta['lastmod'] ?? '';
                $newline = $meta['newline'] ?? "\n";
                $str .= "\n<sitemap>\n";
                $str .= '<' . $type . '>' . trim($domain) . trim($loc) . '.xml' . '</loc>';
                $str .= "\n<lastmod>" . $lastmod . "</lastmod>";
                $str .= "\n</sitemap>";
                $str .= $newline;
            }

            return $str;
        }

        /**
         * Convert Reserved XML characters to Entities
         *
         * @param string|mixed $str
         * @param bool $protect_all
         *
         * @return    string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:11
         *
         */
        public function xmlConvert(mixed $str, bool $protect_all = false): string
        {
            $temp = '__TEMP_AMPERSANDS__';

            // Replace entities to temporary markers so that
            // ampersands won't get messed up
            $str = preg_replace('/&#(\d+);/', $temp . '\\1;', $str);

            if ($protect_all === true) {
                $str = preg_replace('/&(\w+);/', $temp . '\\1;', $str);
            }

            $str = str_replace(['&', '<', '>', '"', "'", '-'],
                ['&amp;', '&lt;', '&gt;', '&quot;', '&apos;', '&#45;'],
                $str);

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
         * @param array $data
         *
         * @return null|string
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 9/29/18 11:16
         *
         */
        public function viewPagination(array $data = array()): ?string
        {
            $pagination = new SimplePagination();
            $pagination->setData($data);

            return $pagination->build();
        }

        /**
         * Function viewVideoTVPagination
         *
         * @param array $data
         *
         * @return string|null
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2019-02-20 10:09
         *
         */
        public function viewVideoTVPagination(array $data = array()): ?string
        {
            if (isset($data['left_class'])) {
                unset($data['left_class']);
            }
            if (isset($data['right_class'])) {
                unset($data['left_class']);
            }
            if (isset($data['selected_class'])) {
                unset($data['selected_class']);
            }
            $dataClass = array(
                'left_class' => 'page-item prev',
                'right_class' => 'page-item active',
                'selected_class' => 'page-item next',
            );
            $paginationData = array_merge($data, $dataClass);
            $pagination = new SimplePagination();
            $pagination->setData($paginationData);

            return $pagination->build();
        }

        /**
         * Function viewMorePagination
         *
         * @param array $data
         *
         * @return string
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 14/02/2023 24:45
         */
        public function viewMorePagination(array $data = array()): string
        {
            $pagination = new SimplePagination();
            $pagination->setData($data);

            return $pagination->buildViewMore();
        }

        /**
         * Function viewSelectPagination
         *
         * @param array $data
         *
         * @return string
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 14/02/2023 24:42
         */
        public function viewSelectPagination(array $data = array()): string
        {
            return (new SimplePagination())->setData($data)->buildSelectPage();
        }

        /**
         * Function cleanPaginationUrl
         *
         * @param string $str
         *
         * @return string
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 14/02/2023 23:42
         */
        public function cleanPaginationUrl(string $str = ''): string
        {
            return (new SimplePagination())->cleanPaginationUrl($str);
        }

        /**
         * Function getPageNumber
         *
         * @param string $pageNumber
         *
         * @return int
         * @author   : 713uk13m <dev@nguyenanhung.com>
         * @copyright: 713uk13m <dev@nguyenanhung.com>
         * @time     : 14/02/2023 23:25
         */
        public function getPageNumber(string $pageNumber = ''): int
        {
            return (new SimplePagination())->getPageNumber($pageNumber);
        }
    }
}
