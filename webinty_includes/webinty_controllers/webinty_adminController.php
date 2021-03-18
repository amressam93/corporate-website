<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/05/2017
 * Time: 08:56 م
 */
class webinty_adminController extends webinty_controller


{

    /*
     * admin index
     */

    public function index()

    {

        $this->checkPermission(4);

        $pageTitle = "Admin | Dashboard";

       include (WEBINTY_VIEWS.'/admin/header.html');
       include (WEBINTY_VIEWS.'/admin/menu.html');
       include (WEBINTY_VIEWS.'/admin/nav.html');
       include (WEBINTY_VIEWS.'/admin/index.html');
       include (WEBINTY_VIEWS.'/admin/footer.html');
    }




    /*
     * Error 404 page
     */


    public function Error404()

    {
        $pageTitle = "Webinty | ErrorPage";

       // include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/404.html');
    }





    /** Get Page Title
     * @param $array
     * @param $arrayIndexName
     * @param $nameOfPage
     * @param $faildMessage
     * @return string
     */
    public function getPageTitle($array, $arrayIndexName, $nameOfPage, $faildMessage)
    {
        if (count($array)>0)
        {
            return  $array[$arrayIndexName].' | '.$nameOfPage;
        }
        else
        {
            return  $faildMessage;
        }


    }




}