<div style="text-align: center;"><a href="index.php"><img src="images/logo.png" class="logo"></a></div>
        <div style="width: 80%;margin:auto;">

            <form action="./" method="get"><input type="text" placeholder="Symbol" name="t"></form>

            <div onclick="window.location='index.php';" class="menu<?php if ($place=='home') echo ' active'; ?>">Home</div>
            <?php if (!empty($_SESSION["guildore"])) { ?>
            <div onclick="window.location='portfolio.php';" class="menu<?php if ($place=='portfolio') echo ' active'; ?>">Portfolio</div>
            <div onclick="window.location='watchlist.php';" class="menu<?php if ($place=='watchlist') echo ' active'; ?>">Watchlist</div>

            <?php } ?>
            <div onclick="window.location='news.php';" class="menu<?php if ($place=='news') echo ' active'; ?>">News</div>
            <div onclick="window.location='about.php';" class="menu<?php if ($place=='about') echo ' active'; ?>">About</div>
            <hr class="fancy-line"></hr>
            <div style="margin-bottom: 20px;"></div>
            <?php if (empty($_SESSION["guildore"])) { ?><div id="loginDialog">
	            <div style="width: 80%; margin: auto; text-align: center;">
	            	<form action="logIn.php" method="post" id="logInForm">
	            	
	            	<input style="font-size: 12px; width: 80%;" type="text" placeholder="Username" name="user">
	            	<input style="font-size: 12px; width: 80%;" type="password" placeholder="Password" name="pass">
	            	</form>
	            </div>
						<div class="login" style="text-align: center;"><a href="#" onclick="$('#logInForm').submit();">Login</a> | <a href="#" onclick="$('#loginDialog').hide();$('#signUpDialog').fadeIn();">Sign up</a></div>
						<?php if (!empty($_GET["error"])) { ?><div style="text-align: center; color: red; margin-top: 10px;">Invalid username or password</div><?php } ?>
			</div>

			<div id="signUpDialog" style="display:none;">
				<div class="login" style="margin-bottom: 10px;"><a href="#" onclick="$('#signUpDialog').hide();$('#loginDialog').fadeIn();">&laquo;Back</a></div>
	            <div style="width: 80%; margin: auto; text-align: center;">
	            	<form action="signUp.php" method="post" id="signUpForm">
		            	<input style="font-size: 12px; width: 80%;" type="text" placeholder="Username" name="user">
		            	<input style="font-size: 12px; width: 80%;" type="password" placeholder="Password" name="pass">
		            	<input style="font-size: 12px; width: 80%;" type="text" placeholder="Name" name="name">
		            	<input style="font-size: 12px; width: 80%;" type="text" placeholder="Surname" name="surname">
		            	
		            </form>
	            </div>
						<div class="login" style="text-align: center;"><a onclick="$('#signUpForm').submit();" href="#">Sign up</a></div>
			</div><?php } else { ?>

			<p>Welcome, <i><?php echo $user["name"].' '.$user["surname"]; ?></i></p>
			<p><a href="logOut.php">Log out</a></p>

			<?php } ?>

			<div style="margin-bottom: 20px;"></div>
			<hr class="fancy-line"></hr>

			<div style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
				<a href="donate.php" class="btn">Donate</a>

			</div>					
        </div>

