<?php


class webinty_teamWorkSectionsModel extends webinty_model
{

    public $connect;


    /**
     * webinty_teamWorkSectionsModel constructor.
     * connection to db
     */
    public function __construct()
    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }


    /**
     * add  new TeamWork Section.
     * @param $teamWorkSectionData
     * @return bool
     */
    public function addTeamWorkSection($teamWorkSectionData)
    {
       if( webinty_system::Get('database')->Insert('team_work_sections',$teamWorkSectionData))

           return true;

       return false;
    }


    /**
     * update TeamWork Section.
     * @param $id
     * @param $teamWorkSectionData
     * @return bool
     */
    public function updateTeamWorkSection($id, $teamWorkSectionData)
    {
        if(webinty_system::Get('database')->Update('team_work_sections',$teamWorkSectionData,"WHERE `team_work_sections`.`section_id` = $id"))

            return true;

        return false;
    }





    /**
     * Delete TeamWork Section
     * @param $id
     * @return bool
     */
    public function deleteTeamWorkSection($id)
    {
       if( webinty_system::Get('database')->Delete('team_work_sections',"WHERE `team_work_sections`.`section_id` = $id"))

           return true;

       return false;
    }


    /**
     * Get all TeamWork Sections.
     * @param string $extra
     * @return array
     */
    public function getAllSections($extra = '')
    {
        webinty_system::Get('database')->Execute("SELECT `team_work_sections`.*,`users`.* FROM `team_work_sections` LEFT JOIN `users` ON `team_work_sections`.`created_by` = `users`.`user_id` $extra");

        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }








    /**
     * Get Section by Id.
     * @param $id
     * @return array|mixed
     */
    public function getSection($id)
    {
        $sections = $this->getAllSections("WHERE `team_work_sections`.`section_id` = $id");

        if(count($sections)>0)

            return $sections[0];

        return [];
    }










    /**
     * Get Number of sections.
     * @return mixed
     */
    public function getNumberOfSections()
    {
        $NumberOfSections = webinty_system::Get('database')->Select_Count('team_work_sections');
        return $NumberOfSections;
    }


}