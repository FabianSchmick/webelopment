<?php

/*
 * PDO examples
 */


/* SELECT binding parameter */

$id = 1;    // Should be some dynamic variable

try{
    $connection = new PDO($dbType.':host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPassword);

    $stmt = $connection->prepare('SELECT * FROM users WHERE id = :id');  // This query is send of, before the variable is inserted


    /* First method */
    $stmt->execute( array (
       'id' => $id          // Then the query is executed with the param (Secure SQL injection)
    ));

    /* Second method with type */
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);   // More secure, because of type
    $stmt->execute();


    while($row = $stmt->fetch()) {
        var_dump($row);
    }

} catch(PDOException $e) {
    echo 'ERROR: '.$e->getMessage();
}




/* INSERT binding parameter */

try{
    $connection = new PDO($dbType.':host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPassword);

    $stmt = $connection->prepare('INSERT INTO users(username) VALUES(:username)');  // This query is send of, before the variable is inserted
    $stmt->bindParam('username', $username, PDO::PARAM_STR);

    $usernames = array('Luke', 'Yoda');
    foreach ($usernames as $username) {     // Must be $username, because of :username
        $stmt->execute();
    }

} catch(PDOException $e) {
    echo 'ERROR: '.$e->getMessage();
}


