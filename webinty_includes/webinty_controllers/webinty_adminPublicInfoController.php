<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 05/06/2017
 * Time: 05:10 م
 */
class webinty_adminPublicInfoController extends webinty_adminController


{

    private $publicInfo;

    public function __construct(webinty_publicInfoModel $info)

    {
        $this->publicInfo = $info;
    }






    /*
     * add public Information
     */


    public function addInfo()

    {
        $this->checkPermission(4);

        if(isset($_POST['company_name']) && isset($_POST['aboutcompany']) && isset($_POST['company_address']))

        {

            $validator = new validation();

            $rules = array(

                'company_name'     => 'required',
                'aboutcompany'     => 'required|min:10',
                'company_address'  => 'required',
                'mobile1'          => 'required',
                'mobile2'          => 'required',
                'email_info'       => 'required|email',
                'email_sales'      => 'required|email',
                'email_marketing'  => 'required|email',
                'email_technical'  => 'required|email',
                'email_callcenter' => 'required|email',
                'facebook'         => 'required',
                'twitter'          => 'required',
                'linkedin'         => 'required',
                'googleplus'       => 'required',
                'skype'            => 'required',
                'blogger'          => 'required',
                'wordpress'        => 'required',
                'tumblr'           => 'required',
                'vimeo'            => 'required',
                'instagram'        => 'required'

            );


            // set validation Rules
            $validator->setRules($rules);


            if($validator->validate())

            {
                // date and time format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                // connection to database to use sql injection
                $connection = $this->publicInfo->connect;

                $company_name                        = mysqli_real_escape_string($connection,$_POST['company_name']);
                $aboutcompany                        = mysqli_real_escape_string($connection,$_POST['aboutcompany']);
                $company_address                     = mysqli_real_escape_string($connection,$_POST['company_address']);
                $mobile1                             = mysqli_real_escape_string($connection,$_POST['mobile1']);
                $mobile2                             = mysqli_real_escape_string($connection,$_POST['mobile2']);
                $landline_phone_number               = mysqli_real_escape_string($connection,$_POST['landline_phone_number']);
                $sales_phone_number_1                = mysqli_real_escape_string($connection,$_POST['sales_mobile_number_1']);
                $sales_phone_number_2                = mysqli_real_escape_string($connection,$_POST['sales_mobile_number_2']);
                $sales_phone_number_3                = mysqli_real_escape_string($connection,$_POST['sales_mobile_number_3']);
                $technical_support_phone_number_1    = mysqli_real_escape_string($connection,$_POST['Technical_Support_Mobile_number_1']);
                $technical_support_phone_number_2    = mysqli_real_escape_string($connection,$_POST['Technical_Support_Mobile_number_2']);
                $callcenter_phone_number_1           = mysqli_real_escape_string($connection,$_POST['customer_service_Mobile_number_1']);
                $callcenter_phone_number_2           = mysqli_real_escape_string($connection,$_POST['customer_service_Mobile_number_2']);
                $hosting_phone_number                = mysqli_real_escape_string($connection,$_POST['hosting_service_Mobile_number']);
                $whatsapp_main_number                = mysqli_real_escape_string($connection,$_POST['whatsapp_main_mobile_number']);
                $whatsapp_sales_number               = mysqli_real_escape_string($connection,$_POST['whatsapp_sales_mobile_number']);
                $google_map_iframe                   = mysqli_real_escape_string($connection,$_POST['google_map_iframe']);

                $email_info                          = mysqli_real_escape_string($connection,$_POST['email_info']);
                $email_sales                         = mysqli_real_escape_string($connection,$_POST['email_sales']);
                $email_marketing                     = mysqli_real_escape_string($connection,$_POST['email_marketing']);
                $email_technical                     = mysqli_real_escape_string($connection,$_POST['email_technical']);
                $email_callcenter                    = mysqli_real_escape_string($connection,$_POST['email_callcenter']);
                $facebook                            = mysqli_real_escape_string($connection,$_POST['facebook']);
                $twitter                             = mysqli_real_escape_string($connection,$_POST['twitter']);
                $linkedin                            = mysqli_real_escape_string($connection,$_POST['linkedin']);
                $googleplus                          = mysqli_real_escape_string($connection,$_POST['googleplus']);
                $skype                               = mysqli_real_escape_string($connection,$_POST['skype']);
                $blogger                             = mysqli_real_escape_string($connection,$_POST['blogger']);
                $wordpress                           = mysqli_real_escape_string($connection,$_POST['wordpress']);
                $tumblr                              = mysqli_real_escape_string($connection,$_POST['tumblr']);
                $vimeo                               = mysqli_real_escape_string($connection,$_POST['vimeo']);
                $instagram                           = mysqli_real_escape_string($connection,$_POST['instagram']);
                $createdBy                           = $_SESSION['user']['user_id'];



                // logo Image

                $imageDirectory = '../webinty_includes/webinty_uploads/general';
                $logo           = $this->uploadSingleImage('company_logo',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                // Data Array

                $infoData = array(

                    'mobile_1'                         => $mobile1,
                    'mobile_2'                         => $mobile2,
                    'landline_phone_number'            => $landline_phone_number,
                    'sales_phone_number_1'             => $sales_phone_number_1,
                    'sales_phone_number_2'             => $sales_phone_number_2,
                    'sales_phone_number_3'             => $sales_phone_number_3,
                    'technical_support_phone_number_1' => $technical_support_phone_number_1,
                    'technical_support_phone_number_2' => $technical_support_phone_number_2,
                    'call_center_phone_number_1'       => $callcenter_phone_number_1,
                    'call_center_phone_number_2'       => $callcenter_phone_number_2,
                    'hosting_phone_number'             => $hosting_phone_number,
                    'whatsapp_main_number'             => $whatsapp_main_number,
                    'whatsapp_sales_number'            => $whatsapp_sales_number,
                    'email_info'                       => $email_info,
                    'email_sales'                      => $email_sales,
                    'email_marketing'                  => $email_marketing,
                    'email_technical_support'          => $email_technical,
                    'email_call_center'                => $email_callcenter,
                    'public_info_facebook'             => $facebook,
                    'public_info_twitter'              => $twitter,
                    'public_info_linkedin'             => $linkedin,
                    'public_info_googleplus'           => $googleplus,
                    'google_map_iframe'                => $google_map_iframe,
                    'skype'                            => $skype,
                    'blogger'                          => $blogger,
                    'wordpress'                        => $wordpress,
                    'tumblr'                           => $tumblr,
                    'vimeo'                            => $vimeo,
                    'instagram'                        => $instagram,
                    'company_name'                     => $company_name,
                    'company_logo'                     => $logo,
                    'company_address'                  => $company_address,
                    'about_company'                    => $aboutcompany,
                    'date'                             => $date,
                    'created_by'                       => $createdBy

                );




                // Store Data In Database

                if($this->publicInfo->addPublicInfoData($infoData))

                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Informations Inserted</div>';
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Informations Not Inserted</div>';
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

            $pageTitle = "Add General Information";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addPublicInfo.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');

        }

    }







    /*
     * get All Info
     */


    public function getAllInfo()


    {
        $this->checkPermission(4);

        $pageTitle = "All Public Informations";

        $informations = $this->publicInfo->getAllInformatiosData();

        // view Form
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/allPublicInfo.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');

    }




    /*
     * get all informations by id
     */


    public function getInformations()

    {
        $this->checkPermission(4);

        $connection  = $this->publicInfo->connect;

        $pageTitle   = "Public Informations";

        $idFromUrl   = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id          =  mysqli_real_escape_string($connection,$idFromUrl);

        $information = $this->publicInfo->getPublicInfoById($id);

        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($information)>0)
        {
            include (WEBINTY_VIEWS.'/admin/publicInfo.html');
        }
        else

        {
           include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');



    }






    /*
     *  update public Info
     */


    public function updateInfo()

    {
        $this->checkPermission(4);

        if(isset($_POST['company_name']) && isset($_POST['aboutcompany']) && isset($_POST['company_address']))

        {
            $validator = new validation();

            $rules = array(

                'company_name'     => 'required',
                'aboutcompany'     => 'required|min:10',
                'company_address'  => 'required',
                'mobile1'          => 'required',
                'mobile2'          => 'required',
                'email_info'       => 'required|email',
                'email_sales'      => 'required|email',
                'email_marketing'  => 'required|email',
                'email_technical'  => 'required|email',
                'email_callcenter' => 'required|email',
                'facebook'         => 'required',
                'twitter'          => 'required',
                'linkedin'         => 'required',
                'googleplus'       => 'required',
                'skype'            => 'required',
                'blogger'          => 'required',
                'wordpress'        => 'required',
                'tumblr'           => 'required',
                'vimeo'            => 'required',
                'instagram'        => 'required'

            );


            // set validation Rules
            $validator->setRules($rules);

            if($validator->validate())

            {
                // date and time format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                // connection to database to use sql injection
                $connection = $this->publicInfo->connect;

                $company_name                       = mysqli_real_escape_string($connection,$_POST['company_name']);
                $aboutcompany                       = mysqli_real_escape_string($connection,$_POST['aboutcompany']);
                $company_address                    = mysqli_real_escape_string($connection,$_POST['company_address']);
                $mobile1                            = mysqli_real_escape_string($connection,$_POST['mobile1']);
                $mobile2                            = mysqli_real_escape_string($connection,$_POST['mobile2']);
                $landLinePhoneNumber                = mysqli_real_escape_string($connection,$_POST['update_landline_phone_number']);
                $sales_mobile_number_1              = mysqli_real_escape_string($connection,$_POST['update_sales_mobile_number_1']);
                $sales_mobile_number_2              = mysqli_real_escape_string($connection,$_POST['update_sales_mobile_number_2']);
                $sales_mobile_number_3              = mysqli_real_escape_string($connection,$_POST['update_sales_mobile_number_3']);
                $technical_support_mobile_number_1  = mysqli_real_escape_string($connection,$_POST['update_Technical_Support_Mobile_number_1']);
                $technical_support_mobile_number_2  = mysqli_real_escape_string($connection,$_POST['update_Technical_Support_Mobile_number_2']);
                $customer_service_mobile_number_1   = mysqli_real_escape_string($connection,$_POST['update_customer_service_Mobile_number_1']);
                $customer_service_mobile_number_2   = mysqli_real_escape_string($connection,$_POST['update_customer_service_Mobile_number_2']);
                $hosting_service_mobile_number      = mysqli_real_escape_string($connection,$_POST['update_hosting_service_Mobile_number']);
                $whatsapp_main_mobile_number        = mysqli_real_escape_string($connection,$_POST['update_whatsapp_main_mobile_number']);
                $whatsapp_sales_mobile_number       = mysqli_real_escape_string($connection,$_POST['update_whatsapp_sales_mobile_number']);
                $google_map_iframe                  = mysqli_real_escape_string($connection,$_POST['update_google_map_iframe']);
                $email_info                         = mysqli_real_escape_string($connection,$_POST['email_info']);
                $email_sales                        = mysqli_real_escape_string($connection,$_POST['email_sales']);
                $email_marketing                    = mysqli_real_escape_string($connection,$_POST['email_marketing']);
                $email_technical                    = mysqli_real_escape_string($connection,$_POST['email_technical']);
                $email_callcenter                   = mysqli_real_escape_string($connection,$_POST['email_callcenter']);
                $facebook                           = mysqli_real_escape_string($connection,$_POST['facebook']);
                $twitter                            = mysqli_real_escape_string($connection,$_POST['twitter']);
                $linkedin                           = mysqli_real_escape_string($connection,$_POST['linkedin']);
                $googleplus                         = mysqli_real_escape_string($connection,$_POST['googleplus']);
                $skype                              = mysqli_real_escape_string($connection,$_POST['skype']);
                $blogger                            = mysqli_real_escape_string($connection,$_POST['blogger']);
                $wordpress                          = mysqli_real_escape_string($connection,$_POST['wordpress']);
                $tumblr                             = mysqli_real_escape_string($connection,$_POST['tumblr']);
                $vimeo                              = mysqli_real_escape_string($connection,$_POST['vimeo']);
                $instagram                          = mysqli_real_escape_string($connection,$_POST['instagram']);

                $idFromForm        = mysqli_real_escape_string($connection,$_POST['publicInfo_id']);
                $publicInfo        = $this->publicInfo->getPublicInfoById($idFromForm);


                // old logo
                $oldLogo           = $publicInfo['company_logo'];

                // logo image
                $imageDirectory    = '../webinty_includes/webinty_uploads/general';
                $logo              = $this->uploadSingleImage('company_logo',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                // Data Array

                $infoData = array(

                    'mobile_1'                         => $mobile1,
                    'mobile_2'                         => $mobile2,
                    'landline_phone_number'            => $landLinePhoneNumber,
                    'sales_phone_number_1'             => $sales_mobile_number_1,
                    'sales_phone_number_2'             => $sales_mobile_number_2,
                    'sales_phone_number_3'             => $sales_mobile_number_3,
                    'technical_support_phone_number_1' => $technical_support_mobile_number_1,
                    'technical_support_phone_number_2' => $technical_support_mobile_number_2,
                    'call_center_phone_number_1'       => $customer_service_mobile_number_1,
                    'call_center_phone_number_2'       => $customer_service_mobile_number_2,
                    'hosting_phone_number'             => $hosting_service_mobile_number,
                    'whatsapp_main_number'             => $whatsapp_main_mobile_number,
                    'whatsapp_sales_number'            => $whatsapp_sales_mobile_number,
                    'email_info'                       => $email_info,
                    'email_sales'                      => $email_sales,
                    'email_marketing'                  => $email_marketing,
                    'email_technical_support'          => $email_technical,
                    'email_call_center'                => $email_callcenter,
                    'public_info_facebook'             => $facebook,
                    'public_info_twitter'              => $twitter,
                    'public_info_linkedin'             => $linkedin,
                    'public_info_googleplus'           => $googleplus,
                    'google_map_iframe'                => $google_map_iframe,
                    'skype'                            => $skype,
                    'blogger'                          => $blogger,
                    'wordpress'                        => $wordpress,
                    'tumblr'                           => $tumblr,
                    'vimeo'                            => $vimeo,
                    'instagram'                        => $instagram,
                    'company_name'                     => $company_name,
                    'company_address'                  => $company_address,
                    'about_company'                    => $aboutcompany,

                );


                // update logo
                if($logo)

                {
                    $infoData['company_logo'] = $logo;
                }



                // store Data In DataBase

                if(count($publicInfo)>0)

                {
                    if($this->publicInfo->updatePublicInfoData($idFromForm,$infoData))

                    {

                        if($logo)

                        {
                            unlink('../webinty_includes/webinty_uploads/general/'.$oldLogo);
                        }

                        echo '<div class="alert alert-success"> <strong> Success! </strong> Information Updated</div>';
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Information Not Updated</div>';
                    }

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Information</div>';
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

            $pageTitle  = "Update Public Informations";

            $connection = $this->publicInfo->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get information data by id
            $info       = $this->publicInfo->getPublicInfoById($id);


            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($info)>0)
            {
                include (WEBINTY_VIEWS.'/admin/updatePublicInfo.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }

    }








    /*
     * Delete Info
     */


    public function DeleteInfo()

    {
        $this->checkPermission(4);

        $connection = $this->publicInfo->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $info       = $this->publicInfo->getPublicInfoById($id);

        $adminId    = $_SESSION['user']['user_id'];

        if(count($info)>0 && $info['created_by'] == $adminId)

        {
            if($this->publicInfo->deletePublicInfoData($id))

            {
                $logoImage = $info['company_logo'];

                if($logoImage)

                {
                    unlink('../webinty_includes/webinty_uploads/general/'.$logoImage);
                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> Information Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Information Not Deleted</div>';
            }

        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This Information </div>';
        }

    }



}