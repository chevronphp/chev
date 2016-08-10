		<div class="columns">
			<?php foreach($this->columns as $assets){ ?>
			<div class="column">
				<?php foreach($assets as $asset){ ?>
				<article class="article">
					<h4 class="collection-title red"><?= $asset->getCollection() ?></h4>
					<section>
						<div class="thumb">
							<img class="scaled-img" src="/images/<?= $asset->getFname() ?>"/>
						</div>
						<h2 class="id">Object #: <?= $asset->getObjectNumber() ?></h2>
						<h2 class="title"><?= $asset->getTitle() ?></h2>
						<div class="description"><?= nl2br($asset->getDescription()) ?></div>
						<div class="source_link">
							<p><!-- <a href="https://catalog.archives.gov/id/192414?q=*:*">Source Link</a> --></p>
						</div>
					</section>
				</article>
				<?php } ?>
			</div>
			<?php } ?>
		</div>


