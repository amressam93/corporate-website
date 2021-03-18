<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 07:28 م
 */
class webinty_clientNotesModel extends webinty_model

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
     * add note
     */

    public function addNote($noteData)

    {
        if(webinty_system::Get('database')->Insert('client_notes',$noteData))

            return true;

        return false;

    }




    /*
     * update note
     */

    public function updateNote($id,$noteData)

    {
        if(webinty_system::Get('database')->Update('client_notes',$noteData,"WHERE `client_notes`.`note_id` = $id"))

            return true;

        return false;
    }



    /*
     * delete note
     */

    public function deleteNote($id)

    {

        if(webinty_system::Get('database')->Delete('client_notes',"WHERE `client_notes`.`note_id` = $id"))

            return true;

        return false;
    }



    /*
     * get All notes
     */

    public function getAllNotes($extra = '')

    {
        webinty_system::Get('database')->Execute("SELECT `client_notes`.*,`client_ticket`.`client_name`,`client_ticket`.`client_mobile`,`client_ticket`.`client_email`,`client_ticket`.`client_company_name`,`client_ticket`.`client_service_type`,`client_ticket`.`client_offer`,`client_ticket`.`client_city`,`client_ticket`.`client_address` FROM `client_notes` LEFT JOIN `client_ticket` ON `client_notes`.`note_client_ticket` = `client_ticket`.`client_id` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }



    /*
     *  get note
     */

    public function getNote($noteID)

    {
        $notes = $this->getAllNotes("WHERE `client_notes`.`note_id` = $noteID");

        if(count($notes)>0)

            return $notes[0];

        return [];
    }




    /*
     *  get Notes By Client Ticket
     */


    public function getNotesByClientTicket($clientID)

    {

        return $this->getAllNotes("WHERE `client_notes`.`note_client_ticket` = $clientID");
    }





    /*
     *  get user notes
     */


    public function getNotesByUser($clientID,$userID)

    {
        return $this->getAllNotes("WHERE `client_notes`.`note_client_ticket` = $clientID AND `client_notes`.`created_by` = $userID");
    }



    /*
     * get Numbers Of client Notes
     */


    public function getNumberOfNotesClient($clientID)

    {
        $Notes = webinty_system::Get('database')->Select_Count('client_notes',"where `client_notes`.`note_client_ticket` = $clientID");

        return $Notes;
    }



}