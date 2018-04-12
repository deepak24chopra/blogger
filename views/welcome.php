
<h2>Login</h2>
<form action="<?php echo $host;?>/scripts/users.php" method="post">
	<input type="email" name="email" placeholder="email here." ><br>
	<input type="password" name="password" placeholder="password here." ><br>
	<input type="hidden" name="user_form" value="login">
	<input type="submit" name="submit">
</form>
<hr>
<form action="<?php echo $host;?>/scripts/users.php" method="post" >
	<?php if(isset($_SESSION['s_name'])) { echo "Name connot be empty."; } unset($_SESSION['s_name']); ?>
	<input type="text" name="name" placeholder="name here." ><br>
	<?php if(isset($_SESSION['s_email'])) { echo "Email already in use."; } unset($_SESSION['s_email']); ?>
	<?php if(isset($_SESSION['s_email_em'])) { echo "Email cannot be empty."; } unset($_SESSION['s_email_em']); ?>
	<input type="email" name="email" placeholder="email here." ><br>
	<?php if(isset($_SESSION['s_pass_comb'])) { echo "Password and confirm pasword combination not correct."; } unset($_SESSION['s_pass_comb']); ?>
	<input type="password" name="password" placeholder="password here."  ><br>
	<input type="password" name="password_confirmation" placeholder="password confirmation here." ><br>
	<input type="hidden" name="user_form" value="signup">
	<input type="submit" name="submit">
</form>