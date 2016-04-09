<?php get_header(); while ( have_posts() ) : the_post();
$content = get_the_content();
$event_date = isset($_GET['eventDate']) ? esc_html($_GET['eventDate']) : null;?>

<div class="page-background">
	<main class="main">
		<div class="main-heading">
			<?php
			$entitle = get_field('page_title_en');
			if (!empty($entitle)) {
				echo '<div class="main-heading--en">' . $entitle . '</div>';
			}
			?>
			<?php the_title('<h1 class="main-heading--ja">','</h1>'); ?>
		</div>
		<div class="contents">
				<?php if(is_page('rules') && $event_date !== null) : ?>
				<p class="notice--join">以下をご確認いただき、ご了承いただいた上で下部の「参加申請をする」ボタンをクリックしてください。</p>
				<?php endif; ?>
			<?php if(get_field('page_one_column')) : ?>
			<div class="main--onecolumn">
				<?php the_content(); ?>
			</div>
			<?php else : ?>
			<?php if(have_rows('page_section')) : ?>
			<div class="main-column">
				<?php if (empty($content)) : ?>
				<?php while(have_rows('page_section')) : the_row(); ?>
				<section class="section" id="<?php the_sub_field('page_section_id'); ?>">
					<h2 class="section-heading--01"><span><?php the_sub_field('page_section_title'); ?></span></h2>
					<?php the_sub_field('page_section_content'); ?>
				</section>
				<?php endwhile; ?>
				<?php if(is_page('rules') && $event_date !== null) : ?>
				<form action="<?php echo esc_html(home_url('/join/form/')); ?>">
				<input type="hidden" name="eventDate" value="<?php echo $event_date; ?>">
				<div class="action-btn"><button type="submit" class="action-btn__item"><span>参加申請をする</span></button></div>
				</form>
				<?php endif; ?>
				<?php else : ?>
				<section class="section">
					<?php the_content(); ?>
				</section>
			<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if(have_rows('page_section') && empty($content)) :?>
			<div class="sidebar--2columns">
				<div class="sidebar__box">
					<ul class="menu-list">
					<?php while(have_rows('page_section')) : the_row(); ?>
						<li><a href="#<?php the_sub_field('page_section_id'); ?>"><span><?php the_sub_field('page_section_title'); ?></span></a></li>
					<?php endwhile; ?>
					</ul>
				</div>
			</div>
			<?php endif; endif; ?>
		</div>
	</main>
</div>

<?php endwhile; get_footer(); ?>
