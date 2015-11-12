<?php if (is_post_type_archive('events')) : ?>
<?php
$eventcancel = get_field('eventcancel');
if ($eventcancel) :
?>
<div class="box eventitem eventcancel">
<?php the_title();?>
</div>
<?php else : ?>
<div class="box eventitem">
<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
</div>
<?php endif; ?>
<?php else : ?>
<?php if (is_main_query()) : ?>
<div class="box blogbox">
<?php else : ?>
<div class="box">
<?php endif; ?>
<section>
<p class="date"><?php echo get_the_date(); ?></p>
<h2 class="pageSubTitle"><?php the_title(); ?></h2>
<?php the_content();?>
</section>
</div>
<?php endif; ?>
