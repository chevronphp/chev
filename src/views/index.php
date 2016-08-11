		<div class="columns">
			<?php foreach($this->columns as $assets){ ?>
			<div class="column">
				<?php foreach($assets as $asset){ ?>
				<article class="article">
					<h4 class="collection-title <?= $asset->getColor() ?>"><?= $asset->getCollection() ?>'s Collection</h4>
					<section>
						<div class="thumb">
							<img class="scaled-img" src="/images/<?= $asset->getFname() ?>"/>
						</div>
						<h2 class="id">Object #: <?= $asset->getObjectNumber() ?></h2>
						<h2 class="title"><?= $asset->getTitle() ?></h2>
						<div class="description">
							<p><?= nl2br($asset->getDescription()) ?></p>
						</div>
						<div class="source_link">
							<p><a href="/add/?on=<?= $asset->getId() ?>">Source Link</a></p>
						</div>
					</section>
				</article>
				<?php } ?>
			</div>
			<?php } ?>
		</div>


