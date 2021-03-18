<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/05/2017
 * Time: 04:48 م
 */
class webinty_articleViewsModel extends webinty_model


{

    private $connection;

    /*
     * connection to db
     */


    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }





      /*
       * view handling
       */

    public function viewHandling($ip,$view_article)

    {

        // check if this ip exits in out Data

        $sql = "SELECT `article_views`.`ip` FROM `article_views` WHERE `article_views`.`ip` = '$ip' AND `article_views`.`view_article` = $view_article";

        $check = $this->connection->query($sql);

        $checkIp = $check->num_rows;


        if($checkIp == 0)

        {

            $query = "INSERT INTO `article_views`(`ip`, `view_article`) VALUES ('$ip',$view_article)";

            $insertIP = $this->connection->query($query);
        }


        $number = $this->connection->query("SELECT `article_views`.*,`articles`.* FROM `article_views` LEFT JOIN `articles` ON `article_views`.`view_article` = `articles`.`article_id` WHERE `article_views`.`view_article` = $view_article ");

        $visitors = $number->num_rows;

        echo $visitors;

    }


}