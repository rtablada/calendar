<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="<?= $previous->getQueryString() ?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($dates as $date) : ?>
			<?php if ($date->display != 'hide') : ?>
			<li <?= $date->display ? 'class="'.$date->display.'"' : null ?>>
				<a href="<?= $date->getQueryString() ?>"><?= $date->$field ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="<?= $next->getQueryString() ?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
