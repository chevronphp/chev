<form method="post" enctype="multipart/form-data" action="uploadAsset">
	<?= $this->object_number_hidden ?>
	<div class="upload_content">

		<div class="input">
			<?= $this->sourceThumb ?>
		</div>

		<p><strong><?= $this->source->getTitle() ?></strong><br><?= $this->source->getDescription() ?></p>

		<div class="input">
			<label for="title">Title</label>
			<?= $this->title ?>

		</div>

		<div class="input">
			<label for="description">Description</label>
			<?= $this->description ?>

		</div>
		<div class="input">
			<input type="file" name="asset" />
		</div>

		<div class="input">
			<button type="submit" value="submit">Submit</button>
		</div>
	</div>
</form>
