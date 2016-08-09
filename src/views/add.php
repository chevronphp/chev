		<form method="post" enctype="multipart/form-data" action="uploadAsset">
			<div class="upload_content">

				<p>Donec libero odio, molestie non est a, hendrerit lobortis nisl. Proin volutpat vestibulum tellus, non viverra est venenatis eu. Mauris efficitur condimentum convallis. Nunc ac urna euismod, laoreet enim quis, sodales turpis. Maecenas eget turpis rutrum, ultrices nunc ut, efficitur urna. Duis pretium quis nunc eu pretium. Aliquam erat volutpat. </p>
				<div class="input">
					<label for="asset_id">ID#</label>
					<?= $this->asset_id ?>
					<label for="object_number">Object#</label>
					<?= $this->object_number ?>
					<?= $this->object_number_hidden ?>

				</div>
				<div class="input">
					<label for="collection">Family Name</label>
					<?= $this->collection ?>

				</div>
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
