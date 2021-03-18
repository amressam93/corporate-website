<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/07/2017
 * Time: 10:41 ص
 */
class webinty_adminArticlesController extends webinty_adminController


{



    private $articlesModel;


    public function __construct(webinty_articlesModel $articleModel)

    {
        $this->articlesModel = $articleModel;
    }




    /*
     * add Article
     */

    public function addArticle()

    {
        $this->checkPermission(4);

        if(isset($_POST['articletitle']) && isset($_POST['articledescription']) && isset($_POST['articleseotitle']) && isset($_POST['articleseodescription']) && isset($_POST['articleseokeywords']) && isset($_POST['articleseoimagealt']) && isset($_POST['articleseoimagetitle']) && isset($_POST['articlesubject']))

        {
            $validator = new validation();

            $rules     = array(

              'articletitle'          => 'required',
              'articledescription'    => 'required|min:20',
              'articleseotitle'       => 'required',
              'articleseodescription' => 'required',
              'articleseokeywords'    => 'required',
              'articleseoimagealt'    => 'required',
              'articleseoimagetitle'  => 'required',
              'articlesubject'        => 'required'

            );


            // set validation Rules
            $validator->setRules($rules);


            // check Data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->articlesModel->connect;

                $title                 = mysqli_real_escape_string($connection,$_POST['articletitle']);
                $description           = mysqli_real_escape_string($connection,$_POST['articledescription']);
                $video                 = mysqli_real_escape_string($connection,$_POST['articlevideo']);
                $imageArticle          = mysqli_real_escape_string($connection,$_POST['articlevideo']);
                $articleSeoTitle       = mysqli_real_escape_string($connection,$_POST['articleseotitle']);
                $articleSeoDescription = mysqli_real_escape_string($connection,$_POST['articleseodescription']);
                $articleSeoKeywords    = mysqli_real_escape_string($connection,$_POST['articleseokeywords']);
                $articleSeoImageAlt    = mysqli_real_escape_string($connection,$_POST['articleseoimagealt']);
                $articleSeoImageTitle  = mysqli_real_escape_string($connection,$_POST['articleseoimagetitle']);
                $subject               = mysqli_real_escape_string($connection,$_POST['articlesubject']);
                $createdBy              = $_SESSION['user']['user_id'];




                // article seo og image directort
                $imageDirectory             = '../webinty_includes/webinty_uploads/articles/seo_og_image';
                $article_seo_og_image       = $this->uploadSingleImage('add_article_seo_og_image',$imageDirectory,array('image/png','image/jpg','image/jpeg'));



                $articleData = array(

                    'article_title'           =>  $title,
                    'article_description'     =>  $description,
                    'article_video'           =>  $video,
                    'article_seo_title'       =>  $articleSeoTitle,
                    'article_seo_description' =>  $articleSeoDescription,
                    'article_seo_keywords'    =>  $articleSeoKeywords,
                    'article_seo_image_alt'   =>  $articleSeoImageAlt,
                    'article_seo_image_title' =>  $articleSeoImageTitle,
                    'article_seo_og_image'    =>  $article_seo_og_image,
                    'article_subject'         =>  $subject,
                    'article_created_by'      =>  $createdBy,
                    'article_created_at'      =>  $date
                );



                if($this->articlesModel->addArticle($articleData))

                {

                    $articleID = $this->articlesModel->idInserted();

                    //  start upload Images

                    if(!empty($_FILES['articleimage']))

                    {
                        // image directort
                        //$x = WEBINTY_BACKEND_UPLOADS_PATH.'articles';
                        //$imageDirectory     = '../webinty_includes/webinty_uploads/articles';
                        $imageDirectory     = $_SERVER['DOCUMENT_ROOT'] . '/webinty_includes/webinty_uploads/articles';

                        $images = $this->uploadMultiImages('articleimage',$imageDirectory,array('image/png','image/jpg','image/jpeg')) ;

                        foreach ($images as $image)

                        {
                            $imageData = array(

                                'image_name'    => $image,
                                'created_at'    => $date,
                                'image_article' => $articleID
                            );

                            $pictures = new webinty_articleImagesModel();
                            $pic      = $pictures->addImage($imageData);
                        }

                    }

                    //  End upload Images




                    echo '<div class="alert alert-success"> <strong> Success! </strong> Article Inserted</div>';
                    echo "<meta http-equiv='refresh' content='2;URL=\"article.php?id=".$articleID."&subject_id=".$subject."\"' />";

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Article Not Inserted</div>';
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

            $pageTitle = "Add Article";

            // get subjects
            $subjectsModel = new webinty_subjectsModel();
            $subjects      = $subjectsModel->getSubjects();

            //display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addArticle.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');

        }

    }




    /*
     * get All Articles
     */

    public function getArticles()

    {
        $this->checkPermission(4);

        $pageTitle = "Articles";

        // model

        $articles = $this->articlesModel->getArticles();

        // images model
        $imagesModel = new webinty_articleImagesModel();


        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/articles.html');
    }




    /*
     * get Article
     */

    public function getArticle()

    {
        $this->checkPermission(4);

        $connection = $this->articlesModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $article    = $this->articlesModel->getArticle($id);


        // subject id
        $subjectIdFromUrl  = (isset($_GET['subject_id']))? (int)$_GET['subject_id']:0;
        $subjectId         = mysqli_real_escape_string($connection,$subjectIdFromUrl);

        $all_subjects_data = new webinty_subjectsModel();
        $subjectById       = $all_subjects_data->getSubject($subjectId);



        $pageTitle  = $article['article_title'];

        // view

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($article)>0 AND count($subjectById)>0 AND $article['article_subject'] == $subjectId)
        {
            $subjectCategories = new webinty_subjectsCategoriesModel();
            $subjects          = $subjectCategories->getAllCategories();

            $articlesImages = new webinty_articleImagesModel();
            $images         = $articlesImages->getImagesByArticleId($id);


            //--- related Atricles ---
            $relatedArticles = $this->articlesModel->getRandomArticlesBySubjectId($subjectId,"ORDER BY RAND()");


            include (WEBINTY_VIEWS.'/admin/article.html');
        }

        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');

    }







    /*
     * update article
     */


    public function updateArticle()

    {
        $this->checkPermission(4);

        if(isset($_POST['articletitle']) && isset($_POST['articledescription']) && isset($_POST['articleseotitle']) && isset($_POST['articleseodescription']) && isset($_POST['articleseokeywords']) && isset($_POST['articleseoimagealt']) && isset($_POST['articleseoimagetitle']) && isset($_POST['articlesubject']))

        {
            $validator = new validation();

            $rules     = array(

                'articletitle'          => 'required',
                'articledescription'    => 'required|min:20',
                'articleseotitle'       => 'required',
                'articleseodescription' => 'required',
                'articleseokeywords'    => 'required',
                'articleseoimagealt'    => 'required',
                'articleseoimagetitle'  => 'required',
                'articlesubject'        => 'required'
            );


            $validator->setRules($rules);

            if($validator->validate())

            {

                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->articlesModel->connect;

                $title                 = mysqli_real_escape_string($connection,$_POST['articletitle']);
                $description           = mysqli_real_escape_string($connection,$_POST['articledescription']);
                $video                 = mysqli_real_escape_string($connection,$_POST['articlevideo']);
                $articleSeoTitle       = mysqli_real_escape_string($connection,$_POST['articleseotitle']);
                $articleSeoDescription = mysqli_real_escape_string($connection,$_POST['articleseodescription']);
                $articleSeoKeywords    = mysqli_real_escape_string($connection,$_POST['articleseokeywords']);
                $articleSeoImageAlt    = mysqli_real_escape_string($connection,$_POST['articleseoimagealt']);
                $articleSeoImageTitle  = mysqli_real_escape_string($connection,$_POST['articleseoimagetitle']);
                $subject               = mysqli_real_escape_string($connection,$_POST['articlesubject']);

                // article Id From Form
                $idFromForm            = mysqli_real_escape_string($connection,$_POST['article_id']);

                // article Data From Form
                $articleInfo           = $this->articlesModel->getArticle($idFromForm);


                // article Id
                $articleID             = $articleInfo['article_id'];



                // admin id
                $adminId        = $_SESSION['user']['user_id'];



                $article_seo_og_old_image = $articleInfo['article_seo_og_image'];



                // Article seo og image directort
                $imageDirectory             = '../webinty_includes/webinty_uploads/articles/seo_og_image';
                $article_seo_og_image       = $this->uploadSingleImage('update_article_seo_og_image',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                $articleData      = array(

                    'article_title'           =>  $title,
                    'article_description'     =>  $description,
                    'article_video'           =>  $video,
                    'article_seo_title'       => $articleSeoTitle,
                    'article_seo_description' => $articleSeoDescription,
                    'article_seo_keywords'    => $articleSeoKeywords,
                    'article_seo_image_alt'   => $articleSeoImageAlt,
                    'article_seo_image_title' => $articleSeoImageTitle,
                    'article_subject'         =>  $subject
                );



                // update article seo og image
                if($article_seo_og_image)
                {
                    $articleData['article_seo_og_image'] = $article_seo_og_image;
                }


                if(count($articleInfo)>0 AND $articleInfo['article_created_by'] == $adminId)

                {

                    if($article_seo_og_image)

                    {
                        unlink('../webinty_includes/webinty_uploads/articles/seo_og_image/'.$article_seo_og_old_image);
                    }


                    if($this->articlesModel->updateArticle($idFromForm,$articleData))

                    {
                        echo '<div class="alert alert-success"> <strong> Success! </strong> Article Updated</div>';
                        echo "<meta http-equiv='refresh' content='2;URL=\"article.php?id=".$articleID."&subject_id=".$subject."\"' />";
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Article Not Updated</div>';
                    }

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Article</div>';
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
            $connection = $this->articlesModel->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            $article    = $this->articlesModel->getArticle($id);


            // subject id
            $subjectIdFromUrl  = (isset($_GET['subject_id']))? (int)$_GET['subject_id']:0;
            $subjectId         = mysqli_real_escape_string($connection,$subjectIdFromUrl);

            $all_subjects_data = new webinty_subjectsModel();
            $subjectById       = $all_subjects_data->getSubject($subjectId);

            // admin id By session
            $adminId    = $_SESSION['user']['user_id'];



            // page Title
            $pageTitle  = $article['article_title'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            if(count($article)>0 AND count($subjectById)>0 And $article['article_subject'] == $subjectId AND $article['article_created_by'] == $adminId)
            {
                $subjectsData = new webinty_subjectsModel();
                $subjects     = $subjectsData->getSubjects();

                include (WEBINTY_VIEWS.'/admin/updateArticle.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }



    }






    /*
     * delete article
     */


    public function deleteArticle()

    {
        $this->checkPermission(4);

        $connection = $this->articlesModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $article    = $this->articlesModel->getArticle($id);

        $adminId    = $_SESSION['user']['user_id'];

        $articleImages         = new webinty_articleImagesModel();
        $images                = $articleImages->getImagesByArticleId($id);


        if(count($article)>0 && $article['article_created_by'] == $adminId)

        {
            if($this->articlesModel->deleteArticle($id))

            {

                foreach ($images as $image)

                {
                    if($image)
                    {
                        unlink('../webinty_includes/webinty_uploads/articles/'.$image['image_name']);
                    }

                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> Article Deleted</div>';

            }
            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Article Not Deleted</div>';
            }

        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That Article </div>';
        }

    }




    /*
     * get all images by article id
     */


    public function getImages()

    {
        $this->checkPermission(4);

        $connection                 = $this->articlesModel->connect;
        $idFromUrl                  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $articleId                  = mysqli_real_escape_string($connection,$idFromUrl);
        $subjectIdFromUrl           = (isset($_GET['subject_id']))? (int)$_GET['subject_id']:0;

        $subjectId                  = mysqli_real_escape_string($connection,$subjectIdFromUrl);

        // subjects model
        $subjectsModel              = new webinty_subjectsModel();
        $subject                    = $subjectsModel->getSubject($subjectId);

        $getArticleById             = $this->articlesModel->getArticle($articleId);






        // start add image

            if(isset($_POST['addImageArticle']) AND !empty($_FILES['imagesOfArticle']))

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                // image directort
                $imageDirectory     = '../webinty_includes/webinty_uploads/articles';
                $imagesArray = $this->uploadMultiImages('imagesOfArticle',$imageDirectory,array('image/png','image/jpg','image/jpeg')) ;

                foreach ($imagesArray as $imageArray)

                {
                    $imageData = array(

                        'image_name'    => $imageArray,
                        'created_at'    => $date,
                        'image_article' => $articleId
                    );


                    $picturesInfo = new webinty_articleImagesModel();
                    $pict      = $picturesInfo->addImage($imageData);

                    header("Location: updateImages.php?id=$articleId&subject_id=$subjectId");
                }
            }


        // end add image




        // admin id By session
        $adminId    = $_SESSION['user']['user_id'];

        $pageTitle           = $getArticleById['article_title'];

        // all images
        $imagesModel         = new webinty_articleImagesModel();
        $images              = $imagesModel->getImagesByArticleId($articleId);

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($getArticleById)>0 && $getArticleById['article_subject'] == $subjectId && $getArticleById['article_created_by'] == $adminId)
        {
            include (WEBINTY_VIEWS.'/admin/updateImages.html');
        }

        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }


        include (WEBINTY_VIEWS.'/admin/footer.html');


    }




    /*
     * Delete article image
     */

    public function deleteImage()

    {
        $this->checkPermission(4);

        $connection = $this->articlesModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);


        $articleOfId = (isset($_GET['articleID']))? (int)$_GET['articleID']:0;
        $article_id  = mysqli_real_escape_string($connection,$articleOfId);

        // images model
        $imagesModel = new webinty_articleImagesModel();
        $image       = $imagesModel->getImage($id);

        // -2 get SESSION Of User Id
        $adminId = $_SESSION['user']['user_id'];

        if(count($image)>0 AND $image['article_created_by'] == $adminId AND $image['image_article'] == $article_id)
        {
            if($imagesModel->deleteImage($id))

            {
                $articleImage = $image['image_name'];

                if($articleImage)
                {
                    unlink('../webinty_includes/webinty_uploads/articles/'.iconv("utf-8", "cp1256",$articleImage));
                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> Image Deleted </div>';

            }

            else
            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Image Not Deleted</div>';
            }


        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That Image </div>';
        }

    }






    /*
     * get all articles By subject Category Id
     */

    public function getArticlesBySubjectCategory()

    {
        $this->checkPermission(4);
        $connection = $this->articlesModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $categoryId = mysqli_real_escape_string($connection,$idFromUrl);

        $subjectCategoriesModel = new webinty_subjectsCategoriesModel();
        $subjectCategory        = $subjectCategoriesModel->getCategory($categoryId);


        // images model
        $imagesModel = new webinty_articleImagesModel();

        $articles   = $this->articlesModel->getArticlesBySubjectCategoryId($categoryId);
        $pageTitle = $subjectCategory['category_name'];


        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($subjectCategory)>0)
        {
            include (WEBINTY_VIEWS.'/admin/articlesCategory.html');
        }
        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }


        include (WEBINTY_VIEWS.'/admin/footer.html');



    }



}