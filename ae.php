<?php
/**
 * Ae skin for MediaWiki
 *
 * @file
 * @ingroup Skins
 * @author Daniel Renfro ( http://www.mediawiki.org/wiki/User:DanielRenfro )
 * @license https://www.apache.org/licenses/LICENSE-2.0.html Apache2.0
 *
 *
 * Copyright 2013 Daniel Renfro
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// --------- check if we are inside MediaWiki --------------------------------

if ( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

// -------------------- credits ----------------------------------------

$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'æ',
	'url' => 'http://www.mediawiki.org/wiki/AeSkin',
	'author' => '[http://www.mediawiki.org/wiki/User:DanielRenfro Daniel Renfro]',
	'descriptionmsg' => 'aeskin-credits-description',
);

// -------------------- skins -----------------------------------

$wgValidSkinNames['ae'] = 'Ae';

// -------------------- includes (autoloaded) -----------------------------------
$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses['SkinAe'] = $dir . 'ae.skin.php';


// -------------------- languages ---------------------------------------------

$wgExtensionMessagesFiles['Ae'] = $dir . 'ae.i18n.php';

// ------------- resource-loader modules ---------------------------------------------------

$wgResourceModules[ 'skins.ae' ] = array(
	'styles' => array(
		'css/ae.screen.css' => array( 'media' => 'screen' ),
	),
	'dependencies' => array(),
	'localBasePath' => __DIR__,
);

$wgResourceModules[ 'skins.ae.js' ] = array(
	'scripts' => array(
		'ae/js/bootstrap.js',
		'ae/js/modernizr-2.6.2-respond-1.1.0.min.js',
		'ae/js/ae.js',
	),
	'position' => 'top',
	'dependencies' => 'jquery.delayedBind',
	'localBasePath' => &$GLOBALS['wgExtensionsDirectory'],
	'remoteBasePath' => &$GLOBALS['wgExtensionAssetsPath'],
);

// ------------- default user options ---------------------------------------------------
//$wgDefaultUserOptions[PREF_OPT_OUT] = PREF_OPT_OUT_DEFAULT;

