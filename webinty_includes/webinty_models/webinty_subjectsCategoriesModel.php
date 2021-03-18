<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 07/05/2017
 * Time: 09:46 م
 */
class webinty_subjectsCategoriesModel extends webinty_model

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
     * add  new subject category
     */

    public function addCategory($categoryData)

    {

        if(webinty_system::Get('database')->Insert('subjects_categories',$categoryData))

            return true;

        return false;


    }



    /*
     * update subject category
     */


    public function updateCategory($id,$categoryData)

    {
        if(webinty_system::Get('database')->Update('subjects_categories',$categoryData,"WHERE `subjects_categories`.`category_id` = $id"))

            return true;

        return false;
    }




    /*
    * Delete subject category
    */


    public function deleteCategory($id)

    {
        if(webinty_system::Get('database')->Delete('subjects_categories',"WHERE `subjects_categories`.`category_id` = $id"))

            return true;

        return false;

    }

    /*
     *  get all subjects categories
     */

    public function getAllCategories($extra = '')

    {
        webinty_system::Get('database')->Execute("SELECT * FROM `subjects_categories` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];

    }



    /*
     * get subject Category By ID
     */

    public function getCategory($id)

    {
        $categories =  $this->getAllCategories("WHERE `subjects_categories`.`category_id` = $id");

        if(count($categories)>0)

            return $categories[0];

        return [];
    }









}