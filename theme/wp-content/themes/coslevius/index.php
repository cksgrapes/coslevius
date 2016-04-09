<?php get_header(); ?>

<div class="page-background">
	<main class="main">
		<div class="main-heading">
			<div class="main-heading--en">Blog</div>
			<h1 class="main-heading--ja">ブログ</h1>
		</div>
		<div class="contents">
			<div class="main-column">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
				$categories = get_the_category();
				$separator = ',';
				$output = '';
				if ( $categories ) {
					foreach( $categories as $category ) {
						$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="'
							. esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) )
							. '">' . $category->cat_name . '</a>' . $separator;
					}
				$output = trim( $output, $separator );
				} ?>
				<section class="section--blog">
					<p class="section--blog__date"><?php echo get_the_date('Y年m月d日 - H:i');?></p>
					<h2 class="section--blog__title"><span><?php the_title(); ?></span></h2>
					<div class="section--blog__body">
					<?php if(strpos($output, 'イベントレポート') !== false) : ?>
					<?php if (get_field('eventreport_type') === 'only_image') : ?>
					<?php if(have_rows('eventreport_images')) : ?>
					<?php the_content(); ?>
					<ul class="eventreport-list">
						<?php while(have_rows('eventreport_images')) : the_row();
						$image = get_sub_field('eventreport_image');
						$image_date = [];
						$image_date['thumbs'] = $image['sizes']['event_report_thumb'];
						$image_date['url'] = $image['url'];
						$image_date['alt'] = $image['alt']; ?>
						<li><a href="<?php echo $image_date['url']; ?>"><img src="<?php echo $image_date['thumbs']; ?>" alt="<?php echo $image_date['alt']; ?>"></a></li>
						<?php endwhile; ?>
					</ul>
					<?php endif; else : ?>
					<?php if(have_rows('eventreport_with_comment')) : ?>
					<?php the_content(); ?>
					<?php while(have_rows('eventreport_with_comment')) : the_row();
					$image = get_sub_field('eventreport_with_comment_image');
					$image_date = [];
					$image_date['thumbs'] = $image['sizes']['event_report_big'];
					$image_date['url'] = $image['url'];
					$image_date['alt'] = $image['alt']; ?>
					<p>
						<a href="<?php echo $image_date['url']; ?>"><img src="<?php echo $image_date['thumbs']; ?>" alt="<?php echo $image_date['alt']; ?>"></a>
					</p>
					<?php the_sub_field('eventreport_with_comment_body');?>
					<?php endwhile; ?>
					<?php endif; endif; ?>
					<?php else : the_content(); endif; ?>
					</div>
					<div class="section--blog__data"><a href="<?php comments_link(); ?>">コメントする</a>（<?php comments_number('0件','1件','%件'); ?>） -　<?php echo $output; ?></div>
				</section>
				<?php endwhile; ?>
				<?php
				if(function_exists('wp_pagenavi')) { wp_pagenavi(); };
				else : ?>
				<p>記事がありません。</p>
				<?php endif; ?>
			</div>
			<div class="sidebar--2columns sidebar--2columns--blog">
				<div class="sidebar__box">
					<p class="sidebar__title">カテゴリ</p>
					<ul class="menu-list">
						<?php wp_list_categories(array(
							'show_count' => true,
							'title_li'   => "",
							''
						)); ?>
					</ul>
				</div>
				<div class="sidebar__box">
					<p class="sidebar__title">月別アーカイブ</p>
					<ul class="menu-list">
						<?php wp_get_archives(array(
							'show_post_count' => true, 'limit' => 6
						)); ?>
					</ul>
				</div>
				<div class="sidebar__box">
					<p class="sidebar__title">年別アーカイブ</p>
					<ul class="menu-list">
						<?php wp_get_archives(array(
							'show_post_count' => true, 'type' => 'yearly'
						)); ?>
					</ul>
				</div>
			</div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
