<!DOCTYPE html>
<html>

    <!-- the head section -->
    <head>
        <title>Soccer Central</title>
        <link rel="stylesheet" type="text/css" href="soccer.css"/>
    </head>


    <body>
        <header><h1>Soccer Central</h1></header>

        <main>
            <h1>Team Information</h1>

<!--            <img src="<?php// echo $user['profilePic'] ?>" width="100" height="125"><br>-->

            <table>
                <tr>
                    <td>Team Name:</td>
                    <td>League:</td>
                    <td>City:</td>
                    <td>Funds:</td>
                    <td>Salary Cap:</td>
                    <td>Other Costs:</td>
                </tr>

                <tr>
                    <td><input type='text' name='teamName' value='<?php echo $team['teamName']; ?>' disabled></td>
                    <td><input type='text' name='league' value='<?php echo $team['league']; ?>' disabled></td>
                    <td><input type='text' name='city' value='<?php echo $team['city']; ?>' disabled></td>
                    <td><input type='text' name='funds' value='<?php echo $team['funds']; ?>' disabled></td>
                    <td><input type='text' name='salaryCap' value='<?php echo $team['salaryCap']; ?>' disabled></td>
                    <td><input type='text' name='otherCosts' value='<?php echo $team['otherCosts']; ?>' disabled></td>
                </tr>
            </table><br>



<!--            <br>
            <p><a href="index.php?action=showEditProfile" >Edit Info</a></p>
            <p><a href="index.php?action=allUsers" >Display users</a></p>
            <p><a href="index.php">Register new user</a></p>-->

        </main>


    </body>
</html>
