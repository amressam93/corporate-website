<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 01/08/2017
 * Time: 02:48 م
 */
class webinty_adminClientTicketController extends webinty_adminController

{

    private $clientTicketModel;

    public function __construct(webinty_clientTicketModel $ticket)

    {
        $this->clientTicketModel = $ticket;
    }






    /*
     * add client ticket
     */

    public function addClientTicket()

    {
        $this->checkPermission(4);

        if(isset($_POST['clientName']) && isset($_POST['clientPhoneNumber']) && isset($_POST['clientServiceType']) && isset($_POST['clientCity']) && isset($_POST['clientAddress']) && isset($_POST['clientStatus']))

        {
            $validator = new validation();

            $rules     = array(

                'clientName'        => 'required',
                'clientPhoneNumber' => 'required',
                'clientServiceType' => 'required',
                'clientCity'        => 'required',
                'clientStatus'      => 'required'
            );


            // set validation Rules
            $validator->setRules($rules);


            // check Data
            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection                        = $this->clientTicketModel->connect;
                $clientName                        = mysqli_real_escape_string($connection,$_POST['clientName']);
                $clientPhoneNumber                 = mysqli_real_escape_string($connection,$_POST['clientPhoneNumber']);
                $newClientPhoneNumberAfterUpdate   = '_'.$clientPhoneNumber;
                $clientEmailAddress                = mysqli_real_escape_string($connection,$_POST['clientEmailAddress']);
                $clientCompanyName                 = mysqli_real_escape_string($connection,$_POST['clientCompanyName']);
                $clientServiceType                 = mysqli_real_escape_string($connection,$_POST['clientServiceType']);
                $clientOffer                       = mysqli_real_escape_string($connection,$_POST['clientOffer']);
                $clientCity                        = mysqli_real_escape_string($connection,$_POST['clientCity']);
                $clientAddress                     = mysqli_real_escape_string($connection,$_POST['clientAddress']);
                $clientStatus                      = mysqli_real_escape_string($connection,$_POST['clientStatus']);
                $createdBy                         = $_SESSION['user']['user_id'];


                $clientTicketData = array(

                    'client_name'         => $clientName,
                    'client_mobile'       => $newClientPhoneNumberAfterUpdate,
                    'client_email'        => $clientEmailAddress,
                    'client_company_name' => $clientCompanyName,
                    'client_service_type' => $clientServiceType,
                    'client_offer'        => $clientOffer,
                    'client_city'         => $clientCity,
                    'client_address'      => $clientAddress,
                    'client_status'       => $clientStatus,
                    'created_by'          => $createdBy,
                    'created_at'          => $date
                );


                // check is Exists
                $clientTicketArray = $this->clientTicketModel->getAllClients();

                if($this->checkIsExists($clientTicketArray,'client_mobile',$newClientPhoneNumberAfterUpdate))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> this Client is Already Exists</div>';
                    exit;
                }


                // store data in data base
                if($this->clientTicketModel->addClient($clientTicketData))

                {
                    $clientTicketId = $this->clientTicketModel->idInserted();

                    echo '<div class="alert alert-success"> <strong> Success! </strong> Ticket Inserted</div>';
                    echo "<meta http-equiv='refresh' content='2;URL=\"ticket.php?id=".$clientTicketId."\"' />";
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Ticket Not Inserted</div>';
                }

            }

            else

            {
                $validationErrors = $validator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }




        }

        else

        {
            $pageTitle = "Add Client Ticket";

            //display view
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addClientTicket.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }






    /*
     * get all Client Tickets
     */

    public function getAllClientTickets()

    {
        $this->checkPermission(4);
        $pageTitle = "All Client Tickets";

        // model data
        $tickets = $this->clientTicketModel->getAllClients();

        // get user by id (created_by)
        $usersModel = new webinty_usersModel();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/clientTickets.html');


    }





    /*
     * get client ticket By Id
     */


    public function getClientTicketById()

    {
        $this->checkPermission(4);
        $connection = $this->clientTicketModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $ticket     = $this->clientTicketModel->getClient($id);
        $pageTitle  = "Client Ticket Information ".' - '.$ticket['client_name'];


        // get user by id (created_by)
        $usersModel = new webinty_usersModel();


        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($ticket)>0)
        {
            // get all notes By client Ticket Id
            $ticketBy_id      = $ticket['client_id'];

            $clientNotesModel = new webinty_clientNotesModel();
            $notes            = $clientNotesModel->getNotesByClientTicket($ticketBy_id);

            // number Of Notes of client ticket
            $numberOfTicket = $clientNotesModel->getNumberOfNotesClient($ticketBy_id);

            include (WEBINTY_VIEWS.'/admin/ticket.html');
        }

        else

        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');
    }





    /*
     * update client ticket
     */

    public function updateClientTicket()

    {
        $this->checkPermission(4);

        if(isset($_POST['clientName']) && isset($_POST['clientPhoneNumber']) && isset($_POST['clientServiceType']) && isset($_POST['clientCity']) && isset($_POST['clientAddress']) && isset($_POST['clientStatus']))

        {

            $validator = new validation();

            $rules     = array(

                'clientName'        => 'required',
                'clientPhoneNumber' => 'required',
                'clientServiceType' => 'required',
                'clientCity'        => 'required',
                'clientStatus'      => 'required'
            );


            // set validation Rules
            $validator->setRules($rules);

            // check data
            if($validator->validate())

            {

                $connection                        = $this->clientTicketModel->connect;
                $clientName                        = mysqli_real_escape_string($connection,$_POST['clientName']);
                $clientPhoneNumber                 = mysqli_real_escape_string($connection,$_POST['clientPhoneNumber']);
                $newClientPhoneNumberAfterUpdate   = '_'.$clientPhoneNumber;
                $clientEmailAddress                = mysqli_real_escape_string($connection,$_POST['clientEmailAddress']);
                $clientCompanyName                 = mysqli_real_escape_string($connection,$_POST['clientCompanyName']);
                $clientServiceType                 = mysqli_real_escape_string($connection,$_POST['clientServiceType']);
                $clientOffer                       = mysqli_real_escape_string($connection,$_POST['clientOffer']);
                $clientCity                        = mysqli_real_escape_string($connection,$_POST['clientCity']);
                $clientAddress                     = mysqli_real_escape_string($connection,$_POST['clientAddress']);
                $clientStatus                      = mysqli_real_escape_string($connection,$_POST['clientStatus']);


                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['clientTicketID']);

                // client Ticket Data By Id From Form
                $ticketInfo        = $this->clientTicketModel->getClient($idFromForm);

                // admin id
                $adminId        = $_SESSION['user']['user_id'];


                $clientTicketData = array(

                    'client_name'         => $clientName,
                    'client_mobile'       => $newClientPhoneNumberAfterUpdate,
                    'client_email'        => $clientEmailAddress,
                    'client_company_name' => $clientCompanyName,
                    'client_service_type' => $clientServiceType,
                    'client_offer'        => $clientOffer,
                    'client_city'         => $clientCity,
                    'client_address'      => $clientAddress,
                    'client_status'       => $clientStatus
                );

                if(count($ticketInfo)>0 AND $ticketInfo['created_by'] == $adminId)

                {
                    if($this->clientTicketModel->updateClientInfo($idFromForm,$clientTicketData))

                    {
                        echo '<div class="alert alert-success"> <strong> Success </strong> Ticket Updated</div>';
                        echo "<meta http-equiv='refresh' content='2;URL=\"ticket.php?id=".$idFromForm."\"' />";
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Ticket Not Updated</div>';
                    }

                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Client Ticket</div>';
                }


            }

            else
            {
                $validationErrors = $validator->getErrors();
                include (WEBINTY_VIEWS.'/admin/resultMessages.html');
            }

        }

        else
        {
            $connection = $this->clientTicketModel->connect;
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Client Ticket Data By id
            $ticket    = $this->clientTicketModel->getClient($id);

            // -2 get SESSION Of User Id
            $adminId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = "Client Ticket Information ".' - '.$ticket['client_name'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($ticket)>0 AND $ticket['created_by'] == $adminId)

            {
                include (WEBINTY_VIEWS.'/admin/updateClientTicket.html');
            }

            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }

    }





    /*
     *  Delete Client Ticket
     */


    public function DeleteClientTicket()

    {
        $this->checkPermission(4);
        $connection = $this->clientTicketModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $ticket = $this->clientTicketModel->getClient($id);

        $adminId    = $_SESSION['user']['user_id'];

        if(count($ticket)>0 AND $ticket['created_by'] == $adminId)

        {
            if($this->clientTicketModel->deleteClient($id))

            {
                echo '<div class="alert alert-success"> <strong> Success </strong> Client Ticket Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Client Ticket Not Deleted</div>';
            }
        }

        else

        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That subject </div>';
        }



    }





}