<?php

class webinty_adminUsersController extends webinty_adminController

{

    private $usersModel;


    public function __construct(webinty_usersModel $userModel)

    {
        $this->usersModel = $userModel;
    }



    /*
     * get all users
     */

    public function getUsers()

    {
        $this->checkPermission(4);

        $pageTitle = "All Users";

        // model

        $users = $this->usersModel->getUsers();

        // view

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/users.html');
    }




    /*
     * user profile
     */

    public function userProfile()

    {
        $this->checkPermission(4);

        $connection = $this->usersModel->connect;

        $pageTitle = "User Profile";

        $idFromUrl = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id        = mysqli_real_escape_string($connection,$idFromUrl);

        $user = $this->usersModel->getUser($id);

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($user)>0)
        {
            include (WEBINTY_VIEWS.'/admin/profile.html');
        }
        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');



    }




    /*
     * add user
     */

    public function addUser()

    {

        $this->checkPermission(4);

        if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['aboutuser']))

        {
            $vaildator = new validation();

            $rules = array(

                'name'       => 'required|min:3|max:50',
                'username'   => 'required|min:3|max:50',
                'password'   => 'required|min:6',
                'email'      => 'required|email',
                'aboutuser'  => 'required|min:10',
                'user_group' => 'required'
            );

            // Set validation Rules
            $vaildator->setRules($rules);

            // check data
            if($vaildator->validate())

            {

                // date and time Format
                $hash = 'webinty201701287258368';

                $connection       = $this->usersModel->connect;
                $name             = mysqli_real_escape_string($connection,$_POST['name']);
                $username         = mysqli_real_escape_string($connection,$_POST['username']);
                $password         = mysqli_real_escape_string($connection,$_POST['password']);
                $salt             = rand(100000,1000000);
                $saltedPassword   = md5($hash.$password.$salt);
                $email            = mysqli_real_escape_string($connection,$_POST['email']);
                $aboutuser        = mysqli_real_escape_string($connection,$_POST['aboutuser']);
                $facebook         = mysqli_real_escape_string($connection,$_POST['facebook']);
                $twitter          = mysqli_real_escape_string($connection,$_POST['twitter']);
                $linkedin         = mysqli_real_escape_string($connection,$_POST['linkedin']);
                $googleplus       = mysqli_real_escape_string($connection,$_POST['googleplus']);
                $user_group       = mysqli_real_escape_string($connection,$_POST['user_group']);

                // image

                $imageDirectory   = '../webinty_includes/webinty_uploads/users';
                $image            = $this->uploadSingleImage('userImage',$imageDirectory, array('image/png','image/jpg','image/jpeg'));


                //data
                $userData = array(

                    'name'       => $name,
                    'username'   => $username,
                    'password'   => $saltedPassword,
                    'salt'       => $salt,
                    'email'      => $email,
                    'user_group' => $user_group,
                    'image'      => $image,
                    'about_user' => $aboutuser,
                    'facebook'   => $facebook,
                    'twitter'    => $twitter,
                    'linkedin'   => $linkedin,
                    'googleplus' => $googleplus
                );


                // store Data in Database

                $usersArray = $this->usersModel->getUsers();

                if($this->checkIsExists($usersArray,'email',$email))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Email Address is Already Exists</div>';
                    exit;
                }


                if($this->usersModel->addUser($userData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> User Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> User Not Inserted</div>';
                }



            }


            else

            {
                $validationErrors = $vaildator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }

        }

        else

        {

            $pageTitle = "Add User";
            // get user group

            $usersGroups = new webinty_usersGroupsModel();
            $userGroups  = $usersGroups->getUserGroups();

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addUser.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');

        }


    }


    /**
     * update user.
     */
    public function updateUser()

    {

        $this->checkPermission(4);

        if(isset($_POST['name']) && isset($_POST['username'])&& isset($_POST['aboutuser']))

        {
            $vaildator = new validation();

            $rules = array(

                'name'       => 'required|min:3|max:50',
                'username'   => 'required|min:3|max:50',
                'aboutuser'  => 'required|min:10',
                'user_group' => 'required'
            );

            // Set validation Rules
            $vaildator->setRules($rules);

            // check data
            if($vaildator->validate())

            {

                // date and time Format
                $hash = 'webinty201701287258368';

                $connection       = $this->usersModel->connect;

                // id From Form
                $idFromForm       = mysqli_real_escape_string($connection,$_POST['userID']);

                // user Info By id
                $userInfo         = $this->usersModel->getUser($idFromForm);

                $userSalt         = $userInfo['salt'];
                $name             = mysqli_real_escape_string($connection,$_POST['name']);
                $username         = mysqli_real_escape_string($connection,$_POST['username']);
                $password         = mysqli_real_escape_string($connection,$_POST['password']);
                $salt             = rand(100000,1000000);
                $saltedPassword   = md5($hash.$password.$userSalt);
                //$email            = mysqli_real_escape_string($connection,$_POST['email']);
                //$email            = isset($_POST['email']) ? $_POST['email'] : '';
                $aboutuser        = mysqli_real_escape_string($connection,$_POST['aboutuser']);
                $facebook         = mysqli_real_escape_string($connection,$_POST['facebook']);
                $twitter          = mysqli_real_escape_string($connection,$_POST['twitter']);
                $linkedin         = mysqli_real_escape_string($connection,$_POST['linkedin']);
                $googleplus       = mysqli_real_escape_string($connection,$_POST['googleplus']);
                $user_group       = mysqli_real_escape_string($connection,$_POST['user_group']);


                // old image
                $oldImage         = $userInfo['image'];

                // image
                $imageDirectory   = '../webinty_includes/webinty_uploads/users';
                $image            = $this->uploadSingleImage('userImage',$imageDirectory, array('image/png','image/jpg','image/jpeg'));

                //data
                $userData = array(

                    'name'       => $name,
                    'username'   => $username,
                    'user_group' => $user_group,
                    'about_user' => $aboutuser,
                    'facebook'   => $facebook,
                    'twitter'    => $twitter,
                    'linkedin'   => $linkedin,
                    'googleplus' => $googleplus
                );


                // update password

                if(strlen($password)>0)

                {
                    $userData['password'] = $saltedPassword;
                }


                // update image
                if($image)

                {
                    $userData['image'] = $image;
                }




                   // store Data in Database

                    if(count($userInfo)>0)

                    {

                        if($this->usersModel->updateUserInfo($idFromForm,$userData))

                        {
                            if($image)

                            {
                                unlink('../webinty_includes/webinty_uploads/users/'.$oldImage);
                            }

                            echo '<div class="alert alert-success"> <strong> Success! </strong> User Updated</div>';
                        }

                        else

                        {
                            echo '<div class="alert alert-danger"> <strong> Error! </strong> User Not Updated</div>';
                        }


                    }


                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update That User</div>';
                    }





            }


            else

            {
                $validationErrors = $vaildator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }

        }

        else

        {

            $pageTitle = "Update User";


            $connection = $this->usersModel->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get user data by id
            $user       = $this->usersModel->getUser($id);



            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');



            if(count($user)>0)
            {
                // get user group
                $usersGroups = new webinty_usersGroupsModel();
                $userGroups  = $usersGroups->getUserGroups();

                include (WEBINTY_VIEWS.'/admin/updateUser.html');
            }

            else

            {

             include (WEBINTY_VIEWS.'/admin/404Error.html');

            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }




    }




    /*
     * Delete User
     */

    public function deleteUser()

    {
        $this->checkPermission(4);

        $connection = $this->usersModel->connect;

        $idFromUrl = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id        = mysqli_real_escape_string($connection,$idFromUrl);

        $user      = $this->usersModel->getUser($id);

        if(count($user)>0 && $_SESSION['user']['user_group'] == 4)

        {
            if($this->usersModel->deleteUser($id))

            {
                $userImage = $user['image'];

                if($userImage)

                {
                    unlink('../webinty_includes/webinty_uploads/users/'.$userImage);
                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> User Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> User Not Deleted</div>';
            }

        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That User </div>';
        }


    }





}