<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="<?= $previous->getQueryString() ?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($months as $month) : ?>
			<?php if ($month->display != 'hide') : ?>
			<li <?= $month->display ? 'class="'.$month->display.'"' : null ?>>
				<a href="<?= $month->getQueryString() ?>"><?= $month->month ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="<?= $next->getQueryString() ?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
