-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************

-- 
-- Table `tl_form_field`
-- 

CREATE TABLE `tl_form_field` (
  `addPopup` char(1) NOT NULL default '',
  `popupPage` int(10) unsigned NOT NULL default '0',
  `popupLabel` varchar(255) NOT NULL default '',
  `popupValue` varchar(255) NOT NULL default '',
  `popupSize` varchar(255) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

