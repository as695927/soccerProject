<?php

class Players {
    private $pFirstName, $pLastName, $team, $cost, $playerID;
    
    function __construct($pFirstName, $pLastName, $team, $cost, $playerID) {
        $this->pFirstName = $pFirstName;
        $this->pLastName = $pLastName;
        $this->team = $team;
        $this->cost = $cost;
        $this->playerID = $playerID;
    }

    function getPFirstName() {
        return $this->pFirstName;
    }

    function getPLastName() {
        return $this->pLastName;
    }

    function getTeam() {
        return $this->team;
    }

    function getCost() {
        return $this->cost;
    }

    function getPlayerID() {
        return $this->playerID;
    }

    function setPFirstName($pFirstName) {
        $this->pFirstName = $pFirstName;
    }

    function setPLastName($pLastName) {
        $this->pLastName = $pLastName;
    }

    function setTeam($team) {
        $this->team = $team;
    }

    function setCost($cost) {
        $this->cost = $cost;
    }

    function setPlayerID($playerID) {
        $this->playerID = $playerID;
    }

}
