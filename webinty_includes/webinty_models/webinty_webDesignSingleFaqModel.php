<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 03:10 م
 */
class webinty_webDesignSingleFaqModel extends webinty_model


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
     *  add web design single FAQ
     */

    public function addWebDesignFAQ($webDesignFAQ)

    {
        if(webinty_system::Get('database')->Insert('web_design_single_faq',$webDesignFAQ))

            return true;

        return false;

    }




    /*
     *  update web design single FAQ
     */



    public function updateWebDesignFAQ($id,$webDesignFAQ)

    {
        if(webinty_system::Get('database')->Update('web_design_single_faq',$webDesignFAQ,"WHERE `web_design_single_faq`.`web_design_faq_id` = $id"))

            return true;

        return false;
    }




    /*
     *  delete web design single FAQ
     */


    public function deleteWebDesignFAQ($id)

    {
        if(webinty_system::Get('database')->Delete('web_design_single_faq',"WHERE `web_design_single_faq`.`web_design_faq_id` = $id"))

            return true;

        return false;
    }





    /*
   *  get all web design faqs
   */


    public function getAllWebDesignFaqs($extra='')

    {
        webinty_system::Get('database')->Execute("SELECT `web_design_single_faq`.*,`users`.`name` FROM `web_design_single_faq` LEFT JOIN `users` ON `web_design_single_faq`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];

    }






    /*
     *  get web design FAQ by ID
     */



    public function getWebDesignFaqById($id)

    {
        $webDesignFaqs = $this->getAllWebDesignFaqs("WHERE `web_design_single_faq`.`web_design_faq_id` = $id");
        if(count($webDesignFaqs)>0)

            return $webDesignFaqs[0];

        return [];
    }



}