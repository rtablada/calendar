<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="?year=<?= $previous->year?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($years as $year) : ?>
			<?php if ($year->display != 'hide') : ?>
			<li <?= $year->display ? 'class="'.$year->display.'"' : null ?>>
				<a href="?year=<?= $year->year?>"><?= $year->year ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="?year=<?= $next->year?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
