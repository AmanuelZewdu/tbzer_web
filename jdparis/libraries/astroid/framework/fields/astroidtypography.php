<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldAstroidTypography extends JFormField {

   //The field class must know its own type through the variable $type.
   protected $type = 'AstroidTypography';

   public function getLabel() {
      return false;
   }

   public function getInput() {
      $renderer = new JLayoutFile('fields.astroidtypography', JPATH_LIBRARIES . '/astroid/framework/layouts');
      $data = $this->getLayoutData();

      if (!is_array($this->value) && empty($this->value)) {
         $value = [];
      } else {
         $value = (array) $this->value;
      }

      $defaults = [
          'font_face' => '',
          'alt_font_face' => '',
          'font_size' => '',
          'font_size_unit' => 'em',
          'font_unit' => '',
          'font_color' => '',
          'letter_spacing' => '',
          'letter_spacing_unit' => 'em',
          'line_height' => '',
          'line_height_unit' => 'em',
          'font_style' => [],
          'font_weight' => '',
          'text_transform' => '',
      ];

      $extraData = array(
          'value' => $value,
          'fieldname' => $this->fieldname,
          'ngShow' => $this->element['ngShow'],
          'ngHide' => $this->element['ngHide'],
      );

      if (isset($this->element['font-face'])) {
         $defaults['font_face'] = $this->element['font-face'];
      }

      if (isset($this->element['alt-font-face'])) {
         $defaults['alt_font_face'] = $this->element['alt-font-face'];
      }

      if (isset($this->element['font-unit'])) {
         $defaults['font_unit'] = $this->element['font-unit'];
      } else {
         $defaults['font_unit'] = 'px';
      }

      if (isset($this->element['font-size'])) {
         $defaults['font_size'] = $this->element['font-size'];
      }
      
      if (isset($this->element['font-size-unit'])) {
         $defaults['font_size_unit'] = $this->element['font-size-unit'];
      }

      if (isset($this->element['font-color'])) {
         $defaults['font_color'] = $this->element['font-color'];
      }

      if (isset($this->element['letter-spacing'])) {
         $defaults['letter_spacing'] = $this->element['letter-spacing'];
      }
      
      if (isset($this->element['letter-spacing-unit'])) {
         $defaults['letter_spacing_unit'] = $this->element['letter-spacing-unit'];
      }

      if (isset($this->element['line-height'])) {
         $defaults['line_height'] = $this->element['line-height'];
      }
      
      if (isset($this->element['line-height-unit'])) {
         $defaults['line_height_unit'] = $this->element['line-height-unit'];
      }

      if (isset($this->element['font-style'])) {
         $defaults['font_style'] = \explode(',', $this->element['font-style']);
      }

      if (isset($this->element['font-weight'])) {
         $defaults['font_weight'] = $this->element['font-weight'];
      }

      if (isset($this->element['text-transform'])) {
         $defaults['text_transform'] = $this->element['text-transform'];
      }

      if ($this->element['color-picker'] == 'false') {
         $extraData['colorpicker'] = false;
      } else {
         $extraData['colorpicker'] = true;
      }
      
      if ($this->element['font-picker'] == 'false') {
         $extraData['fontpicker'] = false;
      } else {
         $extraData['fontpicker'] = true;
      }
      
      if ($this->element['font-size-picker'] == 'false') {
         $extraData['sizepicker'] = false;
      } else {
         $extraData['sizepicker'] = true;
      }
      
      if ($this->element['letter-spacing-picker'] == 'false') {
         $extraData['letterspacingpicker'] = false;
      } else {
         $extraData['letterspacingpicker'] = true;
      }
      
      if ($this->element['line-height-picker'] == 'false') {
         $extraData['lineheightpicker'] = false;
      } else {
         $extraData['lineheightpicker'] = true;
      }
      
      if ($this->element['font-style-picker'] == 'false') {
         $extraData['stylepicker'] = false;
      } else {
         $extraData['stylepicker'] = true;
      }
      
      if ($this->element['font-weight-picker'] == 'false') {
         $extraData['weightpicker'] = false;
      } else {
         $extraData['weightpicker'] = true;
      }
      
      if ($this->element['text-transform-picker'] == 'false') {
         $extraData['transformpicker'] = false;
      } else {
         $extraData['transformpicker'] = true;
      }

      $extraData['defaults'] = $defaults;

      $data = array_merge($data, $extraData);

      return $renderer->render($data);
   }

}
