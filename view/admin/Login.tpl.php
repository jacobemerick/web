<div id="container">
<? Loader::load('view', 'admin/part/Header') ?>

	<div id="login-box">
		<h2>Sign in</h2>
		<form method="post" action="/">
			<label for="username">Username</label>
			<input id="username" name="username" type="text" value="" />
			<label for="password">Password</label>
			<input id="password" name="password" type="password" value="" />
			<input name="submit" value="Sign in" type="submit" />
		</form>
	</div>

</div>