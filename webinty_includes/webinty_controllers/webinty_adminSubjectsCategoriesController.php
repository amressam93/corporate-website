<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/06/2017
 * Time: 04:45 م
 */
class webinty_adminSubjectsCategoriesController extends webinty_adminController

{

    private $categoriesModel;



    public function __construct(webinty_subjectsCategoriesModel $category)

    {
        $this->categoriesModel = $category;
    }



    /*
     * add subject category
     */

    public function addSubjectCategory()

    {

        $this->checkPermission(4);

        if(isset($_POST['categoryname']) && isset($_POST['categorydescription']) && isset($_POST['subjectcategoryseotitle']) && isset($_POST['subjectcategoryseodescription']) && isset($_POST['subjectcategoryseokeywords']))

        {
            $validator = new validation();

            $rules     = array(

                'categoryname'                  => 'required',
                'categorydescription'           => 'required|min:50',
                'subjectcategoryseotitle'       => 'required',
                'subjectcategoryseodescription' => 'required',
                'subjectcategoryseokeywords'    => 'required'
            );


            // Set validation Rules
            $validator->setRules($rules);



            // check Data

            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection   = $this->categoriesModel->connect;

                $categoryName              = mysqli_real_escape_string($connection,$_POST['categoryname']);
                $categoryDescription       = mysqli_real_escape_string($connection,$_POST['categorydescription']);
                $categorySeoTitle          = mysqli_real_escape_string($connection,$_POST['subjectcategoryseotitle']);
                $categorySeoDescription    = mysqli_real_escape_string($connection,$_POST['subjectcategoryseodescription']);
                $categorySeoKeywords       = mysqli_real_escape_string($connection,$_POST['subjectcategoryseokeywords']);
                $createdBy                 = $_SESSION['user']['user_id'];


                // data
                $subjectCategoryData = array(

                    'category_name'        => $categoryName,
                    'category_description' => $categoryDescription,
                    'seo_title'            => $categorySeoTitle,
                    'seo_description'      => $categorySeoDescription,
                    'seo_keywords'         => $categorySeoKeywords,
                    'created_by'           => $createdBy,
                    'created_at'           => $date
                );


                // store data in data base
                $categoryArray = $this->categoriesModel->getAllCategories();

                if($this->checkIsExists($categoryArray,'category_name',$categoryName))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Subject Category is Already Exists</div>';
                    exit;
                }


                if($this->categoriesModel->addCategory($subjectCategoryData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Category Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Category Not Inserted</div>';
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
            $pageTitle = "Add Subject Category";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addSubjectCategory.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }







    /*
     * get all Subjects Categories
     */

    public function getSubjectsCategories()

    {
        $this->checkPermission(4);

        $pageTitle = "All Subjects Categories";

        // model
        $categories = $this->categoriesModel->getAllCategories();

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/subjectsCategories.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');

    }






    /*
     *  update subject Category
     */

    public function updateSubjectCategory()

    {
        $this->checkPermission(4);

        if(isset($_POST['categoryname']) && isset($_POST['categorydescription']) && isset($_POST['subjectcategoryseotitle']) && isset($_POST['subjectcategoryseodescription']) && isset($_POST['subjectcategoryseokeywords']))

        {
            $validator = new validation();

            $rules     = array(

                'categoryname'                  => 'required',
                'categorydescription'           => 'required|min:50',
                'subjectcategoryseotitle'       => 'required',
                'subjectcategoryseodescription' => 'required',
                'subjectcategoryseokeywords'    => 'required'
            );


            // Set validation Rules
            $validator->setRules($rules);

            // check Data

            if($validator->validate())

            {

                $connection   = $this->categoriesModel->connect;

                $categoryName              = mysqli_real_escape_string($connection,$_POST['categoryname']);
                $categoryDescription       = mysqli_real_escape_string($connection,$_POST['categorydescription']);
                $categorySeoTitle          = mysqli_real_escape_string($connection,$_POST['subjectcategoryseotitle']);
                $categorySeoDescription    = mysqli_real_escape_string($connection,$_POST['subjectcategoryseodescription']);
                $categorySeoKeywords       = mysqli_real_escape_string($connection,$_POST['subjectcategoryseokeywords']);

                // id from form
                $idFromForm   = mysqli_real_escape_string($connection,$_POST['categoryID']);

                $categoryInfo = $this->categoriesModel->getCategory($idFromForm);

                // admin id
                $adminId        = $_SESSION['user']['user_id'];




                // data
                $subjectCategoryData = array(

                    'category_name'        => $categoryName,
                    'category_description' => $categoryDescription,
                    'seo_title'            => $categorySeoTitle,
                    'seo_description'      => $categorySeoDescription,
                    'seo_keywords'         => $categorySeoKeywords,
                );


              // store data in data base
              if(count($categoryInfo)>0 AND $categoryInfo['created_by'] == $adminId)

              {
                  if($this->categoriesModel->updateCategory($idFromForm,$subjectCategoryData))

                  {
                      echo '<div class="alert alert-success"> <strong> Success! </strong> Category Updated</div>';
                  }

                  else

                  {
                      echo '<div class="alert alert-danger"> <strong> Error! </strong> Category Not Updated</div>';
                  }
              }

              else

              {
                  echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update That Category</div>';
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



            $connection = $this->categoriesModel->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get category by id

            $category   = $this->categoriesModel->getCategory($id);

            // admin id
            $adminId        = $_SESSION['user']['user_id'];

            $pageTitle  = $category['category_name'];

            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($category)>0 AND $category['created_by'] == $adminId)
            {
                include (WEBINTY_VIEWS.'/admin/updateSubjectCategory.html');
            }

            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }





    }







    /*
     *  Delete Subject Category
     */


    public function deleteSubjectCategory()

    {
        $this->checkPermission(4);

        $connection = $this->categoriesModel->connect;

        $idFromUrl = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id        = mysqli_real_escape_string($connection,$idFromUrl);

        // -1 get category By Id
        $category  = $this->categoriesModel->getCategory($id);

        // -2 get SESSION Of User Id
        $adminId = $_SESSION['user']['user_id'];


        if(count($category)>0 && $category['created_by'] == $adminId)

        {
            if($this->categoriesModel->deleteCategory($id))

            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> Category Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Category Not Deleted</div>';
            }
        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This Category </div>';
        }


    }








}