<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 07/08/2017
 * Time: 12:30 م
 */
class webinty_adminHostingSingleFaqController extends webinty_adminController

{

    private $hostingFAQModel;

    public function __construct(webinty_hostingSingleFaqModel $hostObject)

    {
        $this->hostingFAQModel = $hostObject;
    }



    /*
     * add hosting single FAQ
     */

    public function addHostingFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['hostingFaqQuestion']) && isset($_POST['hostingFaqAnswer']))

        {
            $validator = new validation();

            $rules     = array(

                'hostingFaqQuestion' => 'required',
                'hostingFaqAnswer'   => 'required'
            );


            // set Validation Rules
            $validator->setRules($rules);


            // check data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->hostingFAQModel->connect;
                $hostFaqQuestion = mysqli_real_escape_string($connection,$_POST['hostingFaqQuestion']);
                $hostFaqAnswer   = mysqli_real_escape_string($connection,$_POST['hostingFaqAnswer']);
                $createdBy             = $_SESSION['user']['user_id'];

                // data
                $hostFaqData = array(

                    'hosting_single_question' => $hostFaqQuestion,
                    'hosting_single_answer'   => $hostFaqAnswer,
                    'created_by'              => $createdBy,
                    'created_at'              => $date

                );


                // check is exits

                $HostingFaqArray = $this->hostingFAQModel->getAllHostingFaqs();

                if($this->checkIsExists($HostingFaqArray,'hostingFaqQuestion',$hostFaqQuestion))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ is Already Exists</div>';
                    exit;
                }


                // store Data In DataBase

                if($this->hostingFAQModel->addHostingSingleFAQ($hostFaqData))

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
            $pageTitle = "Add Hosting FAQ";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addHostFaq.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }




    /*
     * get all Hosting Faq
     */

    public function getHostingFaqs()

    {
        $this->checkPermission(4);
        $pageTitle = "All Hosting FAQS";


        // model
        $hostingFaqs = $this->hostingFAQModel->getAllHostingFaqs();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/hostingFaqs.html');
    }





    /*
     * get hosting Faq By Id
     */

    public function getHostingFaqById()

    {
        $this->checkPermission(4);
        $connection = $this->hostingFAQModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $hostingFaq = $this->hostingFAQModel->getHostingFaq($id);

        $pageTitle  = $hostingFaq['hosting_single_question'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($hostingFaq)>0)

        {
            include (WEBINTY_VIEWS.'/admin/hostingFaq.html');
        }

        else

        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }


        include (WEBINTY_VIEWS.'/admin/footer.html');


    }







    /*
     * update hosting FAQ
     */

    public function updateHostingFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['hostingFaqQuestion']) && isset($_POST['hostingFaqAnswer']))

        {
            $validator = new validation();

            $rules     = array(

                'hostingFaqQuestion' => 'required',
                'hostingFaqAnswer'   => 'required'
            );


            // set Validation Rules
            $validator->setRules($rules);

            // check data

            if($validator->validate())

            {
                $connection = $this->hostingFAQModel->connect;
                $hostFaq_Question = mysqli_real_escape_string($connection,$_POST['hostingFaqQuestion']);
                $hostFaq_Answer   = mysqli_real_escape_string($connection,$_POST['hostingFaqAnswer']);

                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['hostingFaqId']);

                // Hosting Data By Id From Form
                $hostingFaqInfo     = $this->hostingFAQModel->getHostingFaq($idFromForm);


                // admin id
                $adminId        = $_SESSION['user']['user_id'];

                // data

                $hostingData = array(

                    'hosting_single_question' => $hostFaq_Question,
                    'hosting_single_answer'   => $hostFaq_Answer
                );


                if(count($hostingFaqInfo)>0 AND $hostingFaqInfo['created_by'] == $adminId)

                {
                    if($this->hostingFAQModel->updateHostingSingleFAQ($idFromForm,$hostingData))

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
            $connection = $this->hostingFAQModel->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Hosting Data By id
            $HostingFaq    = $this->hostingFAQModel->getHostingFaq($id);

            // -2 get SESSION Of User Id
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = $HostingFaq['hosting_single_question'];


            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($HostingFaq)>0 AND $HostingFaq['created_by'] == $adminId)

            {
                include (WEBINTY_VIEWS.'/admin/updateHostingFaq.html');
            }

            else

            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }


            include (WEBINTY_VIEWS.'/admin/footer.html');

        }


    }








    /*
     * Delete Hosting Faq
     */


    public function deleteHostingFaq()

    {
        $this->checkPermission(4);
        $connection = $this->hostingFAQModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id           = mysqli_real_escape_string($connection,$idFromUrl);

        // hosting data By id
        $hostingFaq = $this->hostingFAQModel->getHostingFaq($id);

        $adminId      = $_SESSION['user']['user_id'];

        if(count($hostingFaq)>0 AND $hostingFaq['created_by'] == $adminId)

        {
            if($this->hostingFAQModel->deleteHostingSingleFAQ($id))

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