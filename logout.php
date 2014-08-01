<?php require_once 'core/init.php'; 
$user = new User();
$user->logout();

Session::flash('home', 'You sucessfuly loged out! ');
Redirect::to('index.php');
