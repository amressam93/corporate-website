<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 11:43 ص
 */


class webinty_offerModel extends webinty_model


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
     *  add offer
     */


    public function addOffer($offerData)

    {
        if(webinty_system::Get('database')->Insert('offer',$offerData))

            return true;

        return false;
    }





    /*
     *  update offer
     */


    public function updateOffer($id,$offerData)

    {
        if(webinty_system::Get('database')->Update('offer',$offerData,"WHERE `offer`.`offer_id` = $id"))

            return true;

        return false;

    }




    /*
     *  delete offer
     */


    public function deleteOffer($id)

    {
        if(webinty_system::Get('database')->Delete('offer',"WHERE `offer`.`offer_id` = $id"))

            return true;

        return false;
    }





    /*
    *  get all Offers
    */


    public function getOffers($extra = '')

    {
        webinty_system::Get('database')->Execute("SELECT `offer`.*,`offer_categories`.`offer_category_name`,`users`.`name` FROM `offer` LEFT JOIN `offer_categories` ON `offer`.`offer_category` = `offer_categories`.`offer_category_id` LEFT JOIN `users` ON `offer`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




    /*
     *  get all Offers
     */


    public function getOffer($id)

    {
        $offers = $this->getOffers("WHERE `offer`.`offer_id` = $id");

        if (count($offers)>0)

            return $offers[0];

        return [];
    }





    /*
    *  get offers under Category
    */


    public function getOffersByCategory($offerCategoryID,$extra='')

    {

        return $this->getOffers("WHERE `offer`.`offer_category` = $offerCategoryID $extra");

    }





    /*
    *  get offers By user
    */


    public function getOffersByUser($userID,$extra='')

    {

        return $this->getOffers("WHERE `offer`.`created_by` = $userID $extra");

    }




    /*
    *  get Number Of offers
    */


    public function getNumberOfOffers($offerCategoryID)

    {

        $offersNumber = webinty_system::Get('database')->Select_Count('offer',"where `offer`.`offer_category` = $offerCategoryID");

        return $offersNumber;

    }





}