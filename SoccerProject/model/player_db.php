<?php

class PlayerDB {

    public static function select_all() {
        $db = Database::getDB();

        $query = 'SELECT * FROM players';
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        return $results;
    }

    public static function select_all_order_cost() {
        $db = Database::getDB();

        $query = 'SELECT * FROM players
                           ORDER BY cost';
        $statement = $db->prepare($query);
        $statement->execute();
        $players = $statement->fetchAll();
        $statement->closeCursor();
        return $players;
    }

    public static function get_player_by_playerID($playerID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM players
                  WHERE playerID = :playerID';
        $statement = $db->prepare($query);
        $statement->bindValue(":playerID", $playerID);
        $statement->execute();
        $players = $statement->fetch();
        $statement->closeCursor();
        return $players;


    }

    public static function release_player($playerID) {
        $db = Database::getDB();

        $team = $team->getTeamName();

        try {  
            $query = 'UPDATE players 
                         SET team = "Free Agent"
                         WHERE playerID = :playerID';
            $statement = $db->prepare($query);
            $statement->bindValue(':team', $team);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include("index.php");
            exit();
        }
    }

    public static function trade_player($playerID) {
        $db = Database::getDB();

        $team = $team->getTeamName();

        try {  
            $query = 'UPDATE players 
                         SET team = :teamName
                         WHERE playerID = :playerID';

            $statement = $db->prepare($query);
            $statement->bindValue(':team', $team);
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