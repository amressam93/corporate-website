<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/05/2017
 * Time: 05:07 م
 */
class webinty_articlesModel extends webinty_model

{


    // id after Insert

    public function idInserted()

    {
        return webinty_system::Get('database')->idAfterInsert();
    }



    public $connect;

    /*
     * connection to db
     */


    public function __construct()

    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }




    /*
     *  add article
     */

    public function addArticle($articleData)

    {

        if(webinty_system::Get('database')->Insert('articles',$articleData))

            return true;

        return false;

    }




    /*
     *  get all articles
     */

    public function getArticles($extra = '')

    {

        webinty_system::Get('database')->Execute("SELECT `articles`.*,`subjects`.*,`users`.* FROM `articles`LEFT JOIN `subjects` ON `articles`.`article_subject` = `subjects`.`subject_id` LEFT JOIN `users` ON `articles`.`article_created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];

    }







    /*
     *  get article By ID
     */

    public function getArticle($id)

    {

        $articles =  $this->getArticles("WHERE `articles`.`article_id` = $id");

        if(count($articles)>0)

            return $articles[0];

        return [];

    }




    /*
    *  get articles By subject ID
    */

    public function getArticlesBySubjectId($subjectId,$extra='')

    {
        return $this->getArticles("WHERE `articles`.`article_subject` = $subjectId $extra");
    }








    /*
     * get random articles by subject Id
     */


    public function getRandomArticlesBySubjectId($subjectId,$extra='')

    {
        return $this->getArticles("WHERE `articles`.`article_subject` = $subjectId $extra");
    }




    /*
     * get articles By user id
     */


    public function getArticlesByUserId($userID,$extra='')

    {

        return $this->getArticles("WHERE `articles`.`created_by` = $userID $extra");

    }






    /*
     * get articles By subject category id
     */


    public function getArticlesBySubjectCategoryId($subjectCategoryID)

    {
        return $this->getArticles("WHERE `subjects`.`subject_category` = $subjectCategoryID");
    }






    /*
     *  update article
     */

    public function updateArticle($id,$articleData)

    {
        if(webinty_system::Get('database')->Update('articles',$articleData,"WHERE `articles`.`article_id` = $id"))

            return true;

        return false;

    }



    /*
     *  delete article
     */

    public function deleteArticle($id)

    {

        if(webinty_system::Get('database')->Delete('articles',"WHERE `articles`.`article_id` = $id"))

            return true;

        return false;
    }




    /*
     * search of articles
     */

    public function searchArticle($keyword)

    {

        return $this->getArticles("WHERE `articles`.`article_title` LIKE '%$keyword%' OR `articles`.`article_description` LIKE '%$keyword%'");
    }




    /*
     *  get Numbers Of Articles
     */


    public function getNumberOfArticles($subjectID)

    {

        $ArticleNumber = webinty_system::Get('database')->Select_Count('articles',"where `articles`.`article_subject` = $subjectID");

        return $ArticleNumber;

    }

}