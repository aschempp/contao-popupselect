<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['select'] = str_replace('{fconfig_legend}', '{popup_legend},addPopup;{fconfig_legend}', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['select']);
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['__selector__'][] = 'addPopup';
$GLOBALS['TL_DCA']['tl_form_field']['subpalettes']['addPopup'] = 'popupPage,popupLabel,popupValue,popupSize';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['addPopup'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_form_field']['addPopup'],
	'inputType'			=> 'checkbox',
	'eval'				=> array('submitOnChange'=>true),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['popupPage'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_form_field']['popupPage'],
	'inputType'			=> 'pageTree',
	'eval'				=> array('mandatory'=>true, 'fieldType'=>'radio'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['popupLabel'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_form_field']['popupLabel'],
	'inputType'			=> 'text',
	'eval'				=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['popupValue'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_form_field']['popupValue'],
	'inputType'			=> 'text',
	'eval'				=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['popupSize'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_form_field']['popupSize'],
	'inputType'			=> 'text',
	'eval'				=> array('maxlength'=>100, 'multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'tl_class'=>'w50'),
);

