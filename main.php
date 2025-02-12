<?php
/**
 * Kiwiki Template
 *
 * @link     http://dokuwiki.org/template:kiwiki
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Nicolas Prigent
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
$sidebarElement = tpl_getConf('sidebarIsNav') ? 'nav' : 'aside';
$themeMode = '';
if (!empty($_COOKIE['theme'])){
    $themeMode = $_COOKIE['theme'];
}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>


<body id="kiwiki" class="<?php echo $themeMode; ?>">
    <?php /* the "dokuwiki__top" id is needed somewhere at the top, because that's where the "back to top" button/link links to */ ?>
    <?php /* tpl_classes() provides useful CSS classes; if you choose not to use it, the 'dokuwiki' class at least
             should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>
    <?php $admin_page = (($ACT == "admin") && (isset($_REQUEST['page']))) ? explode("#",$_REQUEST['page'])[0]: "" ;?>
    <div id="dokuwiki__site">
        <div id="dokuwiki__top" class="site <?php echo tpl_classes() ." " . $admin_page; ?>">
        <!-- ********** HEADER ********** -->
        <?php include('partial/header.php');?>
        
        <?php include('partial/breadcrumb.php'); ?>

        <?php include('partial/content.php');?>        

        </div>
        <!-- ********** FOOTER ********** -->
    <?php include('partial/footer.php'); ?>
    <!-- GO TOP -->
    <div id="gotop">
    <?php

    
    $items = (new \dokuwiki\Menu\KiwikiGoTop())->getItems();
        echo '<a href="'.$items[0]->getLink().'" title="'.$items[0]->getTitle().'">'
        .'<span class="icon">'.inlineSVG($items[0]->getSvg()).'</span>'
        . '<span class="a11y">'.$items[0]->getLabel().'</span>'
        . '</a>';
    ?>
    </div>
    </div><!-- /site -->
    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>
