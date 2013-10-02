<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of contactMe, a plugin for Dotclear 2.
#
# Copyright (c) Olivier Meunier and contributors
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_CONTEXT_ADMIN')) { return; }

// dead but useful code, in order to have translations
__('ContactMe').__('Add a simple contact form on your blog');

$_menu['Blog']->addItem(__('Contact me'),'plugin.php?p=contactMe','index.php?pf=contactMe/icon.png',
		preg_match('/plugin.php\?p=contactMe(&.*)?$/',$_SERVER['REQUEST_URI']),
		$core->auth->check('admin',$core->blog->id));

$core->addBehavior('adminDashboardFavs','contactMeDashboardFavs');

function contactMeDashboardFavs($core,$favs)
{
	$favs['contactMe'] = new ArrayObject(array('contactMe','Contact me','plugin.php?p=contactMe',
		'index.php?pf=contactMe/icon.png','index.php?pf=contactMe/icon-big.png',
		'admin',null,null));
}

$core->addBehavior('adminSimpleMenuAddType',array('contactMeSimpleMenu','adminSimpleMenuAddType'));
$core->addBehavior('adminSimpleMenuBeforeEdit',array('contactMeSimpleMenu','adminSimpleMenuBeforeEdit'));

class contactMeSimpleMenu {

	public static function adminSimpleMenuAddType($items) {
		$items['contactme'] = new ArrayObject(array(__('Contact me'),false));
	}

	public static function adminSimpleMenuBeforeEdit($item_type,$item_select,$args) {
		global $core;

		if ($item_type == 'contactme') {

			$args[0] = __('Contact me');
			$args[1] = __('Mail contact form');
			$args[2] .= $core->url->getBase('contactme');
		}
	}
}
