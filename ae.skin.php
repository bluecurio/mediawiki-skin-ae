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


/**
 * Template for Ae skin, based off Gabriel Wicke's SkinTemplate class
 * in the MediaWiki core (which was based off Brion's smarty skin.)
 *
 * @ingroup Skins
 */
class SkinAe extends SkinTemplate {

	// Name of our skin
	var $skinname = 'ae';

	// Stylesheets to use. This is the subdirectory in skins/ where various stylesheets
	// are located
	var $stylename = 'ae';

	// Name of the template to use
	var $template = 'AeTemplate';

	// Geneate the <head> element
	var $useHeadElement = true;

	/**
	 * Add specific styles for this skin
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		$out->addModuleStyles( array( 'mediawiki.legacy.shared', 'mediawiki.legacy.commonPrint' ) );
		$out->addModuleStyles( 'skins.ae' );
		$out->addModules( 'skins.ae.js' );
	}

	/**
	 * Overridden to provide an array of subpages, not just an HTML string
	 *
	 * @access public
	 * @return array
	 */
	function subPageSubtitle() {
		global $wgLang;
		$out = $this->getOutput();
		$html = '';

		if ( !wfRunHooks( 'SkinSubPageSubtitle', array( &$html, $this, $out ) ) ) {
			return $html;
		}

		$subpages = array();
		if ( $out->isArticle() && MWNamespace::hasSubpages( $out->getTitle()->getNamespace() ) ) {
			$ptext = $this->getTitle()->getPrefixedText();
			if ( preg_match( '/\//', $ptext ) ) {
				$links = explode( '/', $ptext );
				array_pop( $links );
				$growinglink = '';
				$display = '';

				foreach ( $links as $link ) {
					$growinglink .= $link;
					$display .= $link;
					$linkObj = Title::newFromText( $growinglink );

					if ( is_object( $linkObj ) && $linkObj->isKnown() ) {
						$getlink = Linker::linkKnown(
							$linkObj,
							htmlspecialchars( $display )
						);
						array_push( $subpages, $getlink );
						$display = '';
					}
					else {
						$display .= '/';
					}
 					$growinglink .= '/';
				}
			}
		}

		$html = '<div class="subpages"><ol>';
		foreach ( $subpages as $link ) {
			$html .= '<li>' . $link . '</li>';
		}
		$html .= '</ol></div>';
		return $html;
	}
}



/**
 * BaseTemplate class for Ae skin
 * @ingroup Skins
 */
class AeTemplate extends BaseTemplate {

	public function execute() {
		wfSuppressWarnings();
		$this->html( 'headelement' );
		$this->getNavBar();
		$this->getSiteNotice();

		?>
		<div class="container" class"mw-body">
			<a id="top"></a>
	  		<?php $this->getTitle() ?>
			<div  id="content" class="mw-body">
				
			</div><!-- #content -->
			<hr>
			<footer>
				<p>&copy; Company 2013</p>
			</footer>
		</div>

		<?php $this->printTrail(); ?>
		</body>
		</html>
		<?php
		wfRestoreWarnings();
		// Woohoo!
	}

	protected function getNavBar() {
?>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container">
			<?php  $this->getNavBarHeader() ?>
			<div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li class="dropdown-header">Nav header</li>
					<li><a href="#">Separated link</a></li>
					<li><a href="#">One more separated link</a></li>
				  </ul>
				</li>
			  </ul>
			  <form class="navbar-form navbar-right">
				<div class="form-group">
				  <input type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			  </form>
			</div><!--/.navbar-collapse -->
		  </div>
		</div>
<?php
	}


	protected function getNavBarHeader() {
?>
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Project name</a>
		  </div>
<?php
	}

	protected function getSiteNotice() {
		if ( $this->data['sitenotice'] ) {
			?>
			<div class="jumbotron">
				<div class="container" id="siteNotice">
					<?php $this->html('sitenotice') ?>
				</div>
			</div>
			<?php
		}
	}

	protected function getTitle() {
		?>
		<div class="page-header">
			<h1 id="firstHeading" class="firstHeading" lang="<?php
				$this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getHtmlCode();
				$this->text( 'pageLanguage' );
			?>">
				<span dir="auto"><?php
					$this->html( 'title' );
					$this->html('subtitle');
				?></span>
			</h1>
		</div>
		<?php
	}

}


