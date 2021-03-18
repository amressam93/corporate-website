<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 24/07/2017
 * Time: 10:51 ص
 */
class webinty_adminOfferControllers extends webinty_adminController

{

    private $offerModel;

    public function __construct(webinty_offerModel $offer)

    {
        $this->offerModel = $offer;
    }






    /*
     * add offer
     */

    public function addOffer()

    {
        $this->checkPermission(4);
        if(isset($_POST['offerTitle']) && isset($_POST['offerPrice']) && isset($_POST['offerCategory']))

        {

            $validator = new validation();
            $rules = array(

                'offerTitle'    => 'required',
                'offerPrice'    => 'required',
                'offerCategory' => 'required'
            );

            // set validation Rules
            $validator->setRules($rules);

            // check Data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->offerModel->connect;
                $offerTitle = mysqli_real_escape_string($connection,$_POST['offerTitle']);
                $offerPrice = mysqli_real_escape_string($connection,$_POST['offerPrice']);
                $feature_1  = mysqli_real_escape_string($connection,$_POST['feature_1']);
                $feature_2  = mysqli_real_escape_string($connection,$_POST['feature_2']);
                $feature_3  = mysqli_real_escape_string($connection,$_POST['feature_3']);
                $feature_4  = mysqli_real_escape_string($connection,$_POST['feature_4']);
                $feature_5  = mysqli_real_escape_string($connection,$_POST['feature_5']);
                $feature_6  = mysqli_real_escape_string($connection,$_POST['feature_6']);
                $feature_7  = mysqli_real_escape_string($connection,$_POST['feature_7']);
                $feature_8  = mysqli_real_escape_string($connection,$_POST['feature_8']);
                $feature_9  = mysqli_real_escape_string($connection,$_POST['feature_9']);
                $feature_10  = mysqli_real_escape_string($connection,$_POST['feature_10']);
                $feature_11  = mysqli_real_escape_string($connection,$_POST['feature_11']);
                $feature_12  = mysqli_real_escape_string($connection,$_POST['feature_12']);
                $feature_13  = mysqli_real_escape_string($connection,$_POST['feature_13']);
                $feature_14  = mysqli_real_escape_string($connection,$_POST['feature_14']);
                $feature_15  = mysqli_real_escape_string($connection,$_POST['feature_15']);
                $offerCategory  = mysqli_real_escape_string($connection,$_POST['offerCategory']);
                $createdBy = $_SESSION['user']['user_id'];



                $offerData = array(

                    'offer_title'    => $offerTitle,
                    'price'          => $offerPrice,
                    'factor_1'       => $feature_1,
                    'factor_2'       => $feature_2,
                    'factor_3'       => $feature_3,
                    'factor_4'       => $feature_4,
                    'factor_5'       => $feature_5,
                    'factor_6'       => $feature_6,
                    'factor_7'       => $feature_7,
                    'factor_8'       => $feature_8,
                    'factor_9'       => $feature_9,
                    'factor_10'      => $feature_10,
                    'factor_11'      => $feature_11,
                    'factor_12'      => $feature_12,
                    'factor_13'      => $feature_13,
                    'factor_14'      => $feature_14,
                    'factor_15'      => $feature_15,
                    'offer_category' => $offerCategory,
                    'created_by'     => $createdBy,
                    'created_at'     => $date

                );


                // check is Exits
                $offerArray = $this->offerModel->getOffers();
                if ($this->checkIsExists($offerArray, 'offer_title', $offerTitle))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer is Already Exists</div>';
                    exit;
                }


                if($this->offerModel->addOffer($offerData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Inserted</div>';
                }

                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer Not Inserted</div>';
                }


            }

            else

            {
                $validationErrors = $validator->getErrors();
                include(WEBINTY_VIEWS . '/admin/resultMessages.html');
            }

        }

        else

        {
            $pageTitle = "Add New Offer";

            // get offer categories
            $offerCategoriesModel = new webinty_offerCategoriesModel();
            $offerCategories      = $offerCategoriesModel->getAllOfferCategories();

            //display Form
            include(WEBINTY_VIEWS . '/admin/header.html');
            include(WEBINTY_VIEWS . '/admin/menu.html');
            include(WEBINTY_VIEWS . '/admin/nav.html');
            include(WEBINTY_VIEWS . '/admin/addOffer.html');
            include(WEBINTY_VIEWS . '/admin/footer.html');
        }

    }





    /*
     * get all offers
     */

    public function getOffers()

    {
        $this->checkPermission(4);
        $pageTitle = "All Offers";

        //model
        $offers = $this->offerModel->getOffers();

        // view
        include(WEBINTY_VIEWS . '/admin/header.html');
        include(WEBINTY_VIEWS . '/admin/menu.html');
        include(WEBINTY_VIEWS . '/admin/nav.html');
        include(WEBINTY_VIEWS . '/admin/offers.html');

    }







    /*
     *  get offer By Id
     */


    public function getOffer()

    {
        $this->checkPermission(4);
        $connection = $this->offerModel->connect;
        $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
        $id = mysqli_real_escape_string($connection, $idFromUrl);

        $offer = $this->offerModel->getOffer($id);
        $pageTitle = $offer['offer_title'];


        // view
        include(WEBINTY_VIEWS . '/admin/header.html');
        include(WEBINTY_VIEWS . '/admin/menu.html');
        include(WEBINTY_VIEWS . '/admin/nav.html');
        if(count($offer)>0)
        {
            include(WEBINTY_VIEWS . '/admin/offer.html');
        }
        else
        {
            include(WEBINTY_VIEWS . '/admin/404Error.html');
        }
        include(WEBINTY_VIEWS . '/admin/footer.html');
    }







    /*
     * update Offer
     */

    public function updateOffer()

    {
        $this->checkPermission(4);

        if(isset($_POST['offerTitle']) && isset($_POST['offerPrice']) && isset($_POST['offerCategory']))

        {
            $validator = new validation();

            $rules = array(

                'offerTitle'    => 'required',
                'offerPrice'    => 'required',
                'offerCategory' => 'required'
            );

            // set validation Rules
            $validator->setRules($rules);

            if($validator->validate())

            {

                $connection = $this->offerModel->connect;
                $offerTitle = mysqli_real_escape_string($connection,$_POST['offerTitle']);
                $offerPrice = mysqli_real_escape_string($connection,$_POST['offerPrice']);
                $feature_1  = mysqli_real_escape_string($connection,$_POST['feature_1']);
                $feature_2  = mysqli_real_escape_string($connection,$_POST['feature_2']);
                $feature_3  = mysqli_real_escape_string($connection,$_POST['feature_3']);
                $feature_4  = mysqli_real_escape_string($connection,$_POST['feature_4']);
                $feature_5  = mysqli_real_escape_string($connection,$_POST['feature_5']);
                $feature_6  = mysqli_real_escape_string($connection,$_POST['feature_6']);
                $feature_7  = mysqli_real_escape_string($connection,$_POST['feature_7']);
                $feature_8  = mysqli_real_escape_string($connection,$_POST['feature_8']);
                $feature_9  = mysqli_real_escape_string($connection,$_POST['feature_9']);
                $feature_10  = mysqli_real_escape_string($connection,$_POST['feature_10']);
                $feature_11  = mysqli_real_escape_string($connection,$_POST['feature_11']);
                $feature_12  = mysqli_real_escape_string($connection,$_POST['feature_12']);
                $feature_13  = mysqli_real_escape_string($connection,$_POST['feature_13']);
                $feature_14  = mysqli_real_escape_string($connection,$_POST['feature_14']);
                $feature_15  = mysqli_real_escape_string($connection,$_POST['feature_15']);
                $offerCategory  = mysqli_real_escape_string($connection,$_POST['offerCategory']);

                // Offer id from Form
                $idFromForm = mysqli_real_escape_string($connection, $_POST['offerID']);

                // Offer Data From Form
                $offerInfo = $this->offerModel->getOffer($idFromForm);

                // admin id
                $adminId = $_SESSION['user']['user_id'];




                $offerData = array(

                    'offer_title'    => $offerTitle,
                    'price'          => $offerPrice,
                    'factor_1'       => $feature_1,
                    'factor_2'       => $feature_2,
                    'factor_3'       => $feature_3,
                    'factor_4'       => $feature_4,
                    'factor_5'       => $feature_5,
                    'factor_6'       => $feature_6,
                    'factor_7'       => $feature_7,
                    'factor_8'       => $feature_8,
                    'factor_9'       => $feature_9,
                    'factor_10'      => $feature_10,
                    'factor_11'      => $feature_11,
                    'factor_12'      => $feature_12,
                    'factor_13'      => $feature_13,
                    'factor_14'      => $feature_14,
                    'factor_15'      => $feature_15,
                    'offer_category' => $offerCategory
                );



                if(count($offerInfo)>0 AND $offerInfo['created_by'] == $adminId)

                {
                    // store data in dataBase

                    if($this->offerModel->updateOffer($idFromForm,$offerData))
                    {
                        echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Updated</div>';
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer Not Updated</div>';
                    }
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Offer</div>';
                }

            }

            else

            {
                $validationErrors = $validator->getErrors();
                include(WEBINTY_VIEWS . '/admin/resultMessages.html');
            }




        }

        else

        {
           $connection = $this->offerModel->connect;
           $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
           $id = mysqli_real_escape_string($connection, $idFromUrl);

           $offer = $this->offerModel->getOffer($id);

            // admin id By session
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle = $offer['offer_title'];

            // display Form
            include(WEBINTY_VIEWS . '/admin/header.html');
            include(WEBINTY_VIEWS . '/admin/menu.html');
            include(WEBINTY_VIEWS . '/admin/nav.html');

            if(count($offer)>0 AND $offer['created_by'] == $adminId)

            {
                $offerCategories = new webinty_offerCategoriesModel();
                $categories      = $offerCategories->getAllOfferCategories();
                include(WEBINTY_VIEWS . '/admin/updateOffer.html');
            }
            else
            {
                include(WEBINTY_VIEWS . '/admin/404Error.html');
            }

            include(WEBINTY_VIEWS . '/admin/footer.html');
        }


    }





    /*
     * Delete Offer
     */

    public function deleteOffer()

    {
        $this->checkPermission(4);
        $connection = $this->offerModel->connect;
        $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
        $id = mysqli_real_escape_string($connection, $idFromUrl);

        $offer = $this->offerModel->getOffer($id);

        $adminId = $_SESSION['user']['user_id'];

        if(count($offer)>0 AND $offer['created_by'] == $adminId)

        {
            if($this->offerModel->deleteOffer($id))
            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Deleted</div>';
            }
            else
            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Offer Not Deleted</div>';
            }
        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That Offer </div>';
        }

    }




}