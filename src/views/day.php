<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="?day=<?= $previous->day?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($days as $day) : ?>
			<?php if ($day->display != 'hide') : ?>
			<li <?= $day->display ? 'class="'.$day->display.'"' : null ?>>
				<a href="<?= $day->getQueryString() ?>"><?= $day->day ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="?day=<?= $next->day?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
