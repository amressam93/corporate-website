<?php


class webinty_usersGroupsModel extends webinty_model

{



    public $connect;



    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }



    /*
     * Add New User Group
     */

    public function addUserGroup($userGroupData)

    {

        if(webinty_system::Get('database')->Insert('users_groups',$userGroupData))

            return true;

        return false;


    }




    /*
    * Update User Group
    */

    public function updateUserGroup($id,$userGroupData)

    {
        if(webinty_system::Get('database')->Update('users_groups',$userGroupData,"WHERE `group_id` = $id"))

            return true;

        return false;

    }




    /*
     * Delete User Group
     */

    public function deleteUserGroup($id)

    {

        if(webinty_system::Get('database')->Delete('users_groups',"WHERE `group_id` = $id"))

            return true;

        return false;

    }




    /*
     * get All UserGroup
     */

    public function getUserGroups($extra='')

    {


        webinty_system::Get('database')->Execute("SELECT * FROM `users_groups` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
     * get userGroup By ID
     */

    public function getUserGroup($id)

    {
        $result = $this->getUserGroups("WHERE `users_groups`.`group_id` = $id");

        if(count($result)>0)

        return $result[0];

        return [];

    }






    /*
     * check if group name already exists
     */

    public function checkGroupNameIsExists($groupName)

    {
        $groupNames = $this->getUserGroups("WHERE `users_groups`.`group_name` = $groupName");

        if(count($groupName)>0)

            echo 'false';

        echo 'true';
    }




}