<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Soccer Central</title>
        <link rel="stylesheet" type="text/css" href="soccer.css"/>
    </head>
    <body>
    <main>
        <h1>Soccer Central</h1><br>
        
    <h2>Register A Team</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="addTeamOfficial">

    <fieldset> 
    <legend>Registration</legend>
        <label>Team Name: </label>
        <input type="text" name="teamName" value="<?php echo $teamName; ?>">
        <span class="errorMsg"> <?php echo $teamNameError ?></span> 
        <br>

        <label>League: </label>
        <input type="text" name="league" value="<?php echo $league; ?>">
        <span class="errorMsg"> <?php echo $leagueError ?></span> 
        <br>
        
        <label>City: </label>
        <input type="text" name="city" value="<?php echo $city; ?>">
        <span class="errorMsg"> <?php echo $cityError ?></span> 
        <br>

        <label>Funds:  </label>
        <input type="text" name="funds" value="<?php echo $funds; ?>">
        <span class="errorMsg"> <?php echo $fundsError ?></span> 
        <br>
        
        <label>Salary Cap: </label>
        <input type="text" name="salaryCap" value="<?php echo $salaryCap; ?>">
        <span class="errorMsg"> <?php echo $salaryCapError ?></span> 
        <br>
        
        <label>Other Costs: </label>
        <input type="text" name="otherCosts" value="<?php echo $otherCosts; ?>">
        <span class="errorMsg"> <?php echo $otherCostsError ?></span> 
        <br>
        
        <label>Password: </label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="errorMsg"> <?php echo $passwordError ?></span> 
        <br><span class="errorMsg"><?php echo $pwdCapital?></span>
        <br><span class="errorMsg"><?php echo $pwdLower?></span>
        <br><span class="errorMsg"><?php echo $pwdNum?></span>
        <br><span class="errorMsg"><?php echo $pwdNonword?></span>   
        <br>
    </fieldset>
        <br>
    <input type="submit" value="Submit">
    <br>

    </form>
<p><a href="index.php?action=loginPage">Already registered? Log In</a></p>
    </main>			
    </body>
</html>
