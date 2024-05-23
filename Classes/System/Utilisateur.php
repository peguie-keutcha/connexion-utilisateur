<?php
namespace Classes\System;

use IUtilisateur;

class Utilisateur implements IUtilisateur {
    private $identity;
    private $email;
    private $adresses;

    public function __construct($identity, $email, $adresses) {
        $this->identity = $identity;
        $this->email = $email;
        $this->adresses = $adresses;
    }




    

    public function GetIdentity(): string {
        return "";
    }

    public function GetEMail(): string {
        return "";
        
    }

    public function GetAdresses(): array {
        return [];
        
    }

    public function __toString(): string {
        return "";
    
    }
}
