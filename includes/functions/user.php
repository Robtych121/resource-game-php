<?php

function setAdminPassword(){
    include 'includes/config/db_connection.php';
    $newps = password_hash('welcome', PASSWORD_DEFAULT);
    $stmt = $conn->prepare('UPDATE users SET password=? WHERE id = 1');
    $stmt -> bind_param('s', $newps);
    $stmt -> execute();
    $stmt -> close();
}

function LoggedInRedirect(){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    } 
}

function IsLoggedIn(){
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        return true;
    }
}

function LoggedOutRedirect(){
    if(!isset($_SESSION["loggedin"])){
        header("location: login.php");
        exit;
    } 
}


function getUserIDFromDB($uid, $pid){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE username =? AND password =? LIMIT 1');
    $stmt -> bind_param('ss', $uid, $pid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($id);
    $stmt -> fetch();
    $stmt -> close();
    return $id;
}


function checkUserPassword($uid){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT password FROM users WHERE username =? AND active = 1 LIMIT 1');
    $stmt -> bind_param('s', $uid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($pid);
    $stmt -> fetch();
    $stmt -> close();
    return $pid;
}

function checkUsernameAlreadyExists($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE username =?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}


function checkEmailAlreadyExists($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT id FROM users WHERE email =?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}


function registerUser($input, $activationKey){
    $new_ps = password_hash($input['password'], PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('INSERT INTO users(username, email, password, activationKey) VALUES (?, ?, ?, ?)');
    $stmt -> bind_param('ssss', $input['username'], $input['email'], $new_ps, $activationKey);
    $stmt -> execute();
    $stmt -> close();
}


function checkUserIsActive($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT active FROM users WHERE username =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUsernameDetail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT username FROM users WHERE id =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUserEmail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT email FROM users WHERE id =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function getUsernameFromEmailDetail($input) {
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('SELECT username FROM users WHERE email =? LIMIT 1');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($active);
    $stmt -> fetch();
    $stmt -> close();
    return $active;
}

function activateAccount($input){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET active= 1 WHERE activationKey = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt -> close();

    $stmt = $conn->prepare('SELECT id FROM users WHERE active = 1 AND activationKey = ?');
    $stmt -> bind_param('s', $input);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}

function SetRecoveryKey($email, $key){
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET recoveryKey= ? WHERE email = ?');
    $stmt -> bind_param('ss', $key, $email);
    $stmt -> execute();
    $stmt -> close();
}


function recoverAccount($input, $recoveryKey){
    $new_ps = password_hash($input, PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET password= ? WHERE recoveryKey = ?');
    $stmt -> bind_param('ss', $new_ps, $recoveryKey);
    $stmt -> execute();
    $stmt -> close();

    $stmt = $conn->prepare('SELECT id FROM users WHERE password = ? AND recoveryKey = ?');
    $stmt -> bind_param('ss', $new_ps, $recoveryKey);
    $stmt -> execute();
    $stmt->bind_result($found);
    $stmt->fetch();
    if ($found)
    {
        return true;
    } else {
        return false;
    }
}

function clearActivationKey($input){
    $key = '';
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET activationKey = ? WHERE activationKey = ?');
    $stmt -> bind_param('ss', $key, $input);
    $stmt -> execute();
    $stmt -> close();  
}


function clearRecoveryKey($input){
    $key = '';
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET recoveryKey = ? WHERE recoveryKey = ?');
    $stmt -> bind_param('ss', $key, $input);
    $stmt -> execute();
    $stmt -> close();  
}


function changePassword($uid, $pid) {
    $new_ps = password_hash($pid, PASSWORD_DEFAULT);
    include 'includes/config/db_connection.php';
    $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
    $stmt -> bind_param('ss', $new_ps, $uid);
    $stmt -> execute();
    $stmt -> close();
}

?>