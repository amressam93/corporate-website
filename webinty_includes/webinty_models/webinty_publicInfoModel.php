<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/05/2017
 * Time: 07:25 م
 */
class webinty_publicInfoModel extends webinty_model



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
     * add public Info data
     */


    public function addPublicInfoData($publicInfoData)

    {

        if(webinty_system::Get('database')->Insert('puplic_info',$publicInfoData))

            return true;

        return false;


    }





    /*
     * update public Info data
     */


    public function updatePublicInfoData($id,$publicInfoData)

    {

        if(webinty_system::Get('database')->Update('puplic_info',$publicInfoData,"WHERE `puplic_info`.`info_id` = $id"))

            return true;

        return false;


    }





    /*
     * delete Info data by id
     */

    public function deletePublicInfoData($id)

    {

        if(webinty_system::Get('database')->Delete('puplic_info',"WHERE `puplic_info`.`info_id` = $id"))

            return true;

        return false;


    }




    /*
     * get All public informatios data
     */

    public function getAllInformatiosData($extra = '')

    {

        webinty_system::Get('database')->Execute("SELECT `puplic_info`.*,`users`.* FROM `puplic_info` LEFT JOIN `users` ON `puplic_info`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
     *  get Info By ID
     */

    public function getPublicInfoById($infoID)

    {

        $informations = $this->getAllInformatiosData("WHERE `puplic_info`.`info_id` = $infoID");

        if(count($informations)>0)

            return $informations[0];

        return [];
    }


}