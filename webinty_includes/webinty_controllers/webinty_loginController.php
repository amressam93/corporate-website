<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/05/2017
 * Time: 07:43 م
 */
class webinty_loginController extends webinty_controller

{

    /*
     * user login
     */

    public function userLogin()

    {


        // check if user have a session => redirect to his admin panal And NOT Redriect to login page


        if(isset($_SESSION['user']) && $_SESSION['user']['user_group'] == 4)

        {
            $redirectUrl = WEBINTY_PATH.'admin_dashboard/';

            header("location:$redirectUrl");
        }

        if(isset($_SESSION['user']) && $_SESSION['user']['user_group'] == 5)

        {
            $redirectUrl = WEBINTY_PATH.'admin_dashboard/Error404.php';

            header("location:$redirectUrl");
        }



        if(isset($_POST['email']) && isset($_POST['password']))

        {

            // date and time Format
            $hash = 'webinty201701287258368';

            // new object from users model
            $userModel = new webinty_usersModel();


            // connection object from users model
            $connectObject = $userModel->connect;

            $email         = mysqli_real_escape_string($connectObject,$_POST['email']);

            $password      = mysqli_real_escape_string($connectObject,$_POST['password']);

            //$newPassword   = md5($hash.$password);


            // db

            $user = $userModel->login($email);

            if (count($user) > 0)

            {
                // store data in session

               // $_SESSION['user'] = $user;

                $salt = $user['salt'];

                $hashPassword = md5($hash.$password.$salt);

                if ($hashPassword == $user['password'])

                {
                  //  header("location:../admin_dashboard/");

                    $_SESSION['user'] = $user;
                    echo "login";
                }

                else

                {
                    echo "<div class='alert alert-danger'> <strong>Error ! </strong> The Password you entered for Email  <strong>$email</strong> is incorrect </div>";
                }


            }

            else

            {
                echo '<div class="alert alert-danger"> <strong>Error ! </strong> invaild login data </div>';
            }

        }


        else
        {
            // view login page

            $pageTitle = "Webinty | login";
            include (WEBINTY_VIEWS.'/webinty_front/login.html');
        }


    }

}