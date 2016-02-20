<?php get_header(); ?>
<?php $today = getdate(); ?>

<!-- #contents -->
<div id="contents">

<div id="pageMainCol">
<div id="pageMainColInner">
<h1 id="pageMainTitle">イベントレポート</h1>
<div class="box">
<h2>コスレヴィ</h2>
<a href="http://id6.fm-p.jp/516/levius/index.php?module=viewnp&action=pdetail&stid=11" target="_blank">第１章９月２２日(土)青少年センター</a>
<br>
<a href="http://id16.fm-p.jp/472/Levius2/index.php?module=viewnp&action=pdetail&stid=5" target="_blank">第２章１０月２０日(土)木の国サイト</a>
<br>
<a href="http://id6.fm-p.jp/516/levius/index.php?module=viewnp&action=pdetail&stid=13" target="_blank">第３章１１月３日(土)青少年センター</a>
<br>
<a href="http://id24.fm-p.jp/463/levius3/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第４章１２月１日(土)青少年センター</a>
<br>
<a href="http://id18.fm-p.jp/496/levius4/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第５章１月２７日(日)青少年センター</a>
<br>
<a href="http://id35.fm-p.jp/315/levius5/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第６章２月１６日(土)木の国サイト</a>
<br>
<a href="http://id11.fm-p.jp/465/levius6/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第７章３月３１日(日)木の国サイト</a>
<br>
<a href="http://id9.fm-p.jp/447/levius7/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第８章４月２８日(日)木の国サイト</a>
<br>
<a href="http://id42.fm-p.jp/352/levius9/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第９章５月２５日(土)青少年センター</a>
<br>
<a href="http://id52.fm-p.jp/539/levius10/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１０章６月１５日(土)青少年センター</a>
<br>
<a href="http://id44.fm-p.jp/406/levius11/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１１章７月１３日(土)青少年センター</a>
<br>
<a href="http://id3.fm-p.jp/517/levius12/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１２章７月２７日(土)青少年センター</a>
<br>
<a href="http://id12.fm-p.jp/473/levius012/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１３章８月２４日(土)青少年センター</a>
<br>
<a href="http://id4.fm-p.jp/563/levius13/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１４章９月１４日(土)青少年センター</a>
<br>
<a href="http://id15.fm-p.jp/545/levius15/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１５章１０月２７日(日)青少年センター</a>
<br>
<a href="http://id20.fm-p.jp/607/levius16/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１６章１１月１６日(土)青少年センター</a>
<br>
<a href="http://id50.fm-p.jp/524/levius18/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１７章１２月７日(土)青少年センター</a>

<br>
<a href="http://id52.fm-p.jp/570/levius17/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第１８章１月１２日(日)青少年センター</a>
<br>
<a href="http://id50.fm-p.jp/524/levius18/index.php?module=viewnp&action=pdetail&stid=2" target="_blank">第１９章２月８日(土)青少年センター</a>
<br>
<a href="http://id42.fm-p.jp/401/levius19/index.php?module=viewnp&action=pdetail&stid=1" target="_blank">第２０章３月１日(土)青少年センター</a>
<br>
<a href="http://id42.fm-p.jp/401/levius19/index.php?module=viewnp&action=pdetail&stid=2" target="_blank">第２１章４月１２日(土)青少年センター</a>
<br><br>
<h2>レヴィカラ</h2>
<a href="http://id42.fm-p.jp/401/levius19/index.php?module=viewnp&action=pdetail&stid=3" target="_blank">第１舞５月１１日(土)</a>
</div>
</div>
</div>
<div id="pageSideMenu">
<?php
            $args = array(
                'theme_location' => 'about-menu',
                'container'      => 'div',
                'container_id'   => 'pageSideMenu',
                'menu_class'     => '',
                'menu_id'        => '',
                'items_wrap'     => '<ul>%3$s</ul>'
            );
            wp_nav_menu( $args );?>
</div>

</div>
<!-- //#contents -->

<?php get_footer(); ?>
