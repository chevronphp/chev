<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, width=device-width"/>
	<title>Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/main.css" rel="stylesheet" media="all">
    <link href="/css/octicons.css" rel="stylesheet" media="all">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab' rel='stylesheet' type='text/css'>
 </head>
<body>
	<?php call_user_func($this->flash); ?>
	<div class="page">
		<header>
			<h1 class="project-title"><a href="/">Artifacts of Significance</a></h1>
			<h2 class="project-title-subscript">An Archive of Some Objects of Some Importance</h2>
		</header>
		<div class="search <?= $this->hideSearch ? "hide" : ""; ?>">
			<ul class="searchbar">
				<li><a href="/?sort=object">Arrange by Object</a></li>
				<li><a href="/?sort=owner">Arrange by Owner</a></li>
				<!-- <li><a href="#">Search:</a></li> -->
				<li>
					<form action="/">
						<span><input type="text" name="search" /></span>
						<button type="submit"><span class="octicon octicon-search"></span></button>
					</form>
				</li>
			</ul>
		</div>
		<?php call_user_func($this->view) ?>
	</div>
	<footer>
		<div class="footerblock">
			<h2>About the project</h2>
			<section>
				<p><?= $this->welcome ? sprintf("Welcome %s. ", $this->welcome): "" ?><br>Would you like to <?= $this->logout ?>?<br><br>Donec libero odio, molestie non est a, hendrerit lobortis nisl. Proin volutpat vestibulum tellus, non viverra est venenatis eu. Mauris efficitur condimentum convallis. Nunc ac urna euismod, laoreet enim quis, sodales turpis. Maecenas eget turpis rutrum, ultrices nunc ut, efficitur urna. Duis pretium quis nunc eu pretium. Aliquam erat volutpat. </p>
				<p>Donec libero odio, molestie non est a, hendrerit lobortis nisl. Proin volutpat vestibulum tellus, non viverra est venenatis eu. Mauris efficitur condimentum convallis. Nunc ac urna euismod, laoreet enim quis, sodales turpis. Maecenas eget turpis rutrum, ultrices nunc ut, efficitur urna. Duis pretium quis nunc eu pretium. Aliquam erat volutpat. </p>
			</section>
		</div>
	</footer>

	<script>
		window.onload = function () {
			document.getElementById("flash_stack").className += " hidden";
		}
	</script>
</body>
</html>
