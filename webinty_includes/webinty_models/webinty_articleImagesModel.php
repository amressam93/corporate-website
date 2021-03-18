<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/05/2017
 * Time: 04:13 م
 */


class webinty_articleImagesModel extends webinty_model


{


    public $connect;

    /*
     * connection to db
     */


    public function __construct()

    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }







    /*
     *  add article image
     */

    public function addImage($imageData)

    {

        if(webinty_system::Get('database')->Insert('article_images',$imageData))

            return true;

        return false;
    }






    /*
     * delete article image
     */

    public function deleteImage($imageID)


    {
        if(webinty_system::Get('database')->Delete('article_images',"WHERE `article_images`.`image_id` = $imageID"))

            return true;

        return false;
    }






    /*
     * get all article images
     */

    public function getAllImages($extra = '')


    {
        webinty_system::Get('database')->Execute("SELECT `article_images`.*,`articles`.* FROM `article_images` LEFT JOIN `articles` ON `article_images`.`image_article` = `articles`.`article_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }





   /*
    * get image by id
    */

    public function getImage($imageID)


    {
        $images = $this->getAllImages("WHERE `article_images`.`image_id` = $imageID");

        if (count($images)>0)

            return $images[0];

        return [];
    }





    /*
     *  get images By Article
     */

    public function getImagesByArticleId($articleID,$extra = '')

    {
        return $this->getAllImages("WHERE `article_images`.`image_article` = $articleID $extra");
    }






    /*
     * get Number Of Images
     */

    public function getNumberOfImages($articleID)


    {
        $imagesNumber = webinty_system::Get('database')->Select_Count('article_images',"where `article_images`.`image_article` = $articleID");

        return $imagesNumber;
    }



}