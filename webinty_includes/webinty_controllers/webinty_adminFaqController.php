<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/07/2017
 * Time: 02:52 م
 */
class webinty_adminFaqController extends webinty_adminController


{

    private $faqModel;

    public function __construct(webinty_faqModel $faq)

    {
        $this->faqModel = $faq;
    }


    /*
     *  add Faq
     */


    public function addFaq()

    {
        $this->checkPermission(4);

        if (isset($_POST['faqQuestion']) && isset($_POST['faqAnswer']) && isset($_POST['faqCategory']))

        {
            $vaildator = new validation();

            $rules = array(

                'faqQuestion' => 'required',
                'faqAnswer' => 'required',
                'faqCategory' => 'required'
            );


            // set validation Rules
            $vaildator->setRules($rules);


            // check Data
            if ($vaildator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection = $this->faqModel->connect;
                $question = mysqli_real_escape_string($connection, $_POST['faqQuestion']);
                $answer = mysqli_real_escape_string($connection, $_POST['faqAnswer']);
                $faqCategory = mysqli_real_escape_string($connection, $_POST['faqCategory']);
                $createdBy = $_SESSION['user']['user_id'];


                $FaqData = array(

                    'faq_question' => $question,
                    'faq_answer' => $answer,
                    'faq_category' => $faqCategory,
                    'created_by' => $createdBy,
                    'created_at' => $date
                );


                // store data in dataBase
                $FaqsArray = $this->faqModel->getAllFAQs();

                if ($this->checkIsExists($FaqsArray, 'faq_question', $question))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Question is Already Exists</div>';
                    exit;
                }


                if ($this->faqModel->addFAQ($FaqData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> FAQ Inserted</div>';
                }
                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> FAQ Not Inserted</div>';
                }


            }

            else

                {
                $validationErrors = $vaildator->getErrors();
                include(WEBINTY_VIEWS . '/admin/resultMessages.html');
                }


        }

        else

        {

            $pageTitle = "Add FAQ";

            // get Faq Categoreies
            $FAQModel = new webinty_faqCategoriesModel();
            $FaqCategories = $FAQModel->getAllFaqCategories();

            //display Form
            include(WEBINTY_VIEWS . '/admin/header.html');
            include(WEBINTY_VIEWS . '/admin/menu.html');
            include(WEBINTY_VIEWS . '/admin/nav.html');
            include(WEBINTY_VIEWS . '/admin/addFaq.html');
            include(WEBINTY_VIEWS . '/admin/footer.html');
        }

    }






    /*
     * get All FAQS
     */

    public function getAllFaqs()

    {
        $this->checkPermission(4);

        $pageTitle = "All FAQS";

        // model
        $faqs = $this->faqModel->getAllFAQs();

        // view
        include(WEBINTY_VIEWS . '/admin/header.html');
        include(WEBINTY_VIEWS . '/admin/menu.html');
        include(WEBINTY_VIEWS . '/admin/nav.html');
        include(WEBINTY_VIEWS . '/admin/faqs.html');
    }






    /*
     * get FAQ By Id
     */


    public function getFaq()

    {
        $this->checkPermission(4);
        $connection = $this->faqModel->connect;
        $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
        $id = mysqli_real_escape_string($connection, $idFromUrl);

        $faq = $this->faqModel->getFAQ($id);

        $pageTitle = $faq['faq_question'];

        // view

        include(WEBINTY_VIEWS . '/admin/header.html');
        include(WEBINTY_VIEWS . '/admin/menu.html');
        include(WEBINTY_VIEWS . '/admin/nav.html');
        if (count($faq) > 0)
        {
            include(WEBINTY_VIEWS . '/admin/faq.html');
        }

        else

        {
            include(WEBINTY_VIEWS . '/admin/404Error.html');
        }

        include(WEBINTY_VIEWS . '/admin/footer.html');

    }






    /*
     * update Faq
     */

    public function updateFaq()

    {
        $this->checkPermission(4);

        if (isset($_POST['faqQuestion']) && isset($_POST['faqAnswer']) && isset($_POST['faqCategory']))

        {

            $vaildator = new validation();

            $rules = array(

                'faqQuestion' => 'required',
                'faqAnswer' => 'required',
                'faqCategory' => 'required'
            );


            // set validation Rules
            $vaildator->setRules($rules);

            // check Data
            if ($vaildator->validate())

            {

                $connection = $this->faqModel->connect;
                $question = mysqli_real_escape_string($connection, $_POST['faqQuestion']);
                $answer = mysqli_real_escape_string($connection, $_POST['faqAnswer']);
                $faqCategory = mysqli_real_escape_string($connection, $_POST['faqCategory']);
                $createdBy = $_SESSION['user']['user_id'];

                // FAQ id from Form
                $idFromForm = mysqli_real_escape_string($connection, $_POST['faqId']);

                // FAQ Data From Form
                $faqInfo = $this->faqModel->getFAQ($idFromForm);

                // admin id
                $adminId = $_SESSION['user']['user_id'];


                $FaqData = array(

                    'faq_question' => $question,
                    'faq_answer' => $answer,
                    'faq_category' => $faqCategory
                );


                if (count($faqInfo) > 0 AND $faqInfo['created_by'] == $adminId)
                {
                    // store data in dataBase

                    if ($this->faqModel->updateFAQ($idFromForm, $FaqData))
                    {
                        echo '<div class="alert alert-success"> <strong> Success! </strong> FAQ Updated</div>';
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
                $validationErrors = $vaildator->getErrors();
                include(WEBINTY_VIEWS . '/admin/resultMessages.html');
            }


        }

        else
         {
            $connection = $this->faqModel->connect;
            $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
            $id = mysqli_real_escape_string($connection, $idFromUrl);

            $faq = $this->faqModel->getFAQ($id);


            // admin id By session
            $adminId = $_SESSION['user']['user_id'];


            // page Title
            $pageTitle = $faq['faq_question'];

            // display Form
            include(WEBINTY_VIEWS . '/admin/header.html');
            include(WEBINTY_VIEWS . '/admin/menu.html');
            include(WEBINTY_VIEWS . '/admin/nav.html');

            if (count($faq) > 0 AND $faq['created_by'] == $adminId)

            {
                $faqCategories = new webinty_faqCategoriesModel();
                $categories = $faqCategories->getAllFaqCategories();

                include(WEBINTY_VIEWS . '/admin/updateFaq.html');
            }
            else
            {
                include(WEBINTY_VIEWS . '/admin/404Error.html');
            }

            include(WEBINTY_VIEWS . '/admin/footer.html');
        }

    }






    /*
     *  Delete FAQ
     */


    public function deleteFaq()

    {
        $this->checkPermission(4);
        $connection = $this->faqModel->connect;

        $idFromUrl = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
        $id = mysqli_real_escape_string($connection, $idFromUrl);
        $faq = $this->faqModel->getFAQ($id);

        $adminId = $_SESSION['user']['user_id'];

        if (count($faq) > 0 AND $faq['created_by'] == $adminId)
        {
            if ($this->faqModel->deleteFAQ($id))
            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> FAQ Deleted</div>';
            }
            else
            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> FAQ Not Deleted</div>';
            }

        }
        else
        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That FAQ </div>';
        }

    }







    /*
     * get all FAQs By Category
     */


    public function getAllFaqsByCategory()

    {
        $this->checkPermission(4);
        $pageTitle = "All FAQS Category";

        //FAQ model data
        $faqs = $this->faqModel->getAllFAQs();

        // FAQ category model
        $faqCategoriesModel = new webinty_faqCategoriesModel();
        $faqCategories      = $faqCategoriesModel->getAllFaqCategories();


        // view
        include(WEBINTY_VIEWS . '/admin/header.html');
        include(WEBINTY_VIEWS . '/admin/menu.html');
        include(WEBINTY_VIEWS . '/admin/nav.html');
        include(WEBINTY_VIEWS . '/admin/faqCategory.html');
        include(WEBINTY_VIEWS . '/admin/footer.html');



    }









}