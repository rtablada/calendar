<div class="pagination">
	<ul>
		<?php if ($previous) : ?>
		<li><a href="?month=<?= $previous->month?>">&laquo;</a></li>
		<?php endif ?>
		<?php foreach ($months as $month) : ?>
			<?php if ($month->display != 'hide') : ?>
			<li <?= $month->display ? 'class="'.$month->display.'"' : null ?>>
				<a href="?month=<?= $month->month?>"><?= $month->month ?></a>
			</li>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($next) : ?>
		<li><a href="?month=<?= $next->month?>">&raquo;</a></li>
		<?php endif ?>
	</ul>
</div>
