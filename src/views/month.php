<div class="pagination">
	<ul>
		<?php if ($next) : ?>
		<li>&laquo;</li>
		<?php endif ?>
		<?php foreach ($months as $month) : ?>
			<?php if ($month->display != 'hide') : ?>
			<li <?= $month->active ? 'class="active"' : null ?>>
				<?= $month->month ?>
			</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>
</div>
