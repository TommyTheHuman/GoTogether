<?php
    include_once'dbconfig.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn,$_POST['surname']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $birthDate = mysqli_real_escape_string($conn,$_POST['birthDate']);
    $gender = mysqli_real_escape_string($conn,$_POST['Sesso']);

    $sql="insert into utente (nome, cognome, email, password, datanascita, gender)values('$name','$surname','$email','$password','$birthDate','$gender');";
mysqli_query($conn,$sql);

header("location: ../index.php?");
?>