<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/05/2017
 * Time: 07:41 م
 */

class webinty_controller


{


    /*
     * check permission
     */


    public function checkPermission($userGroup)

    {
        if(isset($_SESSION['user']))

        {

            if($_SESSION['user']['user_group']!=$userGroup)

            {
                if($_SESSION['user']['user_group']==4)

                {
                    $redirectUrl = WEBINTY_PATH.'admin_dashboard/index.php';
                    header("location:$redirectUrl");
                }



                if($_SESSION['user']['user_group']==5)

                {
                    $redirectUrl = WEBINTY_PATH.'admin_dashboard/Error404.php';
                    header("location:$redirectUrl");
                }



                if($_SESSION['user']['user_group']==6)

                {
                    $redirectUrl = WEBINTY_PATH.'admin_dashboard/Error404.php';
                    header("location:$redirectUrl");
                }


            }


        }

        else

        {
            $redirectUrl = WEBINTY_AR_PATH.'login/';
            header("location:$redirectUrl");
        }


    }





    /*
     * check is exists
     */


    public function checkIsExists($products, $field, $value)
    {
        foreach($products as $key => $product)
        {
            if ( $product[$field] === $value )
                return true;

        }
        return false;
    }



    /*
     * upload single image
     */

    public function uploadSingleImage($inputName,$directory,$mimeTypes=[])

    {

        $name = $_FILES[$inputName]['name'];
        $size = $_FILES[$inputName]['size'];
        $temp = $_FILES[$inputName]['tmp_name'];
        $type = $_FILES[$inputName]['type'];
        $error = $_FILES[$inputName]['error'];

        if(count($mimeTypes)>0)

        {
            if(in_array($type,$mimeTypes) && $error == 0)

            {
                // -1 rename
                $newName = md5(date('U')).'_'.$name;

                // - 2 move
                if(move_uploaded_file($temp,$directory.'/'.$newName))

                {
                    // return new name
                    return $newName;
                }

            }

        }


        return null;


    }






    /*
     * multi upload images
     */


    public function uploadMultiImages($inputName,$directory,$mimeTypes=[])

    {
        $output = array();

        foreach ($_FILES[$inputName]['name']as $key=>$val)

        {
            $name = $_FILES[$inputName]['name'][$key];
            $size = $_FILES[$inputName]['size'][$key];
            $temp = $_FILES[$inputName]['tmp_name'][$key];
            $type = $_FILES[$inputName]['type'][$key];
            $error = $_FILES[$inputName]['error'][$key];

            if(count($mimeTypes)>0)

            {
                if(in_array($type,$mimeTypes) && $error == 0)

                {

                    // -1 rename
                    $newName = md5(date('U')).'_'.$name;


                    // - 2 move upload

                    if(move_uploaded_file($temp,$directory.'/'.iconv("utf-8", "cp1256",$newName)))

                    {
                        $output[] = $newName;
                    }

                }



            }

        }


        return $output;

    }








}