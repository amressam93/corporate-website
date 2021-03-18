<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 22/07/2017
 * Time: 10:52 م
 */
class webinty_adminOfferCategoriesController extends webinty_adminController


{

    private $offerCategoies;

    public function __construct(webinty_offerCategoriesModel $offercategory)

    {
        $this->offerCategoies = $offercategory;
    }






    /*
     *  add offer category
     */

    public function addOfferCategory()

    {
        $this->checkPermission(4);

        if(isset($_POST['offerCategoryname']) && isset($_POST['offerCategoryDescription']) && isset($_POST['offerCategorySeoTitle']) && isset($_POST['offerCategorySeoDescription']) && isset($_POST['offerCategorySeoKeywords']))

        {
            $validator = new validation();

            $rules = array(

                'offerCategoryname'           => 'required',
                'offerCategoryDescription'    => 'required',
                'offerCategorySeoTitle'       => 'required',
                'offerCategorySeoDescription' => 'required',
                'offerCategorySeoKeywords'    => 'required'
            );

            // Set validation Rules

            $validator->setRules($rules);

            // check Data

            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->offerCategoies->connect;
                $offerCategoryName           = mysqli_real_escape_string($connection,$_POST['offerCategoryname']);
                $offerCategoryDescription    = mysqli_real_escape_string($connection,$_POST['offerCategoryDescription']);
                $offerCategorySeoTitle       = mysqli_real_escape_string($connection,$_POST['offerCategorySeoTitle']);
                $offerCategorySeoDescription = mysqli_real_escape_string($connection,$_POST['offerCategorySeoDescription']);
                $offerCategorySeoKeywords    = mysqli_real_escape_string($connection,$_POST['offerCategorySeoKeywords']);
                $createdBy                   = $_SESSION['user']['user_id'];


                // data array

                $offerCategoriesData = array(

                    'offer_category_name'            => $offerCategoryName,
                    'offer_category_description'     => $offerCategoryDescription,
                    'offer_category_seo_title'       => $offerCategorySeoTitle,
                    'offer_category_seo_description' => $offerCategorySeoDescription,
                    'offer_category_seo_keywords'    => $offerCategorySeoKeywords,
                    'created_by'                     => $createdBy,
                    'created_at'                     => $date

                );


                // Check Data is exits
                $offerCategoriesArray = $this->offerCategoies->getAllOfferCategories();

                if($this->checkIsExists($offerCategoriesArray,'offer_category_name',$offerCategoryName))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer Category is Already Exists</div>';
                    exit;
                }


                // store data in dataBase
                if($this->offerCategoies->addOfferCategory($offerCategoriesData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Category Inserted</div>';
                }

                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer Category Not Inserted</div>';
                }


            }

            else

            {
                $validationErrors = $validator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }


        }

        else

        {
            $pageTitle = "Add Offer Category";

            // view
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addOfferCategory.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }




    /*
     * get All Offer categories
     */

    public function getOfferCategories()

    {
        $this->checkPermission(4);

        // model data
        $offerCategories = $this->offerCategoies->getAllOfferCategories();

        $pageTitle = "All Offer Categories";

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/offerCategories.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');
    }





    /*
     * update offer category
     */

    public function updateOfferCategory()

    {
        $this->checkPermission(4);

        if(isset($_POST['offerCategoryname']) && isset($_POST['offerCategoryDescription']) && isset($_POST['offerCategorySeoTitle']) && isset($_POST['offerCategorySeoDescription']) && isset($_POST['offerCategorySeoKeywords']))

        {

            $validator = new validation();

            // set Validation Rules
            $rules = array(

                'offerCategoryname'           => 'required',
                'offerCategoryDescription'    => 'required',
                'offerCategorySeoTitle'       => 'required',
                'offerCategorySeoDescription' => 'required',
                'offerCategorySeoKeywords'    => 'required'
            );


            $validator->setRules($rules);

            if($validator->validate())

            {
                $connection                  = $this->offerCategoies->connect;
                $offerCategoryName           = mysqli_real_escape_string($connection,$_POST['offerCategoryname']);
                $offerCategoryDescription    = mysqli_real_escape_string($connection,$_POST['offerCategoryDescription']);
                $offerCategorySeoTitle       = mysqli_real_escape_string($connection,$_POST['offerCategorySeoTitle']);
                $offerCategorySeoDescription = mysqli_real_escape_string($connection,$_POST['offerCategorySeoDescription']);
                $offerCategorySeoKeywords    = mysqli_real_escape_string($connection,$_POST['offerCategorySeoKeywords']);

                // id From Form
                $idFromForm               = mysqli_real_escape_string($connection,$_POST['offerCategoryId']);

                $offerCategoryInfo        = $this->offerCategoies->getCategory($idFromForm);

                // admin id by SESSION
                $adminId                  = $_SESSION['user']['user_id'];

                // data array
                $offerCategoryData = array(

                    'offer_category_name'            => $offerCategoryName,
                    'offer_category_description'     => $offerCategoryDescription,
                    'offer_category_seo_title'       => $offerCategorySeoTitle,
                    'offer_category_seo_description' => $offerCategorySeoDescription,
                    'offer_category_seo_keywords'    => $offerCategorySeoKeywords
                );



                if(count($offerCategoryInfo)>0 AND $offerCategoryInfo['created_by'] == $adminId)

                {
                    if($this->offerCategoies->updateOfferCategory($idFromForm,$offerCategoryData))

                    {
                        echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Category Updated</div>';
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Offer Category Not Updated</div>';
                    }

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update That Offer Category</div>';
                }


            }

            else
            {
                $validationErrors = $validator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }


        }

        else

        {
            $connection = $this->offerCategoies->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);
            $adminId         = $_SESSION['user']['user_id'];

            // get offer category by id
            $offerCategory = $this->offerCategoies->getCategory($id);


            // page name
            $pageTitle  = $offerCategory['offer_category_name'];

            // view
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($offerCategory)>0 AND $offerCategory['created_by'] == $adminId)
            {
                include (WEBINTY_VIEWS.'/admin/updateOfferCategory.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }







    /*
     * Delete Offer Category
     */

    public function deleteOfferCategory()

    {
        $this->checkPermission(4);
        $connection = $this->offerCategoies->connect;
        $idFromUrl   = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id          = mysqli_real_escape_string($connection,$idFromUrl);


        // -1 get offer category By Id
        $offerCategory = $this->offerCategoies->getCategory($id);

        // -2 get SESSION Of User Id
        $adminId = $_SESSION['user']['user_id'];

        if(count($offerCategory)>0 AND $offerCategory['created_by'] == $adminId)

        {
            if($this->offerCategoies->deleteOfferCategory($id))

            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> Offer Category Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Offer Category Not Deleted</div>';
            }
        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This Offer Category </div>';
        }

    }









    /*
     * get offers By offer Category Id
     */

    public function getOffersByCategoryId()

    {
        $this->checkPermission(4);
        $connection    = $this->offerCategoies->connect;
        $idFromUrl     = (isset($_GET['id']))? (int)$_GET['id']:0;
        $categoryId    = mysqli_real_escape_string($connection,$idFromUrl);

        // category By Id
        $offerCategory = $this->offerCategoies->getCategory($categoryId);


        // offer Model
        $offerModel          = new webinty_offerModel();
        $offers              = $offerModel->getOffersByCategory($categoryId);


        $pageTitle = $offerCategory['offer_category_name'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($offerCategory)>0)

        {
            include (WEBINTY_VIEWS.'/admin/offersCategory.html');
        }

        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');



    }




}