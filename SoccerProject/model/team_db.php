<?php

class TeamDB {

    public static function select_all() {
        $db = Database::getDB();

        $query = 'SELECT * FROM teams';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    public static function select_all_order() {
        $db = Database::getDB();

        $query = 'SELECT * FROM teams
                           ORDER BY teamName';
        $statement = $db->prepare($query);
        $statement->execute();
        $teams = $statement->fetchAll();
        $statement->closeCursor();
        return $teams;
    }

    public static function get_team_by_teamName($teamName) {
        $db = Database::getDB();
        $query = 'SELECT * FROM teams
                  WHERE teamName = :teamName';
        $statement = $db->prepare($query);
        $statement->bindValue(":teamName", $teamName);
        $statement->execute();
        $teams = $statement->fetch();
        $statement->closeCursor();
        return $teams;
    }

    public static function check_for_unique_teamName($teamName) {
        $db = Database::getDB();
        $uniqueQuery = 'SELECT teamName FROM teams WHERE teamName = :teamName;';
        $uniqueStatement = $db->prepare($uniqueQuery);
        $uniqueStatement->bindValue(':teamName', $teamName);
        $uniqueStatement->execute();
        $teamIsUnique = $uniqueStatement->fetch();
        $uniqueStatement->closeCursor();
        return $teamIsUnique;
    }

    public static function get_password($teamName) {
        $db = Database::getDB();
        $query = 'SELECT password FROM teams
                  WHERE teamName = :teamName';
        $statement = $db->prepare($query);
        $statement->bindValue(":teamName", $teamName);
        $statement->execute();
        $password = $statement->fetch();
        $statement->closeCursor();
        if ($password === false) {
            return false;
        }
        return $password[0];
    }

    public static function add_team($teams) {
        $db = Database::getDB();

        $teamName = $teams->getTeamName();
        $league = $teams->getLeague();
        $city = $teams->getCity();
        $funds = $teams->getFunds();
        $salaryCap = $teams->getSalaryCap();
        $otherCosts = $teams->getOtherCosts();
        $password = $teams->getPassword();


        try {  
            $query = 'INSERT INTO teams
                     (teamName, league, city, funds, salaryCap, otherCosts, password)
                  VALUES
                     (:teamName, :league, :city, :funds, :salaryCap, :otherCosts, :password)';
            $statement = $db->prepare($query);
            $statement->bindValue(':teamName', $teamName);
            $statement->bindValue(':league', $league);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':funds', $funds);
            $statement->bindValue(':salaryCap', $salaryCap);
            $statement->bindValue(':otherCosts', $otherCosts);
            $statement->bindValue(':password', $password);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include("index.php");
            exit();
        }
    }

    public static function update_team_info($teams) {
        $db = Database::getDB();

        $teamName = $teams->getTeamName();
        $league = $teams->getLeague();
        $city = $teams->getCity();
        $funds = $teams->getFunds();
        $salaryCap = $teams->getSalaryCap();
        $otherCosts = $teams->getOtherCosts();
        $password = $teams->getPassword();

        try { 
            $query = 'UPDATE teams 
                         SET teamName = :teamName, league = :league,
                         city = :city, funds = :funds, salaryCap = :salaryCap,
                         otherCosts = :otherCosts, password = :password
                         WHERE teamName = :teamName';

            $statement = $db->prepare($query);
            $statement->bindValue(':teamName', $teamName);
            $statement->bindValue(':league', $league);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':funds', $funds);
            $statement->bindValue(':salaryCap', $salaryCap);
            $statement->bindValue(':otherCosts', $otherCosts);
            $statement->bindValue(':password', $password);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include("index.php");
            exit();
        }
    }

}
?>

