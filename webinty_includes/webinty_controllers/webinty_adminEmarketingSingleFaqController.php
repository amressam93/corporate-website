<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 22/08/2017
 * Time: 03:28 م
 */


class webinty_adminEmarketingSingleFaqController extends webinty_adminController

{
    private $emarketingFaqModel;

    public function __construct(webinty_emarketingSingleFaqModel $emarketingObject)

    {
        $this->emarketingFaqModel = $emarketingObject;
    }



    /*
     *  add Emarketing single FAQ
     */


    public function addEmarketingFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['emarketingFaqQuestion']) && isset($_POST['emarketingFaqAnswer']))

        {
            $validator = new validation();

            $rules     = array(

                'emarketingFaqQuestion' => 'required',
                'emarketingFaqAnswer'   => 'required'
            );


            // set validation rules
            $validator->setRules($rules);


            // check data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection  = $this->emarketingFaqModel->connect;
                $faqQuestion = mysqli_real_escape_string($connection,$_POST['emarketingFaqQuestion']);
                $faqAnswer   = mysqli_real_escape_string($connection,$_POST['emarketingFaqAnswer']);
                $createdBy             = $_SESSION['user']['user_id'];

                // data
                $emarketingFaqData = array(

                    'emarketing_single_question' => $faqQuestion,
                    'emarketing_single_answer'   => $faqAnswer,
                    'created_by'                 => $createdBy,
                    'created_at'                 => $date
                );


                // check is exits

                $emarketingFaqArray = $this->emarketingFaqModel->getAllEmarketingFaqs();

                if($this->checkIsExists($emarketingFaqArray,'emarketingFaqQuestion',$faqQuestion))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ is Already Exists</div>';
                    exit;
                }



                // store Data In DataBase

                if($this->emarketingFaqModel->addEmarketingFaq($emarketingFaqData))

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
            $pageTitle = "Add E-Marketing FAQ";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addEmarketingFaq.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }


    }






    /*
     * get all Emarketing Faqs
     */


    public function getEmarketingFaqs()

    {
        $this->checkPermission(4);

        $pageTitle = "All E-Marketing FAQS";

        // model
        $emarketingFaqs = $this->emarketingFaqModel->getAllEmarketingFaqs();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/emarketingFaqs.html');
    }





    /*
     * get Emarketing Faq By Id
     */


    public function getEmarketingFaqById()

    {
        $this->checkPermission(4);
        $connection = $this->emarketingFaqModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $emarketingFaq = $this->emarketingFaqModel->getEmarketingFaqById($id);
        $pageTitle     = $emarketingFaq['emarketing_single_question'];

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($emarketingFaq)>0)

        {
            include (WEBINTY_VIEWS.'/admin/emarketingFaq.html');
        }
        else

        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');
    }








    /*
     * update Emarketing Faq
     */


    public function updateEmarketingFaq()

    {
        $this->checkPermission(4);

        if(isset($_POST['emarketingFaqQuestion']) && isset($_POST['emarketingFaqAnswer']))

        {
            $validator = new validation();

            $rules     = array(

                'emarketingFaqQuestion' => 'required',
                'emarketingFaqAnswer'   => 'required'
            );


            // set validation rules
            $validator->setRules($rules);


            // check data
            if($validator->validate())

            {
                $connection = $this->emarketingFaqModel->connect;
                $faqQuestion = mysqli_real_escape_string($connection,$_POST['emarketingFaqQuestion']);
                $faqAnswer   = mysqli_real_escape_string($connection,$_POST['emarketingFaqAnswer']);

                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['emarketingfaqId']);

                // Emarketing Data By Id From Form
                $emarketingFaqInfo  = $this->emarketingFaqModel->getEmarketingFaqById($idFromForm);

                // admin id
                $adminId        = $_SESSION['user']['user_id'];

                // data
                $emarketingFaqData = array(

                    'emarketing_single_question' => $faqQuestion,
                    'emarketing_single_answer'   => $faqAnswer
                );

                if(count($emarketingFaqInfo)>0 AND $emarketingFaqInfo['created_by'] == $adminId)

                {
                    if($this->emarketingFaqModel->updateEmarketingFaq($idFromForm,$emarketingFaqData))

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
            $connection = $this->emarketingFaqModel->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Emarketing Data By id
            $emarketingFaq    = $this->emarketingFaqModel->getEmarketingFaqById($id);


            // -2 get SESSION Of User Id
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = $emarketingFaq['emarketing_single_question'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($emarketingFaq)>0 AND $emarketingFaq['created_by'] == $adminId)

            {
                include (WEBINTY_VIEWS.'/admin/updateEmarketingFaq.html');
            }

            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }





    /*
     * delete Emarketing Faq
     */


    public function deleteEmarketingFaq()

    {
        $this->checkPermission(4);
        $connection    = $this->emarketingFaqModel->connect;
        $idFromUrl     = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id            = mysqli_real_escape_string($connection,$idFromUrl);

        $emarketingFaq = $this->emarketingFaqModel->getEmarketingFaqById($id);
        $adminId       = $_SESSION['user']['user_id'];

        if(count($emarketingFaq)>0 AND $emarketingFaq['created_by'] == $adminId)

        {
            if($this->emarketingFaqModel->deleteEmarketingFaq($id))

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