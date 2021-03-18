<?php


class webinty_usersModel extends webinty_model

{

    public $connect;

    /*
     * connection to db
     */


    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }


    /*
     * Add user
     */

    public function addUser($userData)

    {
        if(webinty_system::Get('database')->Insert('users',$userData))

            return true;

        return false;
    }



    /*
     * Update user info
     */

    public function updateUserInfo($id,$userData)

    {

        if(webinty_system::Get('database')->Update('users',$userData,"WHERE `users`.`user_id` = $id"))

            return true;

        return false;

    }



    /*
     * delete user
     */

    public function deleteUser($id)

    {

        if(webinty_system::Get('database')->Delete('users',"WHERE `users`.`user_id` = $id"))

            return true;

        return false;
    }


    /*
     * get All users
     */

    public function getUsers($extra='')

    {

        webinty_system::Get('database')->Execute("SELECT `users`.* ,`users_groups`.`group_name`,`users_groups`.`permissions` FROM `users` LEFT JOIN `users_groups` ON `users`.`user_group`=`users_groups`.`group_id` $extra ");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];

    }





    /*
     * get user By ID
     */

    public function getUser($id)

    {
       $users =  $this->getUsers("WHERE `users`.`user_id` = $id");

       if(count($users)>0)

       return $users[0];

       return [];

    }



    /*
     * get users By Group
     */

    public function getUsersByGroup($groupID)

    {
        return $this->getUsers("WHERE `users`.`user_group` = $groupID");
    }


    /*
     * search Users
     */

    public function searchUsers($keyword)

    {
        return $this->getUsers("WHERE `users`.`name` LIKE '%$keyword%' OR `users`.`username` LIKE '%$keyword%' OR `users`.`email` LIKE '%$keyword%' ");
    }




    /*
     * user login
     */

    public function login($email)

    {
        $users = $this->getUsers("WHERE `users`.`email` = '$email' LIMIT 1");

        if(count($users)>0)

          return $users[0];

        return [];

    }



}