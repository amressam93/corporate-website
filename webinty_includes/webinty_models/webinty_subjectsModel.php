<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 07/05/2017
 * Time: 10:38 م
 */
class webinty_subjectsModel extends webinty_model


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
     * add new subject
     */

    public function addSubject($subjectData)

    {
        if(webinty_system::Get('database')->Insert('subjects',$subjectData))

            return true;

        return false;
    }




    /*
     * update Subject
     */

    public function updateSubject($id,$subjectData)

    {

        if(webinty_system::Get('database')->Update('subjects',$subjectData,"WHERE `subjects`.`subject_id` = $id"))

            return true;

        return false;
    }





    /*
     *  delete subject
     */


    public function deleteSubject($id)

    {
        if(webinty_system::Get('database')->Delete('subjects',"WHERE `subjects`.`subject_id` = $id"))

            return true;

        return false;

    }




    /*
     * Get all subjects
     */

    public function getSubjects($extra = '')

    {

        webinty_system::Get('database')->Execute("SELECT `subjects`.*,`subjects_categories`.`category_name`,`users`.* FROM `subjects` LEFT JOIN `subjects_categories` ON `subjects`.`subject_category` = `subjects_categories`.`category_id` LEFT JOIN `users` ON `subjects`.`created_by` = `users`.`user_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];

    }





    /*
     *  get subject By ID
     */

    public function getSubject($id)

    {


        $subjects =  $this->getSubjects("WHERE `subjects`.`subject_id` = $id");

        if(count($subjects)>0)

            return $subjects[0];

        return [];

    }





    /*
     * get subjects by category
     */

    public function getSubjectsByCategory($categoryId)

    {
        return $this->getSubjects("WHERE `subjects`.`subject_category` = $categoryId");
    }



}