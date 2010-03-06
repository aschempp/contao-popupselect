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


class FormPopupSelectMenu extends FormSelectMenu
{
	
	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		$strOptions = '';
		$strClass = 'select';
		$blnHasGroups = false;

		if ($this->multiple)
		{
			$this->strName .= '[]';
			$strClass = 'multiselect';
		}

		// Make sure there are no multiple options in single mode
		elseif (is_array($this->varValue))
		{
			$this->varValue = $this->varValue[0];
		}

		// Add empty option (XHTML) if there are none
		if (!count($this->arrOptions))
		{
			$this->arrOptions = array(array('value'=>'', 'label'=>'-'));
		}

		foreach ($this->arrOptions as $arrOption)
		{
			if ($arrOption['group'])
			{
				if ($blnHasGroups)
				{
					$strOptions .= '</optgroup>';
				}

				$strOptions .= sprintf('<optgroup label="%s">',
										htmlspecialchars($arrOption['label']));

				$blnHasGroups = true;
				continue;
			}

			$strOptions .= sprintf('<option value="%s"%s>%s</option>',
									$arrOption['value'],
									((is_array($this->varValue) && in_array($arrOption['value'] , $this->varValue) || $this->varValue == $arrOption['value']) ? ' selected="selected"' : ''),
									$arrOption['label']);
		}

		if ($blnHasGroups)
		{
			$strOptions .= '</optgroup>';
		}
		
		if ($this->addPopup)
		{
			$this->import('Database');
			$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->limit(1)->execute($this->popupPage);
			
			if ($objPage->numRows)
			{
				$strOptions .= sprintf('<option value="%s"%s>%s</option>',
										$this->popupValue,
										(strlen($this->popupValue) && ((is_array($this->varValue) && in_array($this->popupValue , $this->varValue) || $this->varValue == $this->popupValue)) ? ' selected="selected"' : ''),
										$this->popupLabel);
			}
			
			$strSize = '';
			$arrSize = deserialize($this->popupSize);
			if (is_array($arrSize) && strlen($arrSize[0]) && strlen($arrSize[1]))
			{
				$strSize = ", '_blank', 'height=" . $arrSize[1] . ",width=" . $arrSize[0] . "'";
			}
			
			$strUrl = $this->generateFrontendUrl($objPage->row());
			
			$popupJS = "
<script type=\"text/javascript\">
<!--//--><![CDATA[//><!--
$('ctrl_" . $this->strId . "').addEvent('change', function() {
	if (this.selectedIndex == this.length-1) { 
		if (!window.open('" . $strUrl . "'" . $strSize . ") && $$('.popup_blocked').length == 0) { 
			new Element('div', {'class': 'popup_blocked', 'html': '<a href=\"" . $strUrl . "\" onclick=\"window.open(\'" . $strUrl . "\'" . str_replace("'", "\'", $strSize) . "); $$(\'.popup_blocked\').destroy(); return false\">" . $GLOBALS['TL_LANG']['MSC']['popupBlocked'] . "<\/a>'}).injectAfter(this); 
		} 
	}
});
//--><!]]>
</script>";
		}

		return sprintf('<select name="%s" id="ctrl_%s" class="%s%s"%s>%s</select>',
						$this->strName,
						$this->strId,
						$strClass,
						(strlen($this->strClass) ? ' ' . $this->strClass : ''),
						$this->getAttributes(),
						$strOptions) . $popupJS . $this->addSubmit();
	}
}

