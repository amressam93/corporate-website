<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/07/2017
 * Time: 08:55 م
 */
class webinty_adminFaqCategoriesController extends webinty_adminController

{
    private $faqCategories;

    public function __construct(webinty_faqCategoriesModel $faqCategory)

    {
        $this->faqCategories = $faqCategory;
    }



    /*
     * add FAQ category
     */


    public function addFaqCategory()

    {
        $this->checkPermission(4);

        if(isset($_POST['faqCategoryname']))


        {

            $validator = new validation();

            $rules     = array(

                'faqCategoryname' => 'required'
            );

            // Set validation Rules
            $validator->setRules($rules);


            // check data

            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->faqCategories->connect;

                $faqCategoryName = mysqli_real_escape_string($connection,$_POST['faqCategoryname']);
                $createdBy         = $_SESSION['user']['user_id'];

                // data array
                $faqCategoriesData = array(

                    'faq_category_name' => $faqCategoryName,
                    'created_by'        => $createdBy,
                    'created_at'        => $date
                );



                // store data in dataBase
                $faqCategoriesArray = $this->faqCategories->getAllFaqCategories();

                if($this->checkIsExists($faqCategoriesArray,'faq_category_name',$faqCategoryName))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Category is Already Exists</div>';
                    exit;
                }

                if($this->faqCategories->addFaqCategory($faqCategoriesData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Faq Category Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Category Not Inserted</div>';
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
            $pageTitle = "Add FAQ Category";

            // view
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addFaqCategory.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }




    }










    /*
     *  get all Faq Categories
     */

    public function getFaqCategories()

    {
        $this->checkPermission(4);

        // model Data
        $FaqCategories = $this->faqCategories->getAllFaqCategories();


        $pageTitle = "All FAQ Categories";

        // view

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/faqsCategories.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');

    }









    /*
     * update Faq Category
     */

    public function updateFaqCategory()

    {

        $this->checkPermission(4);


        if(isset($_POST['faqCategoryname']))


        {

            $validator = new validation();

            $rules     = array(

                'faqCategoryname' => 'required'
            );

            // Set validation Rules
            $validator->setRules($rules);


            // check data

            if($validator->validate())

            {

                $connection = $this->faqCategories->connect;

                $faqCategoryName   = mysqli_real_escape_string($connection,$_POST['faqCategoryname']);

                // id From Form
                $idFromForm        = mysqli_real_escape_string($connection,$_POST['faq_Category']);

                $faqCategoryInfo   = $this->faqCategories->getCategory($idFromForm);

                $adminId         = $_SESSION['user']['user_id'];

                // data array
                $faqCategoriesData = array(

                    'faq_category_name' => $faqCategoryName,
                );



                // store data in dataBase
                $faqCategoriesArray = $this->faqCategories->getAllFaqCategories();

                if($this->checkIsExists($faqCategoriesArray,'faq_category_name',$faqCategoryName))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Category is Already Exists</div>';
                    exit;
                }

               if(count($faqCategoryInfo)>0 AND $faqCategoryInfo['created_by'] == $adminId)

               {
                   if($this->faqCategories->updateFaqCategory($idFromForm,$faqCategoriesData))

                   {
                       echo '<div class="alert alert-success"> <strong> Success! </strong> FAQ Category Updated</div>';
                   }

                   else

                   {
                       echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Category Not Updated</div>';
                   }

               }

               else
               {
                   echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update That FAQ Category</div>';
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
            $connection = $this->faqCategories->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);
            $adminId         = $_SESSION['user']['user_id'];



            // get FAQ category by id
            $faqCatgory = $this->faqCategories->getCategory($id);

            // page name
            $pageTitle  = $faqCatgory['faq_category_name'];

            // view
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($faqCatgory)>0 AND $faqCatgory['created_by']== $adminId)
            {
                include (WEBINTY_VIEWS.'/admin/updateFaqCategory.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }



    }










    /*
     *  delete Faq Category
     */

    public function deleteFaqCategory()

    {
        $this->checkPermission(4);
        $connection  = $this->faqCategories->connect;
        $idFromUrl   = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id          = mysqli_real_escape_string($connection,$idFromUrl);

        // -1 get category By Id
        $faqCategory = $this->faqCategories->getCategory($id);

        // -2 get SESSION Of User Id
        $adminId = $_SESSION['user']['user_id'];


        if(count($faqCategory)>0 AND $faqCategory['created_by'] == $adminId)

        {
            if($this->faqCategories->deleteFaqCategory($id))

            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> FAQ Category Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> FAQ Category Not Deleted</div>';
            }

        }

        else
        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This FAQ Category </div>';
        }



    }







}