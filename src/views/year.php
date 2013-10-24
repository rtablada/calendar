<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="<?= $previous->getQueryString() ?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($years as $year) : ?>
			<?php if ($year->display != 'hide') : ?>
			<li <?= $year->display ? 'class="'.$year->display.'"' : null ?>>
				<a href="<?= $year->getQueryString() ?>"><?= $year->year ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="<?= $next->getQueryString() ?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
