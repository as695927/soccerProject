<?php

$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
session_set_cookie_params($lifetime, '/');
session_start();

if (empty($_SESSION['logged_in_team'])) {
    $_SESSION['logged_in_team'] = "defaultTeam";
}

$action = filter_input(INPUT_POST, "action");
if ($action === null) {
    $action = filter_input(INPUT_GET, "action");
    if ($action === null) {
        $action = "welcome";
    }
}

switch ($action) {
    case "welcome":
        include 'view/welcomePage.php';
        die();
        break;
    case "allPlayers":
        if ($_SESSION['logged_in_team'] !== 'defaultTeam') {
            $team = TeamDB::get_team_by_teamName($_SESSION['logged_in_team']);
            $players = PlayerDB::select_all_order_cost();
            include 'view/displayPlayers.php';
        } else {
            include 'view/welcomePage.php';
        }
        die();
        break;
    case "allTeams":
        if ($_SESSION['logged_in_team'] !== 'defaultTeam') {
            $team = TeamDB::get_team_by_teamName($_SESSION['logged_in_team']);
            $teams = TeamDB::select_all_order();
            include 'view/displayTeams.php';
        } else {
            include 'view/welcomePage.php';
        }
        die();
        break;
    case "addTeam":
        $teamName = filter_input(INPUT_POST, 'teamName');
        $league = filter_input(INPUT_POST, 'league');
        $city = filter_input(INPUT_POST, 'city');
        $funds = filter_input(INPUT_POST, 'funds');
        $salaryCap = filter_input(INPUT_POST, 'salaryCap');
        $otherCosts = filter_input(INPUT_POST, 'otherCosts');
        $password = filter_input(INPUT_POST, 'password');
        $_SESSION['logged_in_team'] = $teamName;

        $teamNameError = '';
        if ($teamName == '') {
            $teamNameError = 'Team name is required.';
        } else if (!preg_match('/^[A-Za-z]/', $league)) {
            $teamNameError = 'Team name must start with a letter';
        } else {
            $teamNameError = '';
        }
        $leagueError = '';
        if ($league == '') {
            $leagueError = 'league name is required.';
        } else if (!preg_match('/^[A-Za-z]/', $league)) {
            $leagueError = 'league name must start with a letter';
        } else {
            $leagueError = '';
        }
        $cityError = '';
        if ($city == '') { 
            $cityError = 'City is required.';
        } else if (!preg_match('/^[A-Za-z]/', $city)) {
            $cityError = 'City must start with a letter';
        } else {
            $cityError = '';
        }
        $fundsError = '';
        if ($funds == '') { 
            $fundsError = 'Funds cannot be blank.';
        } else if (!preg_match('/^[0-9]/', $funds)) {
            $fundsError = 'Funds must be a number';
        } else {
            $fundsError = '';
        }
        $salaryCapError = '';
        if ($salaryCap == '') { 
            $salaryCapError = 'Salary Cap cannot be blank.';
        } else if (!preg_match('/^[0-9]/', $salaryCap)) {
            $salaryCapError = 'Salary Cap must be a number';
        } else {
            $salaryCapError = '';
        }
        $otherCostsError = '';
        if ($otherCosts == '') { 
            $otherCostsError = 'Other costs cannot be blank.';
        } else if (!preg_match('/^[0-9]/', $otherCosts)) {
            $otherCostsError = 'Other costs must be a number';
        } else {
            $otherCostsError = '';
        }
        
        $totalCosts = $salaryCap + $otherCosts;
        $accError = '';
        if ($totalCosts != $funds) {
            $accError = "The total of salary cap and other costs must equal the team's funds";
        } else {
            $accError = '';
        }

        $pwdCapital = "Must have a capital letter";
        $pwdLower = "Must have a lower case letter";
        $pwdNum = "Must include a number";
        $pwdNonword = "Must have a special character";
        $pwdLength = "Must be at least 8 characters long";
        $counter = 0;
        $password_valid = true;

        if (preg_match('/[A-Z+]/', $password)) {
            $counter += 1;
            $pwdCapital = "";
        }
        if (preg_match('/[a-z+]/', $password)) {
            $counter += 1;
            $pwdLower = "";
        }
        if (preg_match('/[0-9+]/', $password)) {
            $counter += 1;
            $pwdNum = "";
        }
        if (preg_match('/[\W+]/', $password)) {
            $counter += 1;
            $pwdNonword = "";
        }
        if ($counter < 3) {
            $passwordError = "Must meet at least 3 of the 4 requirements";
            $password_valid = false;
        } else {
            $pwdCapital = "";
            $pwdLower = "";
            $pwdNum = "";
            $pwdNonword = "";
            $passwordError = "";
            $password_valid = true;
        }
        if (strlen($password) < 8) {
            $passwordError = $pwdLength;
            $password_valid = false;
        } else {
            $password_valid = true;
        }

        if ($password_valid) {
            $pwdHash = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty(TeamDB::check_for_unique_teamName($teamName))) {
            $teamNameError = "This team already has an account. Please log in.";
        }
     
        if ($teamNameError !== '' || $leagueError !== '' || $cityError !== '' || $fundsError !== '' 
             || $salaryCapError !== '' || $otherCostsError !== '' || $accError !== ''|| $passwordError !== '') {
            include("./view/addTeam.php");
            die();
        } else {
            $teams = new Team($teamName, $league, $city, $funds, $salaryCap, $otherCosts, $pwdHash);
            TeamDB::add_team($teams);
            include("./view/teamProfile.php");
            die();
        }
        break;
    case "register":
        if (!isset($teamName)) {$teamName = '';}
        if (!isset($league)) {$league = '';}
        if (!isset($city)) {$city = '';}
        if (!isset($funds)) {$funds = '';}
        if (!isset($salaryCap)) {$salaryCap = '';}
        if (!isset($otherCosts)) {$otherCosts = '';}
        if (!isset($password)) {$password = '';}
        if (!isset($teamNameError)) {$teamNameError = '';}
        if (!isset($leagueError)) {$leagueError = '';}
        if (!isset($cityError)) {$cityError = '';}
        if (!isset($fundsError)) {$fundsError = '';}
        if (!isset($salaryCapError)) {$salaryCapError = '';}
        if (!isset($otherCostsError)) {$otherCostsError = '';}
        if (!isset($passwordError)) {$passwordError = '';}
        if (!isset($pwdCapital)) {$pwdCapital = '';}
        if (!isset($pwdLower)) {$pwdLower = '';}
        if (!isset($pwdNum)) {$pwdNum = '';}
        if (!isset($pwdNonword)) {$pwdNonword = '';}
        include 'view/addTeam.php';
        die();
        break;
    case "teamLogin":
        $teamName = filter_input(INPUT_POST, 'teamName');
        $password = filter_input(INPUT_POST, 'password');
        $pwdHash = teamDB::get_password($teamName);

        if (password_verify($password, $pwdHash)) {
            $passwordError = "";
            $_SESSION['logged_in_team'] = $teamName;
            $teams = TeamDB::get_team_by_teamName($teamName);
            include'./view/teamProfile.php';
            die();
      
        } else {
            $passwordError = "Password is invalid.";
        }

        if (!isset($passwordError)) {$passwordError = '';}
        if (!isset($teamNameError)) {$teamNameError = '';}
        if (!isset($teamName)) {$teamName = '';}
        if (!isset($password)) {$password = '';}
        include './view/teamLogin.php';
        die();
        break;
    case "loginPage":
        if (!isset($passwordError)) {$passwordError = '';}
        if (!isset($teamNameError)) {$teamNameError = '';}
        if (!isset($teamName)) {$teamName = '';}
        if (!isset($password)) {$password = '';}
        include './view/teamLogin.php';
        die();
        break;
    case "teamPage":
        if (isset($_GET['teamName'])) {
            $teamTemp = $_GET['teamName'];
            $_SESSION['logged_in_team'] = $teamTemp;
            $logged_in_team = $_SESSION['logged_in_team'];
            $teams = TeamDB::get_team_by_teamName($teamTemp);
            include './view/teamProfile.php';
            die();
        } else {
            $teamName = filter_input(INPUT_POST, 'teamName');
            $_SESSION['logged_in_team'] = $teamName;
            $logged_in_team = $_SESSION['logged_in_team'];
            $teams = TeamDB::get_team_by_teamName($teamName);
            include './view/teamProfile.php';
            die();
            break;
        }
     case "register":
        if (!isset($teamName)) {$teamName = '';}
        if (!isset($league)) {$league = '';}
        if (!isset($city)) {$city = '';}
        if (!isset($funds)) {$funds = '';}
        if (!isset($salaryCap)) {$salaryCap = '';}
        if (!isset($otherCosts)) {$otherCosts = '';}
        if (!isset($password)) {$password = '';}
        if (!isset($teamNameError)) {$teamNameError = '';}
        if (!isset($leagueError)) {$leagueError = '';}
        if (!isset($cityError)) {$cityError = '';}
        if (!isset($fundsError)) {$fundsError = '';}
        if (!isset($salaryCapError)) {$salaryCapError = '';}
        if (!isset($otherCostsError)) {$otherCostsError = '';}
        if (!isset($passwordError)) {$passwordError = '';}
        if (!isset($pwdCapital)) {$pwdCapital = '';}
        if (!isset($pwdLower)) {$pwdLower = '';}
        if (!isset($pwdNum)) {$pwdNum = '';}
        if (!isset($pwdNonword)) {$pwdNonword = '';}
        include 'view/addTeam.php';
        die();
        break;
    case "teamLogin":
        $teamName = filter_input(INPUT_POST, 'teamName');
        $password = filter_input(INPUT_POST, 'password');
        $pwdHash = TeamDB::get_password($teamName);

        if (password_verify($password, $pwdHash)) {
            $passwordError = "";
            $_SESSION['logged_in_team'] = $teamName;
            $teams = TeamDB::get_team_by_teamName($teamName);
            include'./view/teamProfile.php';
            die();
            break;
        } else {
            $passwordError = "Password is invalid.";
        }
        include './view/teamLogin.php';
        die();
        break;
    case "release":
        $_SESSION['logged_in_team'] = $teamName;
        $teams = TeamDB::get_team_by_teamName($teamName);
        PlayerDB::release_player($playerID);
        die();
        break;
    case "trade":
        $_SESSION['logged_in_team'] = $teamName;
        $teams = TeamDB::get_team_by_teamName($teamName);
        PlayerDB::trade_player($playerID);
        die();
        break;
    default:
        break;
}
?>
