<?php

session_start();

$transaction = new Transaction();
$response = new Response();
$session = new Session($transaction);
$register = new Register($transaction);
$pet_register = new PetRegister($transaction);
