	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<label>first name:
				<input type="text" name="fname" placeholder="first name">
				</label>
			</div>
			<div>
				<label>last name:	
				<input type="text" name="lname" placeholder="last name">
				</label>
			</div>

			<div>
				<label>email:
				<input type="text" name="email" placeholder="email">
				</label>
			</div>
			<div>
				<label>password:
				<input type="password" name="password" placeholder="password">
				</label>
			</div>
 
			<div>
				<label>confirm password:	
				<input type="password" name="pword" placeholder="password">
				</label>
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>