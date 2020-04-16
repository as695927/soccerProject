<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Soccer Central</title>
        <link rel="stylesheet" type="text/css" href="soccer.css"/>
    </head>
    <body>
    <main>  
    <h1>Soccer Central</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="teamLogin">

    <h3>Team Login</h3>        

        <label for="teamName">Team Name:  </label>
        <input type="text" name="teamName" value="<?php echo $teamName; ?>">
        <span class="errorMsg"> <?php echo $teamNameError ?></span> 
        <br><br>
        
        <label for="password">Password: </label>
        <input type="password" name="password">
        <span class="errorMsg"> <?php echo $passwordError ?></span> 
        
        <br>
        <br>
    <input type="submit" value="Log In">
    <br>

    </form>
<p><a href="index.php?action=register">Register</a><br></p>
    </main>			
    </body>
</html>
