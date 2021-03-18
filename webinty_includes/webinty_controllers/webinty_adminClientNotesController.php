<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/08/2017
 * Time: 11:45 م
 */
class webinty_adminClientNotesController extends webinty_adminController

{

    private $clientNotesModel;

    public function __construct(webinty_clientNotesModel $note)

    {
        $this->clientNotesModel = $note;
    }




    /*
     * add client note
     */

    public function addNote()

    {
        $this->checkPermission(4);

        if(isset($_POST['clientNote']))

        {
            $validator = new validation();

            $rules = array(

                'clientNote'  => 'required'
            );

            // set Validation Rules
            $validator->setRules($rules);


            if($validator->validate())

            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                $connection             = $this->clientNotesModel->connect;
                $clientNote             = mysqli_real_escape_string($connection,$_POST['clientNote']);
                $clientTicketIdFromForm = mysqli_real_escape_string($connection,$_POST['clienTicketID']);
                $createdBy              = $_SESSION['user']['user_id'];


                // get client ticket by id
                $ticketsModelData     = new webinty_clientTicketModel();
                $ticketById           = $ticketsModelData->getClient($clientTicketIdFromForm);

                $idOfTicket           = $ticketById['client_id'];



                // data
                $clientNoteData = array(

                    'note_description'   => $clientNote,
                    'note_client_ticket' => $idOfTicket,
                    'created_by'         => $createdBy,
                    'created_at'         => $date
                );

                // store data in data base

                if(count($ticketById)>0)

                {
                    if($this->clientNotesModel->addNote($clientNoteData))

                    {
                        echo '<div class="alert alert-success"> <strong> Success </strong> Note Inserted</div>';
                        echo "<meta http-equiv='refresh' content='2;URL=\"ticket.php?id=".$idOfTicket."\"' />";
                    }

                    else

                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> Note Not Inserted</div>';
                    }
                }

                else

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Add This Note Because This Note Not Found</div>';
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

            $connection       = $this->clientNotesModel->connect;
            $idFromUrl        = (isset($_GET['ticket']))? (int)$_GET['ticket']:0;
            $ticketId         = mysqli_real_escape_string($connection,$idFromUrl);

            $ticketsModel     = new webinty_clientTicketModel();
            $ticket           = $ticketsModel->getClient($ticketId);


            $pageTitle = "Add Note".' - '.'Client Ticket Name: '.$ticket['client_name'];

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            if(count($ticket)>0)
            {
                include (WEBINTY_VIEWS.'/admin/addClientNote.html');
            }
            else

            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');


        }
    }







    /*
     *  get All Notes By Client Ticket Id
     */


    public function allNotesByClientTicketId()

    {
        $this->checkPermission(4);
        $connection = $this->clientNotesModel->connect;
        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $ticketId   = mysqli_real_escape_string($connection,$idFromUrl);

        // client ticket Model Data
        $clientTicketModelData = new webinty_clientTicketModel();
        $ticket                = $clientTicketModelData->getClient($ticketId);


        // users Model Data
        $usersModel = new webinty_usersModel();

        // get all notes by ticket id
        $notes                 = $this->clientNotesModel->getNotesByClientTicket($ticketId);

        $pageTitle             = 'Client Ticket Notes - '.$ticket['client_name'];

        $numberOf_Notes        = $this->clientNotesModel->getNumberOfNotesClient($ticketId);

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($ticket)>0)
        {
            include (WEBINTY_VIEWS.'/admin/notes.html');
        }
        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }
        include (WEBINTY_VIEWS.'/admin/footer.html');

    }








    /*
     *  Delete Note By Id
     */


    public function deleteNote()

    {
        $this->checkPermission(4);
        $connection = $this->clientNotesModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;
        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $note       = $this->clientNotesModel->getNote($id);
        $adminId    = $_SESSION['user']['user_id'];


        if(count($note)>0 AND $note['created_by'] == $adminId)

        {
            if($this->clientNotesModel->deleteNote($id))

            {
                echo '<div class="alert alert-success"> <strong> Success </strong> Note Deleted</div>';
            }

            else

            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Note Not Deleted</div>';
            }

        }

        else
        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete This Note </div>';
        }

    }


}