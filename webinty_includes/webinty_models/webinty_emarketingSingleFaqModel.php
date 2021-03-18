<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 05:31 م
 */


class webinty_emarketingSingleFaqModel extends webinty_model


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
     * add Emarketing single Faq
     */


    public function addEmarketingFaq($emarketingFaq)

    {
        if(webinty_system::Get('database')->Insert('emarketing_single_faq',$emarketingFaq))

            return true;

        return false;
    }





    /*
     * update Emarketing single Faq
     */


    public function updateEmarketingFaq($id,$emarketingFaq)

    {
        if(webinty_system::Get('database')->Update('emarketing_single_faq',$emarketingFaq,"WHERE `emarketing_single_faq`.`emarketing_single_id` = $id"))

            return true;

        return false;

    }




    /*
     * delete Emarketing single Faq
     */


    public function deleteEmarketingFaq($id)

    {
        if(webinty_system::Get('database')->Delete('emarketing_single_faq',"WHERE `emarketing_single_faq`.`emarketing_single_id` = $id"))

            return true;

        return false;
    }







    /*
    * get All Emarketing single Faqs
    */


    public function getAllEmarketingFaqs($extra='')

    {
        webinty_system::Get('database')->Execute("SELECT `emarketing_single_faq`.*,`users`.`name` FROM `emarketing_single_faq` LEFT JOIN `users` ON `emarketing_single_faq`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
     *  get Emarketing single FAQ
     */



    public function getEmarketingFaqById($id)

    {

        $EmarketingFaqs = $this->getAllEmarketingFaqs("WHERE `emarketing_single_faq`.`emarketing_single_id` = $id");

        if(count($EmarketingFaqs)>0)

            return $EmarketingFaqs[0];

        return [];
    }




}