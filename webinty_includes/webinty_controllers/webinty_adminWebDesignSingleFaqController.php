<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05/08/2017
 * Time: 05:14 م
 */
class webinty_adminWebDesignSingleFaqController extends webinty_adminController

{
    private $webDesignFAQModel;


    public function __construct(webinty_webDesignSingleFaqModel $webDesignObj)

    {
        $this->webDesignFAQModel = $webDesignObj;
    }





    /*
     * add webDesign Single FAQ
     */

    public function addWebDesignFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['webDesignFaqQuestion']) && isset($_POST['webDesignFaqAnswer']))

        {
            $validator = new validation();

            $rules = array(

                'webDesignFaqQuestion'  => 'required',
                'webDesignFaqAnswer'    => 'required'
            );


            // set validation rules
            $validator->setRules($rules);


            // check data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");
                $connection = $this->webDesignFAQModel->connect;

                $faqQuestion = mysqli_real_escape_string($connection,$_POST['webDesignFaqQuestion']);
                $faqAnswer   = mysqli_real_escape_string($connection,$_POST['webDesignFaqAnswer']);

                $createdBy             = $_SESSION['user']['user_id'];

                // data
                $webDesignFaqData = array(

                    'web_design_faq_question' => $faqQuestion,
                    'web_design_faq_answer'   => $faqAnswer,
                    'created_by'              => $createdBy,
                    'created_at'              => $date
                );


                // check is exits

                $webDesignFaqArray = $this->webDesignFAQModel->getAllWebDesignFaqs();

                if($this->checkIsExists($webDesignFaqArray,'webDesignFaqQuestion',$faqQuestion))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ is Already Exists</div>';
                    exit;
                }


                // store Data In DataBase

                if($this->webDesignFAQModel->addWebDesignFAQ($webDesignFaqData))

                {
                    echo '<div class="alert alert-success"> <strong> Success </strong> FAQ Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Not Inserted</div>';
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
            $pageTitle = "Add Web Design FAQ";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addWebDesignFaq.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }


    }







    /*
     * get all web design faqs
     */


    public function getWebDesginFaqs()

    {
        $this->checkPermission(4);

        $pageTitle = "All Web Design FAQS";

        // model
        $webDesignFaqs = $this->webDesignFAQModel->getAllWebDesignFaqs();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/webDesignFaqs.html');
    }







    /*
     *  get web design FAQ by id
     */

    public function getWebDesignFaqById()

    {
        $this->checkPermission(4);
        $connection = $this->webDesignFAQModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $webDesignFaq = $this->webDesignFAQModel->getWebDesignFaqById($id);

        $pageTitle  = $webDesignFaq['web_design_faq_question'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($webDesignFaq)>0)

        {
            include (WEBINTY_VIEWS.'/admin/webDesignFaq.html');
        }
        else

        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');


    }








    /*
     * update web design FAQ
     */

    public function updateWebDesignFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['webDesignFaqQuestion']) && isset($_POST['webDesignFaqAnswer']))

        {
            $validator = new validation();

            $rules = array(

                'webDesignFaqQuestion'  => 'required',
                'webDesignFaqAnswer'    => 'required'
            );


            // set validation rules
            $validator->setRules($rules);


            if($validator->validate())

            {
                $connection = $this->webDesignFAQModel->connect;

                $faq_Question = mysqli_real_escape_string($connection,$_POST['webDesignFaqQuestion']);
                $faq_Answer   = mysqli_real_escape_string($connection,$_POST['webDesignFaqAnswer']);

                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['webDesignFaqId']);

                // web Design Data By Id From Form
                $webDesignFaqInfo        = $this->webDesignFAQModel->getWebDesignFaqById($idFromForm);


                // admin id
                $adminId        = $_SESSION['user']['user_id'];


                // data
                $webDesignFaqData = array(

                    'web_design_faq_question' => $faq_Question,
                    'web_design_faq_answer'   => $faq_Answer
                );


                if(count($webDesignFaqInfo)>0 AND $webDesignFaqInfo['created_by'] == $adminId)

                {
                    if($this->webDesignFAQModel->updateWebDesignFAQ($idFromForm,$webDesignFaqData))

                    {
                        echo '<div class="alert alert-success"> <strong> Success </strong> FAQ Updated</div>';
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Not Updated</div>';
                    }

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This FAQ</div>';
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
            $connection = $this->webDesignFAQModel->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Web Design Data By id
            $webDesignFaq    = $this->webDesignFAQModel->getWebDesignFaqById($id);

            // -2 get SESSION Of User Id
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = $webDesignFaq['web_design_faq_question'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($webDesignFaq)>0 AND $webDesignFaq['created_by'] == $adminId )

            {
                include (WEBINTY_VIEWS.'/admin/updateWebDesignFaq.html');
            }

            else

            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');


        }

    }






    /*
     * delete web design FAQ
     */


    public function deleteWebDesignFaq()

    {
        $this->checkPermission(4);
        $connection = $this->webDesignFAQModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id           = mysqli_real_escape_string($connection,$idFromUrl);
        $webDesignFaq = $this->webDesignFAQModel->getWebDesignFaqById($id);

        $adminId      = $_SESSION['user']['user_id'];


        if(count($webDesignFaq)>0 AND $webDesignFaq['created_by'] == $adminId)

        {
            if($this->webDesignFAQModel->deleteWebDesignFAQ($id))

            {
                echo '<div class="alert alert-success"> <strong> Success </strong> FAQ Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> FAQ Not Deleted</div>';
            }

        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This FAQ </div>';
        }



    }






}