<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 11:17 ص
 */
class webinty_offerCategoriesModel extends webinty_model

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
     * add offer category
     */

    public function addOfferCategory($offerCategoryData)

    {

        if(webinty_system::Get('database')->Insert('offer_categories',$offerCategoryData))

            return true;

        return false;

    }




    /*
     * update offer category
     */

    public function updateOfferCategory($id,$offerCategoryData)

    {

        if(webinty_system::Get('database')->Update('offer_categories',$offerCategoryData,"WHERE `offer_categories`.`offer_category_id` = $id"))

            return true;

        return false;
    }




    /*
     * delete offer category
     */

    public function deleteOfferCategory($id)

    {

        if(webinty_system::Get('database')->Delete('offer_categories',"WHERE `offer_categories`.`offer_category_id` = $id"))

            return true;

        return false;
    }





    /*
    * get all offer categories
    */

    public function getAllOfferCategories($extra ='')

    {
        webinty_system::Get('database')->Execute("SELECT `offer_categories`.*,`users`.`user_id`,`users`.`name` FROM `offer_categories` LEFT JOIN `users` ON `offer_categories`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
    * get category By ID
    */

    public function getCategory($id)

    {

        $categories = $this->getAllOfferCategories("WHERE `offer_categories`.`offer_category_id` = $id");

        if(count($categories)>0)

            return $categories[0];

        return [];

    }


}