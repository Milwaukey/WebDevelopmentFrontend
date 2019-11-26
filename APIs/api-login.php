<?php

require_once(__DIR__ . '/../includes/connection.php'); 
require_once(__DIR__ . '/functions.php'); 


// GETS THE INFORMATION
$tLogin = $_POST['tLogin'];
$tPassword = $_POST['tPassword'];



// CHECK IF tLogin is an email or an username
if( FILTER_VAR($tLogin, FILTER_VALIDATE_EMAIL) ){


    // Checks if the email exists in the database 
    $query = "SELECT email, password, photographerID FROM tphotographers WHERE email = '$tLogin' ";

    // Get the result from the database
    $results = mysqli_query($db, $query);

    // var_dump($results);

    // If it doesn't exists the send response to the browser about wrong credentials 
    if( mysqli_num_rows($results) == 0){

        echo sendResponse(0, 'Wrong Credentials!', __LINE__);

    }

    // IF TRUE  - loop trough the objecdt
    while($row = mysqli_fetch_array($results)){

        // CHECK THE PASSWORD 
        if( !password_verify( $tPassword, $row['password'] ) ){

            echo sendResponse(0, 'Wrong Credentials!', __LINE__);

        }



        $loginType = 'photographer';
        $loginID = $row['photographerID'] ;    


        echo sendResponse(1, 'Correct Login!', __LINE__);

    }



}else {

    // Checks if the email exists in the database 
    $query = "SELECT userID, email, username, password FROM tusers WHERE username = '$tLogin' ";

    // Get the result from the database
    $results = mysqli_query($db, $query);

    // var_dump($results);

    // If it doesn't exists the send response to the browser about wrong credentials 
    if( mysqli_num_rows($results) == 0){

        echo sendResponse(0, 'Wrong Credentials!', __LINE__);

    }

    // IF TRUE  - loop trough the objecdt
    while($row = mysqli_fetch_array($results)){

        // CHECK THE PASSWORD 
        if( !password_verify( $tPassword, $row['password'] ) ){

            echo sendResponse(0, 'Wrong Credentials!', __LINE__);

        }



        $loginType = 'user';
        $loginID = $row['userID'] ;    


        echo sendResponse(1, 'Correct Login!', __LINE__);

    }


    // // Checks if the username exists in the database 
    // $query = 'SELECT username FROM tusers WHERE username =' . $tLogin ;

    // // Get the result from the database
    // $reulsts = mysqli_query($db, $query);

    // // If it doesn't exists the send response to the browser about wrong credentials 
    // if( $results == 'false' ){

    //     echo sendResponse('O', 'Wrong Credentials!', __LINE__);

    // }

    // // Check if it matches the password in the database
    // $query = 'SELECT password FROM tusers WHERE username = ' . $tLogin ;

    // $loginType = 'user';

}