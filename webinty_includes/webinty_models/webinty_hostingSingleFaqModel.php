<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 04:53 م
 */
class webinty_hostingSingleFaqModel extends webinty_model


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
     * add hosting Single Faq
     */

    public function addHostingSingleFAQ($hostingSingleFaq)

    {
        if(webinty_system::Get('database')->Insert('hosting_single_faq',$hostingSingleFaq))

            return true;

        return false;
    }






    /*
     * update hosting Single Faq
     */


    public function updateHostingSingleFAQ($id,$hostingSingleFaq)

    {
        if(webinty_system::Get('database')->Update('hosting_single_faq',$hostingSingleFaq,"WHERE `hosting_single_faq`.`hosting_single_id` = $id"))

            return true;

        return false;
    }




    /*
     * delete hosting Single Faq
     */


    public function deleteHostingSingleFAQ($id)

    {
        if(webinty_system::Get('database')->Delete('hosting_single_faq',"WHERE `hosting_single_faq`.`hosting_single_id` = $id"))

            return true;

        return false;
    }





    /*
     * get all  hosting Single Faqs
     */


    public function getAllHostingFaqs($extra='')

    {
        webinty_system::Get('database')->Execute("SELECT `hosting_single_faq`.*,`users`.`name`FROM `hosting_single_faq` LEFT JOIN `users` ON `hosting_single_faq`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
     *  get hosting FAQ by id
     */

    public function getHostingFaq($id)

    {
        $hostingFaqs = $this->getAllHostingFaqs("WHERE `hosting_single_faq`.`hosting_single_id` = $id");

        if(count($hostingFaqs)>0)

            return $hostingFaqs[0];

        return [];
    }


}