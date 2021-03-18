<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/05/2017
 * Time: 10:45 م
 */
class webinty_faqModel

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
     * add FAQ
     */

    public function addFAQ($FaqData)

    {
        if(webinty_system::Get('database')->Insert('FAQ',$FaqData))

            return true;

        return false;
    }





    /*
     * update FAQ
     */

    public function updateFAQ($id,$FaqData)

    {
        if(webinty_system::Get('database')->Update('FAQ',$FaqData,"WHERE `FAQ`.`faq_id` = $id"))

            return true;

        return false;
    }






   /*
   * delete FAQ
   */

    public function deleteFAQ($id)

    {
        if(webinty_system::Get('database')->Delete('FAQ',"WHERE `FAQ`.`faq_id` = $id"))

            return true;

        return false;
    }





   /*
   * get all FAQs
   */

    public function getAllFAQs($extra = '')

    {
        webinty_system::Get('database')->Execute("SELECT `FAQ`.*,`faq_categories`.`faq_category_name`,`users`.`name` FROM `FAQ` LEFT JOIN `faq_categories`ON `FAQ`.`faq_category` = `faq_categories`.`faq_category_id` LEFT JOIN `users` ON `FAQ`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }



    /*
   * get FAQ by ID
   */

    public function getFAQ($id)

    {
        $FAQS = $this->getAllFAQs("WHERE `FAQ`.`faq_id` = $id");

        if(count($FAQS)>0)

            return $FAQS[0];

        return [];
    }




   /*
    * get FAQs under category
    */

    public function getFAQsByCategory($categoryID)

    {
       return $this->getAllFAQs("WHERE `FAQ`.`faq_category` = $categoryID");
    }







    public function getNumberOfAllFaqs()
    {
        $NumberOfAllFaqs = webinty_system::Get('database')->Select_Count('faq');
        return $NumberOfAllFaqs;
    }






    /*
     *  get Numbers Of Faqs
     */


    public function getNumberOf_FAQS($faq_categoryID)

    {

        $FAQS = webinty_system::Get('database')->Select_Count('FAQ',"where `FAQ`.`faq_category` = $faq_categoryID");

        return $FAQS;

    }




}