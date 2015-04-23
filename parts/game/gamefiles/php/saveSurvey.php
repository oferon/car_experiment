<?php


require_once __DIR__ . '/../../../common/autoloader.php';
require_once __DIR__ . '/model/FormField.php';
require_once __DIR__ . '/model/FormValidator.php';
require_once __DIR__ . '/ctrl/GameDataCtrl.php';

use carexperiment\parts\common\RedirectMapper as RedirectMapper;
use carexperiment\GameDataCtrl as GameDataCtrl;

session_start();

$mapper = new RedirectMapper();

$err_shuttle_rating=false; 
$err_shuttle_rating_text="";

//If $_SESSION['user_id'] not set, user is not logged in. Send back to login page
if( ! isset($_SESSION['user_id']))
{
    $url = $mapper->getDestination('login');
    header('Location: ' . $url );
    exit();
}

/* @var $user_id Stroes the value of logged in user_id */
$user_id=$_SESSION['user_id'];

/* 
 * $_SESSION['errors'] will hold all errors that need to be passed to the form
 * Starte by unsetting it
 */

unset($_SESSION['f_errs']); // clear all errors...
unset($_SESSION['form_err']); // clear main form error


/*
 * Initialize an array of FormFields
 */
$fields = [];
$fields[] = new FormField('survey_id',null,false);
$fields[] = new FormField('Q1',null,true);
$fields[] = new FormField('Q2',null,true);


//Loop through each field and assisgn values from the $_POST
foreach( $fields as $field )
{
    $fname = $field->getName();
    
    if( isset($_POST[$fname])){
        $field->setValue($_POST[$fname]);
    }
    
}

/* @var $validator FormValidator */
$validator = new FormValidator($fields);

/* @var $errors array of validation errors NAME=>VALUE pairs */
$errors = $validator->validate();

if( !empty($errors))
{
    $_SESSION['form_err'] = "Please correct errors below";
    $_SESSION['f_errs'] = $errors;
    
    $url = $mapper->getDestination('survey');
    header('Location: ' . $url );
    exit();
}

$data_crl = new GameDataCtrl();

try {
    
    $data_crl->recordSuveyResult($fields, $user_id);
        
} catch (Exception $ex) {
    
    $_SESSION['form_err'] = "Error writing to the database: " . $ex->getMessage();
    
    $url = $mapper->getDestination('survey');
    header('Location: ' . $url );
    exit();
    
}

$_SESSION['session_num'] = 2;

$url = $mapper->getDestination('game');
header('Location: ' . $url );
exit();

//Save the data

