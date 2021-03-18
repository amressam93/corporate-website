<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/06/2017
 * Time: 04:10 م
 */


class webinty_adminSubjectsController extends webinty_adminController


{

    private $subjectsModel;


    public function __construct(webinty_subjectsModel $subject)

    {
        $this->subjectsModel = $subject;
    }






    /*
     * add subject
     */

    public function addSubject()

    {
        $this->checkPermission(4);

        if(isset($_POST['subjecttitle']) && isset($_POST['subjectdescription']) && isset($_POST['subjectseotitle']) && isset($_POST['subjectseodescription']) && isset($_POST['subjectseokeywords']) && isset($_POST['subjectseoimagealt']) && isset($_POST['subjectseoimagetitle']) && isset($_POST['subjectCategory']))

        {

            $validator = new validation();

            $rules = array(

                'subjecttitle'          => 'required',
                'subjectdescription'    => 'required|min:20',
                'subjectseotitle'       => 'required',
                'subjectseodescription' => 'required',
                'subjectseokeywords'    => 'required',
                'subjectseoimagealt'    => 'required',
                'subjectseoimagetitle'  => 'required',
                'subjectCategory'       => 'required'
            );

            // set validation rules
            $validator->setRules($rules);

            // check data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection            = $this->subjectsModel->connect;
                $subjectTitle          = mysqli_real_escape_string($connection,$_POST['subjecttitle']);
                $subjectDescription    = mysqli_real_escape_string($connection,$_POST['subjectdescription']);
                $subjectSeoTitle       = mysqli_real_escape_string($connection,$_POST['subjectseotitle']);
                $subjectSeoDescription = mysqli_real_escape_string($connection,$_POST['subjectseodescription']);
                $subjectSeoKeywords    = mysqli_real_escape_string($connection,$_POST['subjectseokeywords']);
                $subjectSeoImageAlt    = mysqli_real_escape_string($connection,$_POST['subjectseoimagealt']);
                $subjectSeoImageTitle  = mysqli_real_escape_string($connection,$_POST['subjectseoimagetitle']);
                $subjectCategory       = mysqli_real_escape_string($connection,$_POST['subjectCategory']);
                $createdBy             = $_SESSION['user']['user_id'];


                // image directort
                $imageDirectory     = '../webinty_includes/webinty_uploads/subjects';
                $subjectImage       = $this->uploadSingleImage('subjectimage',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                // data
                $subjectData = array(

                    'subject_title'            => $subjectTitle,
                    'subject_description'      => $subjectDescription,
                    'subject_image'            => $subjectImage,
                    'subject_seo_title'        => $subjectSeoTitle,
                    'subject_seo_description'  => $subjectSeoDescription,
                    'subject_seo_keywords'     => $subjectSeoKeywords,
                    'subject_seo_image_alt'    => $subjectSeoImageAlt,
                    'subject_seo_image_title'  => $subjectSeoImageTitle,
                    'subject_category'         => $subjectCategory,
                    'created_by'               => $createdBy,
                    'created_at'               => $date
                );



                // check is Exists
                $subjectsArray = $this->subjectsModel->getSubjects();

                if($this->checkIsExists($subjectsArray,'subject_title',$subjectTitle))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Subject is Already Exists</div>';
                    exit;
                }


                // store data in data base

                if($this->subjectsModel->addSubject($subjectData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Subject Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Subject Not Inserted</div>';
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
            $pageTitle = "Add Subject";

            // get All Subjects Categories

            $categoriesModel = new webinty_subjectsCategoriesModel();
            $categories      = $categoriesModel->getAllCategories();


            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addSubject.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');


        }

    }




    /*
     * get All Subjects
     */

    public function getSubjects()

    {

        $this->checkPermission(4);

        $pageTitle = "All Subjects";

        // model
        $subjects  = $this->subjectsModel->getSubjects();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/subjects.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');


    }





    /*
     *  get subject By id
     */

    public function getSubject()

    {

        $this->checkPermission(4);

        $connection = $this->subjectsModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $subject    = $this->subjectsModel->getSubject($id);

        $pageTitle  = $subject['subject_title'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($subject)>0)
        {
            $subjectsCategories = new webinty_subjectsCategoriesModel();
            $categories         = $subjectsCategories->getAllCategories();

            include (WEBINTY_VIEWS.'/admin/subject.html');
        }
        else

        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');

    }






    /*
     *  update subject
     */

    public function updateSubject()

    {
        $this->checkPermission(4);


        if(isset($_POST['subjecttitle']) && isset($_POST['subjectdescription']) && isset($_POST['subjectseotitle']) && isset($_POST['subjectseodescription']) && isset($_POST['subjectseokeywords']) && isset($_POST['subjectseoimagealt']) && isset($_POST['subjectseoimagetitle']) && isset($_POST['subjectCategory']))

        {

            $validator = new validation();

            $rules = array(

                'subjecttitle'          => 'required',
                'subjectdescription'    => 'required|min:20',
                'subjectseotitle'       => 'required',
                'subjectseodescription' => 'required',
                'subjectseokeywords'    => 'required',
                'subjectseoimagealt'    => 'required',
                'subjectseoimagetitle'  => 'required',
                'subjectCategory'       => 'required'
            );

            // set validation rules
            $validator->setRules($rules);

            // check data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection            = $this->subjectsModel->connect;
                $subjectTitle          = mysqli_real_escape_string($connection,$_POST['subjecttitle']);
                $subjectDescription    = mysqli_real_escape_string($connection,$_POST['subjectdescription']);
                $subjectSeoTitle       = mysqli_real_escape_string($connection,$_POST['subjectseotitle']);
                $subjectSeoDescription = mysqli_real_escape_string($connection,$_POST['subjectseodescription']);
                $subjectSeoKeywords    = mysqli_real_escape_string($connection,$_POST['subjectseokeywords']);
                $subjectSeoImageAlt    = mysqli_real_escape_string($connection,$_POST['subjectseoimagealt']);
                $subjectSeoImageTitle  = mysqli_real_escape_string($connection,$_POST['subjectseoimagetitle']);
                $subjectCategory       = mysqli_real_escape_string($connection,$_POST['subjectCategory']);

                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['subjectID']);

                // subject Data By Id From Form
                $subjectInfo        = $this->subjectsModel->getSubject($idFromForm);


                // admin id
                $adminId        = $_SESSION['user']['user_id'];


                // old Image
                $oldImage           = $subjectInfo['subject_image'];



                // image directort
                $imageDirectory     = '../webinty_includes/webinty_uploads/subjects';
                $subjectImage       = $this->uploadSingleImage('subjectimage',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                // data
                $subjectData = array(

                    'subject_title'            => $subjectTitle,
                    'subject_description'      => $subjectDescription,
                    'subject_seo_title'        => $subjectSeoTitle,
                    'subject_seo_description'  => $subjectSeoDescription,
                    'subject_seo_keywords'     => $subjectSeoKeywords,
                    'subject_seo_image_alt'    => $subjectSeoImageAlt,
                    'subject_seo_image_title'  => $subjectSeoImageTitle,
                    'subject_category'         => $subjectCategory,
                );


                // update Image

                if($subjectImage)

                {
                    $subjectData['subject_image'] = $subjectImage;
                }


                // store data in dataBase After Update

                if(count($subjectInfo)>0 AND $subjectInfo['created_by'] == $adminId)

                {

                    if($this->subjectsModel->updateSubject($idFromForm,$subjectData))

                    {
                        if($subjectImage)

                        {
                            unlink('../webinty_includes/webinty_uploads/subjects/'.$oldImage);
                        }

                        echo '<div class="alert alert-success"> <strong> Success! </strong> Subject Updated</div>';

                        echo "<meta http-equiv='refresh' content='2;URL=\"subject.php?id=".$idFromForm."\"' />";
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Subject Not Updated</div>';
                    }


                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Subject</div>';
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

            $connection = $this->subjectsModel->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Subject Data By id
            $subject    = $this->subjectsModel->getSubject($id);


            // -2 get SESSION Of User Id
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = $subject['subject_title'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            if(count($subject)>0 AND $subject['created_by'] == $adminId)
            {
                // get All Subjects Categories

                $categoriesModel = new webinty_subjectsCategoriesModel();
                $categories      = $categoriesModel->getAllCategories();

                include (WEBINTY_VIEWS.'/admin/updateSubject.html');
            }

            else

            {
               include (WEBINTY_VIEWS.'/admin/404Error.html');
            }


            include (WEBINTY_VIEWS.'/admin/footer.html');


        }



    }







    /*
     *  Delete Subject
     */

    public function deleteSubject()

    {
        $this->checkPermission(4);

        $connection = $this->subjectsModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $subject    = $this->subjectsModel->getSubject($id);

        $adminId    = $_SESSION['user']['user_id'];

        if(count($subject)>0 && $subject['created_by'] == $adminId)

        {
            if($this->subjectsModel->deleteSubject($id))

            {
                $subjectImage = $subject['subject_image'];

                if($subjectImage)
                {
                    unlink('../webinty_includes/webinty_uploads/subjects/'.$subjectImage);
                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> Subject Deleted</div>';

            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Subject Not Deleted</div>';
            }

        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That subject </div>';
        }


    }






    /*
     * get all articles By subject id
     */


    public function getArticlesBySubjectId()

    {
        $this->checkPermission(4);
        $connection = $this->subjectsModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $subjectId  = mysqli_real_escape_string($connection,$idFromUrl);

        $subject    = $this->subjectsModel->getSubject($subjectId);

        // articles Model
        $articlesModel = new webinty_articlesModel();
        $articles      = $articlesModel->getArticlesBySubjectId($subjectId);

        // images model
        $imagesModel = new webinty_articleImagesModel();

        $pageTitle  = $subject['subject_title'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');


        if(count($subject)>0)
        {
            include (WEBINTY_VIEWS.'/admin/articlesSubject.html');
        }

        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }


        include (WEBINTY_VIEWS.'/admin/footer.html');

    }





}