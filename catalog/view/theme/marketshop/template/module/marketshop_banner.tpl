<div id="marketshop-banner<?php echo $module; ?>" class="marketshop-banner">
	<div class="row">
		<?php foreach ($banners as $banner) { ?>
		<?php if ($banner['link']) { ?>
		<div class="<?php echo $perrow_id; ?> moderns">
		<div class="hovereffect">
		<img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" />
		<div class="overlay">
		<a href="<?php echo $banner['link']; ?>" class="info" target="_blank">SEE MORE DETAIL</a>
		</div>
		</div>
	</div>
	<?php } else { ?>
	<div class="<?php echo $perrow_id; ?> moderns"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></div>
	<?php } ?>
	<?php } ?>
</div>
</div>
