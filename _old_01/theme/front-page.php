<?php get_header(); ?>

<!-- #contents -->
<div id="contents">

<div id="topImage"><img src="img/topimg_sp.png" alt="コスレヴィキャラクター集合絵" class="switch"></div>

<!-- #topMainCol -->
<div id="topMainCol">
<div id="topMainColInner">
<div class="box">
<p><?//php echo do_shortcode("[CPD_READS_TOTAL]"); ?><!-- 人目のお客さま、 -->ようこそコスレヴィアスへ！</p>
<p>コスレヴィアスではスタッフを募集しております！詳しくは「<a href="staff">スタッフ募集のお知らせ</a>」をご確認ください。</p>
</div>
<div class="col2Box">
<!-- 今年のイベント情報 -->
<div class="box">
<section>
<h2>2015年のイベント情報</h2>
<ul>
<?php
   $newslist = get_posts( array(
    'post_type' => 'events',
    'posts_per_page' => 4,
    'order' => 'ASC'
  ));
    foreach( $newslist as $post ):
    setup_postdata( $post );
    $content = get_the_content();
    $eventcancel = get_field('eventcancel');
  if ($eventcancel) :
?>
<li class="eventcancel"><?php the_title();?></li>
<?php
    elseif (empty($content)) :
?>
<li><?php the_title(); ?></li>
<?php else : ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endif; ?>
<?php endforeach; wp_reset_postdata(); ?>
</ul>
<a href="events" class="moreLink"><span>イベント情報一覧</span></a>
</section>
</div>
<!-- //今年のイベント情報 -->
<!-- 更新履歴 -->
<div class="box">
<section>
<?php
   $newslist = get_posts( array(
    'post_type' => 'information',
    'posts_per_page' => 1
  ));
    foreach( $newslist as $post ):
    setup_postdata( $post );
?>
<h2>更新履歴</h2>
<p class="date"><?php echo get_the_date(); ?></p>
<p><?php the_title(); ?></p>
<?php ?>
<?php the_content(); ?>
<?php endforeach; wp_reset_postdata(); ?>
<a href="information" class="moreLink"><span>更新履歴一覧</span></a>
</section>
</div>
<!-- //更新履歴 -->
</div>
<ul id="topMainLink">
<li><a href="about">
<div>
<p class="topMainLinkTitle">コスレヴィアスとは？</p>
<p>山梨で定期開催しているコスプレイベント、コスレヴィアス！　<span>更衣室完備、屋外スペースもご用意しております。</span></p>
</div>
</a></li>
<li><a href="join"><div>参加方法</div></a></li>
<li><a href="privilege"><div>特典・企画</div></a></li>
<!-- <li><a href="comments"><div>ご意見・ご感想</div></a></li> -->
<li><a href="blog"><div>主催ブログ</div></a></li>
</ul>
<div id="twitterBox">
<a class="twitter-timeline" href="https://twitter.com/CosLevius" data-widget-id="559977350125740032">@CosLeviusさんのツイート</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>
</div>
<!-- //#topMainCol -->

</div>
<!-- //#contents -->

<?php get_footer(); ?>
