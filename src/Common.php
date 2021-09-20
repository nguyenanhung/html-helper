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
    }
}
