<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/05/2017
 * Time: 10:21 م
 */

class webinty_faqCategoriesModel extends webinty_model

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
     * add FAQ category
     */


    public function addFaqCategory($faqCategoryData)

    {
        if(webinty_system::Get('database')->Insert('faq_categories',$faqCategoryData))

            return true;

        return false;
    }





    /*
     * update FAQ category
     */


    public function updateFaqCategory($id,$faqCategoryData)

    {
        if(webinty_system::Get('database')->Update('faq_categories',$faqCategoryData,"WHERE `faq_categories`.`faq_category_id` = $id"))

            return true;

        return false;
    }





    /*
    * delete FAQ category
    */


    public function deleteFaqCategory($id)

    {
        if(webinty_system::Get('database')->Delete('faq_categories',"WHERE `faq_categories`.`faq_category_id` = $id"))

            return true;

        return false;

    }




    /*
    * get All  FAQ categories
    */


    public function getAllFaqCategories($extra='')

    {
        webinty_system::Get('database')->Execute("SELECT * FROM `faq_categories` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }



  /*
  * get category by id
  */


    public function getCategory($categoryID)

    {
       $faqCategories = $this->getAllFaqCategories("WHERE `faq_categories`.`faq_category_id` = $categoryID");

       if(count($faqCategories)>0)

           return $faqCategories[0];

       return [];
    }



}