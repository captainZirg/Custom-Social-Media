<?php

    $con = mysqli_connect("localhost","root","","social");
    if(!$con)
    {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    $fname="";
    $lname="";
    $username="";
    $email="";
    $pass="";
    $con_pass="";
    $date="";
    $error_array="";
    $API_VER_EMAIL_KEY="eeb92dfd40d14a14be9595ef7d611216";
    if(isset($_POST['register_button']))
    {   
        $fname = strip_tags($_POST['reg_fname']); //Remove HTML tags for security reasons
        $fname = str_replace(' ','',$fname); //Remove spaces from user name
        $fname = ucfirst(strtolower($fname)); //Capitalize first letter, lower case the rest

        $lname = strip_tags($_POST['reg_lname']); 
        $lname = str_replace(' ','',$lname); 
        $lname = ucfirst(strtolower($lname)); 

        $username = strip_tags($_POST['reg_username']); 
        $username = str_replace(' ','',$username); 

        $email = strip_tags($_POST['reg_email']); 
        $email = str_replace(' ','',$email); 

        $pass = strip_tags($_POST['reg_pass']); 
        $con_pass = strip_tags($_POST['reg_con_pass']); 
        //Check if passwords match
        if(strcmp($pass,$con_pass) != 0)
        {
            echo "Error";
        }
        //Get date
        $date = "Y-m-d"; //Format of the date

        //Check if email is in correct format
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {   //Check if the email exists and is not disposable using the abstract api
            $ch= curl_init();
            curl_setopt_array($ch, [CURLOPT_URL=>"https://emailvalidation.abstractapi.com/v1/?api_key=$API_VER_EMAIL_KEY&email=$email",CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true]);
            $response= curl_exec($ch);
            $data = json_decode($response , true);
            if ($data['deliverability']==="DELIVERABLE")
            {   
                //check if email already exists in the database
                $email_check=mysqli_query($con,"SELECT user_email FROM users WHERE user_email='$email'");
                $username_check=mysqli_query($con,"SELECT user_username FROM users WHERE user_username='$username'");
                //Checking that name surname and password have the appropriate range 
                if(strlen($fname)>25 || strlen($fname)<2)
                {
                    echo "Invalid First Name length.";
                }
                if(strlen($lname)>25 || strlen($lname)<2)
                {
                    echo "Invalid Last Name length.";
                }
                if(strlen($pass)>25 || strlen($pass)<2)
                {
                    echo "Invalid Password length.";
                }
                //Checking that username doesn't exist
                if(mysqli_num_rows($username_check)==0)
                {   //Checking that email doesn't exist
                    if(mysqli_num_rows($email_check)==0)
                    {   
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                    }
                    else
                    {
                        echo "Email already exists";
                    }
                }
                else
                {
                    echo "Username already exists";
                }
                    
            }
            else
            {
                echo "Not deliverable";
            }
            
        }
        
    }
?>
