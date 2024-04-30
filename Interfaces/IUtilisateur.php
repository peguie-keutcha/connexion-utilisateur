<?php

interface IUtilisateur {
    public function GetIdentity() : string;

    public function GetEMail() : string;
    public function GetAdresses() : array;
    public function __toString();
}
