<!DOCTYPE html>
<html>

    <!-- the head section -->
    <head>
        <title>Limabook</title>
        <link rel="stylesheet" type="text/css" href="usersCSS.css"/>
    </head>

    <!-- the body section -->
    <body>
        <header><h1>Limabook</h1></header>

        <main>
            <h1>User List</h1>




            <table id="usersTable">
                <tr>
                    <th>First Name</th>            
                    <th>Last Name</th>
                    <th>Team</th>
                    <th>Cost</th>
                    <th>Player ID</th>
                    <th>Trade For</th>
                    <th>Release</th>
                </tr>

                <?php foreach ($players as $player) { ?>
                    <tr>
                        <td><?php echo $user['pFirstName'] ?></td>
                        <td><?php echo $user['pLastName'] ?></td>
                        <td><?php echo $user['team'] ?></td>
                        <td><?php echo $user['cost'] ?></td>
                        <td><?php echo $user['playerID'] ?></td>
                        <td>
                            <form action="index.php" method="post">
                            <input type="hidden" name="action" value="trade">
                            <input type="button" name="trade" value="Trade">         
                            </form>
                        </td>
                        <td>
                            <form action="index.php" method="post">
                            <input type="hidden" name="action" value="release">
                            <input type="button" name="release" value="Release">         
                            </form>
                        </td>
                    </tr>
                <?php } ?>


            </table>
>
            <a href="index.php">Welcome Page</a> 
            <br>

        </main>


    </body>

</html>
