<form method="post" action="/users/index">
	<div class="upload_content">

		<p>Donec libero odio, molestie non est a, hendrerit lobortis nisl. Proin volutpat vestibulum tellus, non viverra est venenatis eu. Mauris efficitur condimentum convallis. Nunc ac urna euismod, laoreet enim quis, sodales turpis. Maecenas eget turpis rutrum, ultrices nunc ut, efficitur urna. Duis pretium quis nunc eu pretium. Aliquam erat volutpat. </p>

		<div class="message">
			<p><?= $this->message ?: "" ?></p>
		</div>

		<div class="input">
			<label for="username">email address</label>
			<?= $this->username ?>

		</div>

		<div class="input">
			<label for="name_given">given name</label>
			<?= $this->nameGiven ?>

		</div>

		<div class="input">
			<label for="name_family">family name</label>
			<?= $this->nameFamily ?>

		</div>

		<div class="input">
			<label for="color">color</label>
			<?= $this->colors ?>

		</div>

		<div class="input">
			<button type="submit" value="submit">Create</button>
		</div>
	</div>
</form>
