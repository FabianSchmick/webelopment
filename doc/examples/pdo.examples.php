<?php

use Model\Database;

/*
 * PDO examples
 */


/* ---------------------------------------------------------------- */
/*                Call query method from Database                */
/* ---------------------------------------------------------------- */



$pdoDb = new Database("type", "host", "name", "user", "password");

$connection = $pdoDb->initializePDOObject();

$result = $pdoDb->query($connection, 'SELECT * FROM users WHERE id = :id', array('id' => $id));




/* ---------------------------------------------------------------- */
/*                  SELECT with binding parameter                   */
/* ---------------------------------------------------------------- */

$id = 1;    // Should be some dynamic variable

try{
    $pdoDb = new Database("type", "host", "name", "user", "password");

    $connection = $pdoDb->initializePDOObject();

    $stmt = $connection->prepare('SELECT * FROM users WHERE id = :id');  // This query is send of, before the variable is inserted

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);   // More secure, because of type
    $stmt->execute();


    while($row = $stmt->fetch()) {
        var_dump($row);
    }

} catch(PDOException $e) {
    echo 'ERROR: '.$e->getMessage();
}




/* ---------------------------------------------------------------- */
/*                   INSERT with binding parameter                  */
/* ---------------------------------------------------------------- */

try{
    $pdoDb = new Database("type", "host", "name", "user", "password");

    $connection = $pdoDb->initializePDOObject();

    $stmt = $connection->prepare('INSERT INTO users(username) VALUES(:username)');  // This query is send of, before the variable is inserted
    $stmt->bindParam('username', $username, PDO::PARAM_STR);

    $usernames = array('Luke', 'Yoda');
    foreach ($usernames as $username) {     // Must be $username, because of :username
        $stmt->execute();
    }

} catch(PDOException $e) {
    echo 'ERROR: '.$e->getMessage();
}

