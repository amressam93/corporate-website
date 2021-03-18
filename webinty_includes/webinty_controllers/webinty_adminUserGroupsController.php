<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/05/2017
 * Time: 05:41 م
 */
class webinty_adminUserGroupsController extends webinty_adminController

{

    private $userGroupsModel;




    public function __construct(webinty_usersGroupsModel $ugModel)

    {
        $this->checkPermission(4);
        $this->userGroupsModel = $ugModel;
    }


    /*
     *  add new user group
     */

    public function addUserGroup()

    {
        $this->checkPermission(4);

        if(isset($_POST['groupName']) && isset($_POST['permission']))

        {
            // add user group to db

            $connection = $this->userGroupsModel->connect;

            $userGroupName       = mysqli_real_escape_string($connection,$_POST['groupName']);
            $userGroupPermission = mysqli_real_escape_string($connection,$_POST['permission']);
            $createdBy           = $_SESSION['user']['user_id'];

            $userGroupData = array(
                "group_name" => $userGroupName,
                "permissions" => $userGroupPermission,
                "created_by" => $createdBy
            );


            $usersGroupArray = $this->userGroupsModel->getUserGroups();


            if($this->checkIsExists($usersGroupArray,'group_name',$userGroupName))

            {
                echo '<div class="alert alert-danger"> <strong> Error! </strong> User Group is Already Exists</div>';
                exit;
            }


            if($this->userGroupsModel->addUserGroup($userGroupData))

            {

                echo '<div class="alert alert-success"> <strong> Success! </strong> User Group Inserted</div>';
            }

            else

            {

                echo '<div class="alert alert-danger"> <strong> Error! </strong> User Group Not Inserted</div>';
            }

        }

        else

        {
            $pageTitle = "Add User Group";

            // show add user group page
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addUserGroup.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');

        }



    }





    /*
     * get All user groups
     */

    public function getUserGroups()

    {

        $this->checkPermission(4);

        $pageTitle = "All User Groups";

        // get data from db
        $model      = $this->userGroupsModel;
        $userGroups = $model->getUserGroups();

        // show data with views
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/usersGroups.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');

    }




    /*
     * delete user Groups
     */


    public function deleteUserGroups()

    {
        $this->checkPermission(4);

        $connection = $this->userGroupsModel->connect;

        $idFromUrl = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id        = mysqli_real_escape_string($connection,$idFromUrl);

        // -1 get group
        $group   = $this->userGroupsModel->getUserGroup($id);

        // -2 get SESSION Of User Id
        $adminId = $_SESSION['user']['user_id'];

        if(count($group)>0 && $group['created_by'] == $adminId)

        {

            if($this->userGroupsModel->deleteUserGroup($id))

            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> User Group Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> User Group Not Deleted</div>';
            }



        }

        else

        {

            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This User Group </div>';
        }

    }




    /*
     *  update user groups
     */


    public function updateUserGroups()

    {

        $this->checkPermission(4);

        if(isset($_POST['groupName']) && isset($_POST['permission']))

        {

            // get data from Form

            $connection = $this->userGroupsModel->connect;

            $groupName   = mysqli_real_escape_string($connection,$_POST['groupName']);
            $permissions = mysqli_real_escape_string($connection,$_POST['permission']);
            $idFromForm  = mysqli_real_escape_string($connection,$_POST['userGroupId']);


            // let model update data

            $userGroupData = array(

                "group_name" => $groupName,
                "permissions" => $permissions

            );

            $userGroupArray = $this->userGroupsModel->getUserGroups();

            if($this->checkIsExists($userGroupArray,'group_name',$groupName))

            {
                echo '<div class="alert alert-danger"> <strong> Error! </strong> User Group is Already Exists</div>';
                exit;
            }


           if($this->userGroupsModel->updateUserGroup($idFromForm,$userGroupData))

           {
               echo '<div class="alert alert-success"> <strong> Success! </strong> User Group Updates</div>';
           }

           else

           {
               echo '<div class="alert alert-danger"> <strong> Error! </strong> User Group Not Updated</div>';
           }



        }

        else

        {

            $pageTitle  = "update User Group";

           // (isset($_GET['id']))? (int)$_GET['id']:0;

            $connection = $this->userGroupsModel->connect;

            $idFromUrl = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id        = mysqli_real_escape_string($connection,$idFromUrl);

            $userGroup = $this->userGroupsModel->getUserGroup($id);


            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            if(count($userGroup)>0)

            {
                include (WEBINTY_VIEWS.'/admin/updateUserGroup.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }

}