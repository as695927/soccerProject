<?php

class Team {
    private $teamName, $league, $city, $funds, $salaryCap, $otherCosts, $password;
    
    function __construct($teamName, $league, $city, $funds, $salaryCap, $otherCosts, $password) {
        $this->teamName = $teamName;
        $this->league = $league;
        $this->city = $city;
        $this->funds = $funds;
        $this->salaryCap = $salaryCap;
        $this->otherCosts = $otherCosts;
        $this->password = $password;
    }

    function getTeamName() {
        return $this->teamName;
    }

    function getLeague() {
        return $this->league;
    }

    function getCity() {
        return $this->city;
    }

    function getFunds() {
        return $this->funds;
    }

    function getSalaryCap() {
        return $this->salaryCap;
    }

    function getOtherCosts() {
        return $this->otherCosts;
    }

    function getPassword() {
        return $this->password;
    }

    function setTeamName($teamName) {
        $this->teamName = $teamName;
    }

    function setLeague($league) {
        $this->league = $league;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setFunds($funds) {
        $this->funds = $funds;
    }

    function setSalaryCap($salaryCap) {
        $this->salaryCap = $salaryCap;
    }

    function setOtherCosts($otherCosts) {
        $this->otherCosts = $otherCosts;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
