<?php


class webinty_teamWorkModel
{


    public $connect;


    /**
     * connection To db.
     * webinty_teamWorkModel constructor.
     */
    public function __construct()

    {
        $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }








    /**
     * Add New Member.
     *
     * @param $MemberData
     * @return bool
     */
    public function addMember($MemberData)
    {
        if(webinty_system::Get('database')->Insert('team_work',$MemberData))

            return true;

        return false;
    }








    /**
     * Update Mmeber Data.
     *
     * @param $id
     * @param $MemberData
     * @return bool
     */
    public function updateMemberData($id, $MemberData)
    {
        if(webinty_system::Get('database')->Update('team_work',$MemberData,"WHERE `team_work`.`member_id` = $id"))

            return true;

        return false;
    }






    /**
     * Delete Member.
     * @param $id
     * @return bool
     */
    public function DeleteMember($id)
    {
        if(webinty_system::Get('database')->Delete('team_work',"WHERE `team_work`.`member_id` = $id"))

            return true;

        return false;

    }


    /**
     * Get All Members.
     *
     * @param string $extra
     * @return array
     */
    public function getAllMembers($extra = '')
    {
        webinty_system::Get('database')->Execute(" SELECT `team_work`.*,`team_work_sections`.`section_id`,`team_work_sections`.`section_name`,`users`.* FROM `team_work` LEFT JOIN `team_work_sections` ON `team_work`.`member_section` = `team_work_sections`.`section_id` LEFT JOIN `users` ON `team_work`.`created_by` = `users`.`user_id` $extra");

        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }





    /**
     * Get All Members Descending.
     * @return array
     */
    public function getAllMembersDescending()
    {
        return $this->getAllMembers("ORDER BY `team_work`.`member_id` DESC");
    }





    /**
     * Get Member By Id.
     *
     * @param $id
     * @return array|mixed
     */
    public function getMemberById($id)
    {
        $Members = $this->getAllMembers("WHERE `team_work`.`member_id` = $id");

        if(count($Members)>0)

            return $Members[0];

        return [];

    }


    /**
     * Get Number of Members.
     *
     * @return mixed
     */
    public function getNumberOfMembers()
    {
        $NumberOfMembers = webinty_system::Get('database')->Select_Count('team_work');

        return $NumberOfMembers;
    }







    /**
     * Get Number Of Members By Section.
     *
     * @param $sectionId
     * @return mixed
     */
    public function getNumberOfMembersBySectionId($sectionId)
    {
        $NumbersOfMemberBySection = webinty_system::Get('database')->Select_Count('team_work',"where `team_work`.`member_section` = $sectionId");

        return $NumbersOfMemberBySection;

    }





    /**
     * Get Members By Section
     *
     * @param $sectionId
     * @return array
     */
    public function getMembersBySection($sectionId)
    {
        return $this->getAllMembers("WHERE `team_work`.`member_section` = $sectionId");
    }





}