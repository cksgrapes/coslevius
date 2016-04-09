<?php get_header();

require_once "ua.class.php";
$ua = new UserAgent();

if($ua->set() === "mobile") {
	$slider_img_name = 'top_slider_sp';
	$thumbs_size     = 'slider_sp';
}else{
	$slider_img_name = 'top_slider_pc';
	$thumbs_size     = 'slider_pc';
}?>

<?php if (have_rows('top_slider')) : ?>
<div class="top-slide">
	<div class="top-slide__wrap">
		<?php while(have_rows('top_slider')) : the_row();
		$slider_img = get_sub_field($slider_img_name);
		if ($slider_img) {
			$slider_img = wp_get_attachment_image_src($slider_img, $thumbs_size);
		}?>
		<div class="top-slide__inner">
			<div class="top-slide__item"><img src="<?php echo $slider_img[0]; ?>" alt=""></div>
		</div>
		<?php endwhile; ?>
	</div>
	<ul class="top-slide__ctrls">
		<li class="top-slide__ctrls__prev"></li>
		<li class="top-slide__ctrls__next"></li>
	</ul>
	<p class="shokuri"><img src="/assets/img/shokuri.png" alt="山梨で開催中のコスプレイベント！　更衣室完備、屋外スペースあり！"></p>
</div>
<?php endif; ?>
<main class="main">
	<div class="contents">
		<div class="main-column--3columns">
			<?php $args = array(
				'post_type'=>'events',
				'posts_per_page' => '1',
				'order' => 'ASC');
			$myposts = get_posts( $args );
			if (!empty($myposts)) : ?>
			<section class="section">
			<?php foreach ( $myposts as $post ) : setup_postdata( $post ); the_levi_events($post); ?>
				<div class="action-btn next-event">
					<a href="<?php the_permalink(); ?>" class="action-btn__item action-btn__item--next-event">
						<div class="next-event__count">第<?php echo $events['count'];?>章</div>
						<div class="next-event__date"><?php echo $events['date']; ?></div>
						<div class="next-event__location"><?php echo $events['location']; ?></div>
						<div class="next-event__text">次回のイベントに参加する »</div>
					</a>
				</div>
			<?php endforeach; wp_reset_postdata(); ?>
			</section>
			<div class="recuruit-staff"><a href="/staff/"><span>Cos Leviusでは</span>常時スタッフを募集しております！</a></div>	
			<?php endif; ?>
			<section class="section">
				<h2 class="section-heading--top"><span>イベントスケジュール</span></h2>
				<ul class="schedule-list">
				<div class="news-list">
				<?php $args = array(
					'post_type'=>'events',
					'posts_per_page' => '-1',
					'order' => 'ASC');
				$myposts = get_posts( $args );
				if (!empty($myposts)) :
				foreach ( $myposts as $post ) : setup_postdata( $post ); the_levi_events($post); ?>
					<li><a href="<?php the_permalink(); ?>" class="schedule-list__link"><span class="schedule-list__count">第<?php echo $events['count'];?>章</span><span class="schedule-list__date"><?php echo $events['date']; ?></span><span class="schedule-list__location"><?php echo $events['location']; ?></span></a></li>
				<?php endforeach; wp_reset_postdata(); else : ?>
					<p>イベントスケジュールが登録されていません。</p>
				<?php endif; ?>
				</ul>
			</section>
			<section class="section">
				<h2 class="section-heading--top"><span>更新履歴</span></h2>
				<div class="news-list">
				<?php $args = array( 'post_type'=>'news', 'posts_per_page' => '4' );
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
					<dl class="news-list__item"><dt class="news-list__date"><?php echo get_the_date('Y年m月d日');?></dt>
						<dd class="news-list__body">
							<?php the_title('<p>','</p>'); ?>
							<?php the_content(); ?>
						</dd>
					</dl>
				<?php endforeach; wp_reset_postdata();?>
				</div>
			</section>
		</div>
		<div class="sidebar--3columns">
			<div class="sidebar__box top-btns">
				<div class="action-btn top-btns__btn"><a href="<?php echo esc_url(home_url('/blog/category/eventreport/'));?>" class="action-btn__item top-btns__item top-btns__item--report"><span class="top-btns__name top-btns__name--report">イベントレポート</span><span class="top-btns__name--en">event report</span></a></div>
				<div class="action-btn top-btns__btn"><a href="<?php echo esc_url(home_url('/about/host/'));?>" class="action-btn__item top-btns__item"><span class="top-btns__name"><span>主催：</span>妖籠刹那</span><span class="top-btns__name--en">yoro setuna</span></a></div>
				<div class="action-btn top-btns__btn"><a href="<?php echo esc_url(home_url('/about/subhost/'));?>" class="action-btn__item top-btns__item"><span class="top-btns__name"><span>副主催：</span>きょんこ</span><span class="top-btns__name--en">kyonko</span></a></div>
				<div class="sidebar__box">
<?php
 $filename = 'counter.dat'; // counter.datというカウント数を書き込むテキストファイル
 $fp = fopen($filename, "r+"); // counter.datファイルを fopenで開く
 $count = fgets($fp,32); // fgets関数でcounter.datに書かれたカウント数を読み込む
 $count = intval($count);
 $count++; // counter.datに書かれたカウント数を加算
 fseek($fp, 0); // fseek関数でcounter.datの読み書きを行う場所を先頭に戻す
 fputs($fp, $count); // fputs関数でカウントされた数をファイルに書き込む
 flock($fp, LOCK_UN); // flock関数でファイルを上書きされないようにロックする
 fclose($fp); // fclose関数でファイルを閉じる
?>
					<p class="counter">訪問者総数 : <?php echo $count;?></p>
				</div>
			</div>
		</div>
		<div class="sidebar--3columns">
			<div class="sidebar__box">
				<section class="blog-newpost">
				<?php $args = array( 'posts_per_page' => '1' );
				$myposts = get_posts( $args );
				foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
					<p class="blog-newpost__date"><?php echo get_the_date('Y年m月d日');?></p>
					<p class="blog-newpost__title"><span><?php the_title(); ?></span></p>
					<div class="blog-newpost__body">
						<?php the_excerpt(); ?>
					</div>
				<?php endforeach; wp_reset_postdata();?>
					<div class="action-btn comments__form__submit"><a href="<?php echo esc_url(home_url('/blog/'));?>" class="action-btn__item action-btn__item--mini"><span>主催ブログを見る</span></a></div>
				</section>
			</div>
			<div class="sidebar__box"><a class="twitter-timeline" href="https://twitter.com/CosLevius" data-widget-id="559977350125740032">@CosLeviusさんのツイート</a>
				<script>
					! function(d, s, id)
					{
						var js, fjs = d.getElementsByTagName(s)[0],
							p = /^http:/.test(d.location) ? 'http' : 'https';
						if (!d.getElementById(id))
						{
							js = d.createElement(s);
							js.id = id;
							js.src = p + "://platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js, fjs);
						}
					}(document, "script", "twitter-wjs");
				</script>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>
