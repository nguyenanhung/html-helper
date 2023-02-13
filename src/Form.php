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

use InvalidArgumentException;
use Traversable;

if (!class_exists('nguyenanhung\Libraries\HTML\Form')) {
    /**
     * Class Form
     *
     * @package   nguyenanhung\Libraries\HTML
     * @author    713uk13m <dev@nguyenanhung.com>
     * @copyright 713uk13m <dev@nguyenanhung.com>
     */
    class Form
    {
        /**
         * Form opening tag
         *
         * @static
         *
         * @param string $action
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function open($action = '', array $attributes = array())
        {
            if (isset($attributes['multipart']) && $attributes['multipart']) {
                $attributes['enctype'] = 'multipart/form-data';
                unset($attributes['multipart']);
            }
            $attributes = array_merge(array('method' => 'post', 'accept-charset' => 'utf-8'), $attributes);

            // TODO: CSRF

            return "<form action=\"$action\"" . HTML::attributes($attributes) . '>';
        }

        /**
         * Form closing tag
         *
         * @static
         * @return string
         */
        public static function close()
        {
            return '</form>';
        }

        /**
         * Creates a label for an input
         *
         * @param string $text       The label text
         * @param string $fieldName  Name of the input element
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function label($text, $fieldName = null, array $attributes = array())
        {
            if (!isset($attributes['for']) && $fieldName !== null) {
                $attributes['for'] = static::autoId($fieldName);
            }
            if (!isset($attributes['id']) && isset($attributes['for'])) {
                $attributes['id'] = $attributes['for'] . '-label';
            }

            return HTML::tag('label', $attributes, $text);
        }

        /**
         * Creates a text field
         *
         * @param string $name
         * @param string $value
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function text($name, $value = null, array $attributes = array())
        {
            $attributes = array_merge(array('id' => static::autoId($name), 'name' => $name, 'type' => 'text', 'value' => $value,), $attributes);

            return HTML::tag('input', $attributes);
        }

        /**
         * Creates a password input field
         *
         * @static
         *
         * @param string $name
         * @param string $value
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function password($name, $value = null, array $attributes = array())
        {
            $attributes = array_merge(array('id' => static::autoId($name), 'name' => $name, 'type' => 'password', 'value' => $value,), $attributes);

            return HTML::tag('input', $attributes);
        }

        /**
         * Creates a hidden input field
         *
         * @static
         *
         * @param string $name
         * @param string $value
         * @param array  $attributes
         *
         * @return string
         */
        public static function hidden($name, $value, array $attributes = array())
        {
            $attributes = array_merge(array('id' => static::autoId($name), 'name' => $name, 'type' => 'hidden', 'value' => $value,), $attributes);

            return HTML::tag('input', $attributes);
        }

        /**
         * Creates a textarea
         *
         * @param string $name
         * @param string $text
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function textArea($name, $text = null, array $attributes = array())
        {
            $attributes = array_merge(array('id' => static::autoId($name), 'name' => $name,), $attributes);

            return HTML::tag('textarea', $attributes, (string) $text);
        }

        /**
         * Creates a check box.
         * By default creates a hidden field with the value of 0, so that the field is present in $_POST even when not checked
         *
         * @param string      $name
         * @param bool        $checked
         * @param mixed       $value           Checked value
         * @param array       $attributes      HTML attributes
         * @param bool|string $withHiddenField Pass false to omit the hidden field or "array" to return both parts as an array
         *
         * @return string|array
         */
        public static function checkBox($name, $checked = false, $value = 1, array $attributes = array(), $withHiddenField = true)
        {
            $auto_id = static::autoId($name);
            $checkboxAttributes = array_merge(array('name' => $name, 'type' => 'checkbox', 'value' => $value, 'id' => $auto_id, 'checked' => (bool) $checked,), $attributes);
            $checkbox = HTML::tag('input', $checkboxAttributes);
            if ($withHiddenField === false) {
                return $checkbox;
            }
            $hiddenAttributes = array(
                'name'  => $name,
                'type'  => 'hidden',
                'value' => 0,
                'id'    => $auto_id . '-hidden',
            );
            $hidden = HTML::tag('input', $hiddenAttributes);

            return $withHiddenField === 'array' ? array($hidden, $checkbox) : $hidden . $checkbox;
        }

        /**
         * Creates multiple checkboxes for a has-many association.
         *
         * @param string            $name
         * @param array             $collection
         * @param array|Traversable $checked Collection of checked values
         * @param array             $labelAttributes
         * @param bool              $returnAsArray
         *
         * @throws InvalidArgumentException
         * @return string|array
         */
        public static function collectionCheckBoxes($name, array $collection, $checked, array $labelAttributes = array(), $returnAsArray = false)
        {
            // TODO: Does this check cover all options?
            if (!(is_array($checked) || $checked instanceof Traversable)) {
                throw new InvalidArgumentException("$name must be an array or Traversable!");
            }
            $checkBoxes = array();
            foreach ($collection as $value => $label) {
                $checkBoxes[] = HTML::tag('label', $labelAttributes, self::checkBox("{$name}[]", in_array($value, $checked, true), $value, array(), false) . HTML::escape($label), false);
            }

            return $returnAsArray ? $checkBoxes : implode('', $checkBoxes);
        }

        /**
         * Creates a radio button
         *
         * @static
         *
         * @param string $name
         * @param string $value
         * @param bool   $checked
         * @param array  $attributes
         *
         * @return string
         */
        public static function radio($name, $value, $checked = false, array $attributes = array())
        {
            $attributes = array_merge(array('type' => 'radio', 'name' => $name, 'value' => $value, 'checked' => (bool) $checked,), $attributes);

            return HTML::tag('input', $attributes);
        }

        /**
         * Creates multiple radio buttons with labels
         *
         * @static
         *
         * @param string $name
         * @param array  $collection
         * @param mixed  $checked Checked value
         * @param array  $labelAttributes
         * @param bool   $returnAsArray
         *
         * @return array|string
         */
        public static function collectionRadios($name, array $collection, $checked, array $labelAttributes = array(), $returnAsArray = false)
        {
            $radioButtons = array();
            foreach ($collection as $value => $label) {
                $radioButtons[] = HTML::tag('label', $labelAttributes, self::radio($name, $value, $value === $checked) . HTML::escape($label), false);
            }

            return $returnAsArray ? $radioButtons : implode('', $radioButtons);
        }

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
         * @param string $name       Name of the attribute
         * @param array  $collection An associative array used for the option values
         * @param mixed  $selected   Selected option Can be array or scalar
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function select($name, array $collection, $selected = null, array $attributes = array())
        {
            $attributes = array_merge(array('name' => $name, 'id' => static::autoId($name), 'multiple' => false,), $attributes);
            if (is_string($selected) || is_numeric($selected)) {
                $selected = array($selected => 1);
            } elseif (is_array($selected)) {
                $selected = array_flip($selected);
            } else {
                $selected = array();
            }
            $content = '';
            foreach ($collection as $value => $element) {
                // Element is an optgroup
                if (is_array($element) && $element) {
                    $groupHtml = '';
                    foreach ($element as $groupName => $groupElement) {
                        $groupHtml .= static::option($groupName, $groupElement, $selected);
                    }
                    $content .= HTML::tag('optgroup', array('label' => $value), $groupHtml, false);
                } else {
                    $content .= static::option($value, $element, $selected);
                }
            }

            return HTML::tag('select', $attributes, $content, false);
        }

        /**
         * Creates an option tag
         *
         * @param string $value
         * @param string $label
         * @param array  $selected
         *
         * @return string
         */
        public static function option($value, $label, $selected)
        {
            // Special handling of option tag contents to enable indentation with &nbsp;
            $label = str_replace('&amp;nbsp;', '&nbsp;', HTML::escape($label));

            return HTML::tag('option', array('value' => $value, 'selected' => isset($selected[$value])), $label, false);
        }

        /**
         * Creates a file input field
         *
         * @static
         *
         * @param string $name
         * @param array  $attributes HTML attributes
         *
         * @return string
         */
        public static function file($name, array $attributes = array())
        {
            $attributes = array_merge(array('type' => 'file', 'name' => $name, 'id' => static::autoId($name),), $attributes);

            return HTML::tag('input', $attributes);
        }

        /**
         * Function button
         *
         * @author: 713uk13m <dev@nguyenanhung.com>
         * @time  : 2018-12-27 23:02
         *
         * @param       $name
         * @param       $text
         * @param array $attributes
         *
         * @return string
         */
        public static function button($name, $text, array $attributes = array())
        {
            $attributes = array_merge(array('id' => static::autoId($name), 'name' => $name,), $attributes);

            return HTML::tag('button', $attributes, $text);
        }

        /**
         * Generate an ID given the name of an input
         *
         * @static
         *
         * @param string $name
         *
         * @return string|null
         */
        public static function autoId($name)
        {
            // Don't set an id on collection inputs
            if (strpos($name, '[]') !== false) {
                return null;
            }

            // Hyphenate array keys, for example model[field][other_field] => model-field-other_field
            return preg_replace('/\[([^]]+)\]/u', '-\\1', $name);
        }
    }
}
