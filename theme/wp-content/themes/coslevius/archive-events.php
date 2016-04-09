<?php get_header(); ?>

<div class="page-background">
	<main class="main">
		<div class="main-heading">
			<div class="main-heading--en">Events</div>
			<h1 class="main-heading--ja">イベント情報</h1>
		</div>
		<div class="contents">
			<div class="main-column">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_levi_events($post); ?>
				<section class="section">
					<h2 class="section-heading--01"><span><?php echo $events['maintitle']; ?></span></h2>
					<table class="table">
						<tbody>
							<?php if(!empty($events['date'])) : ?>
							<tr>
								<th>開催日</th>
								<td><?php echo $events['date']; ?></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['time'])) : ?>
							<tr>
								<th>開催時間</th>
								<td><?php echo $events['time']; ?></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['location'])) : ?>
							<tr>
								<th>開催場所</th>
								<td><?php echo $events['location']; ?><a href="<?php echo esc_url( home_url( '/access/' ) ); ?>">（アクセス）</a></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['per'])) : ?>
							<tr>
								<th>参加費</th>
								<td><?php echo number_format($events['per']); ?>円</td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['lockerroom'])) : ?>
							<tr>
								<th>更衣室</th>
								<td><?php echo $events['lockerroom']; ?></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['largeones'])) : ?>
							<tr>
								<th>武器・大道具</th>
								<td><?php echo $events['largeones']; ?></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['planning'])) : ?>
							<tr>
								<th>当日企画</th>
								<td><?php echo $events['planning']; ?></td>
							</tr>
							<?php endif; ?>
							<?php if(!empty($events['notes'])) : ?>
							<tr>
								<th>備考</th>
								<td><?php echo $events['notes']; ?></td>
							</tr>
							<?php endif; ?>
						</tbody>
					</table>
					<form action="<?php echo esc_url( home_url( '/about/rules/' ) ); ?>">
					<div class="action-btn"><a href="<?php echo esc_url( home_url( '/about/join/cancel/' ) ) . '?eventDate=' . $events['maintitle'] ; ?>" class="action-btn__item action-btn__item--disable"><span>参加申請をキャンセルする</span></a><button class="action-btn__item action-btn__item--next" type="submit"><span>注意事項を読んで参加申請をする</span></button></div>
					<input type="hidden" name="eventDate" value="<?php echo $events['maintitle']; ?>">
					</form>
				</section>
				<?php endwhile; else : ?>
				<p>イベント情報はありません。</p>
				<?php endif; ?>
			</div>
			<div class="sidebar--2columns">
				<div class="sidebar__box">
					<ul class="menu-list menu-list--events">
						<?php
						$args = array( 'post_type' => 'events','posts_per_page' => -1, 'order' => 'asc' );
						$myposts = get_posts( $args );
						foreach ( $myposts as $post ) : setup_postdata( $post ); the_levi_events($post); ?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<span class="menu-list--events__count"><?php echo '第' . $events['count'] . '章　';?></span>
									<span class="menu-list--events__date"><?php echo $events['date']?></span>
									<span class="menu-list--events__location"><?php echo $events['location']?></span>
								</a>
							</li>
						<?php endforeach; wp_reset_postdata();?>
					</ul>
				</div>
			</div>
		</div>
	</main>
</div>
<?php get_footer(); ?>
