<?php require_once './connect.php' ?>

<?php
    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $cPassword = $_POST['cPassword'];
        $userCheck = '';

        session_start();

        $userCheck = $_SESSION['username'];


            $aNo = $_SESSION['accountNo'];
    
            if(!empty($username) && !empty($password) && !empty($cPassword)){
                
                $userCheck = ($connection -> query("SELECT * FROM useraccount WHERE Username = '$username'"));
    
                if(mysqli_num_rows($userCheck) > 0){
                    $_SESSION['checkData'] = 'Username is Already taken! Try with another username';
                    header("Location:./errorPage.php");
                }
                else{
                    if($password == $cPassword){
    
                        if(!(strlen($cPassword) >= 6)){
                            $_SESSION['checkData'] = 'Password is too short! Password must be have at least 6 characters';
                            header("Location:./errorPage.php");
    
                        }
                        else{
    
                            $sql =($connection->query("UPDATE  useraccount SET Username = '$username', Apassword = '$cPassword' WHERE AccountNo = '$aNo'")); 
    
                            if($sql){
                                header("Location:../html/login.html");
                            }
                            else{
                                $_SESSION['checkData'] = 'File Submission is Failed';
                                header("Location:./errorPage.php");
    
                            }
                        }
                    }
                    else{
                        $_SESSION['checkData'] = 'Passwords are not Matched! Try again';
                        header("Location:./errorPage.php");
                    }
    
                }
            }
            else{
                $_SESSION['checkData'] = 'Input fields are empty!';
                header("Location:./errorPage.php");
    
            }
        }

    else{
        $errorMessage = 'Something wrong!';
        require_once './errorPage.php';
    }

?>


<?php $connection->close() ?>