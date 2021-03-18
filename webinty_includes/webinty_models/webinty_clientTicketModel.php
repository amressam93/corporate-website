<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 07:12 م
 */
class webinty_clientTicketModel extends  webinty_model

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
     * add client ticket
     */

    public function addClient($clientData)

    {
        if(webinty_system::Get('database')->Insert('client_ticket',$clientData))

            return true;

        return false;
    }






    /*
     * update client ticket
     */

    public function updateClientInfo($id,$clientData)

    {
        if(webinty_system::Get('database')->Update('client_ticket',$clientData,"WHERE `client_ticket`.`client_id` = $id"))

            return true;

        return false;
    }






    /*
     * Delete client ticket
     */


    public function deleteClient($id)

    {
        if(webinty_system::Get('database')->Delete('client_ticket',"WHERE `client_ticket`.`client_id` = $id"))

            return true;

        return false;
    }





    /*
     * get All client tickets
     */


    public function getAllClients($extra='')

    {
        webinty_system::Get('database')->Execute("SELECT * FROM `client_ticket` $extra");
        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }






    /*
     * get client By ID
     */


    public function getClient($clientID)

    {
        $clients = $this->getAllClients("WHERE `client_ticket`.`client_id` = $clientID");

        if(count($clients)>0)

            return $clients[0];

        return [];
    }






    /*
     * search client
     */

    public function searchClient($keyword)

    {
        return $this->getAllClients("WHERE `client_ticket`.`client_name` LIKE '%$keyword%' OR `client_ticket`.`client_mobile` LIKE '%$keyword%' OR `client_ticket`.`client_email` LIKE '%$keyword%'");
    }


}