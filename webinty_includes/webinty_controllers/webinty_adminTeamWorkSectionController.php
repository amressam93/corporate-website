<?php


class webinty_adminTeamWorkSectionController extends webinty_adminController
{


    /**
     * @var webinty_teamWorkSectionsModel
     */
    private $teamWorkSectionModel;




    /**
     * webinty_adminTeamWorkSectionController constructor.
     * @param webinty_teamWorkSectionsModel $section
     */

    public function __construct(webinty_teamWorkSectionsModel $section)
    {
        $this->teamWorkSectionModel = $section;
    }







    /**
     * Add TeamWork Section
     */
    public function addTeamWorkSection()
    {
        $this->checkPermission(4);

        if(isset($_POST['teamwork_section_name']))
        {
            $validator = new validation();

            $rules = array
            (
                'teamwork_section_name' => 'required'
            );

            // set validation rules.
            $validator->setRules($rules);

            // check Data
            if($validator->validate())
            {
                //  date and time format
                date_default_timezone_set("Africa/Cairo");
                $date = date("d-m-Y");

                $connection = $this->teamWorkSectionModel->connect;
                $teamWorkSectionName = mysqli_real_escape_string($connection,$_POST['teamwork_section_name']);
                $createdBy             = $_SESSION['user']['user_id'];

                //data
                $teamWorkSectionData = array(
                    'section_name' => $teamWorkSectionName,
                    'created_at'   => $date,
                    'created_by'   => $createdBy
                );


                // check is Exists
                $teamWorkSectionArray = $this->teamWorkSectionModel->getAllSections();

                if($this->checkIsExists($teamWorkSectionArray,'section_name',$teamWorkSectionName))
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> TeamWork Section Name is Already Exists</div>';
                    exit;
                }



                // store Data Into Database
                if($this->teamWorkSectionModel->addTeamWorkSection($teamWorkSectionData))
                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> TeamWork Section Inserted Successfully</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> TeamWork Section Not Inserted</div>';
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
            $pageTitle = "Add TeamWork Section Name";

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addTeamWorkSection.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }

    }







    /**
     * Get All TeamWork Sections.
     */
    public function getAllTeamWorkSection()
    {
        $this->checkPermission(4);

        $pageTitle = "All TeamWork Sections";

        // model
        $sections  = $this->teamWorkSectionModel->getAllSections();

        // Number Of Sections
        $NumberOfSection = $this->teamWorkSectionModel->getNumberOfSections();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/TeamWorkSections.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');
    }







    /**
     * Get TeamWork Section By ID.
     */
    public function getTeamWorkSectionById()
    {
        $this->checkPermission(4);

        $connection = $this->teamWorkSectionModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $section    = $this->teamWorkSectionModel->getSection($id);

        $pageTitle  = $section['section_name'].' - Section';

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        if(count($section)>0)
        {
            include (WEBINTY_VIEWS.'/admin/TeamWorkSection.html');
        }
        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');

    }







    /**
     * Update TeamWork Section.
     */
    public function updateTeamWorkSection()

    {
        $this->checkPermission(4);

        if(isset($_POST['Update_teamwork_section_name']))
        {
            $validator = new validation();


            $rules = array
            (
                'Update_teamwork_section_name' => 'required'
            );



            // set validation rules
            $validator->setRules($rules);


            // check data

            if($validator->validate())
            {
                //  date and time format
                date_default_timezone_set("Africa/Cairo");
                $date = date("d-m-Y");

                $connection = $this->teamWorkSectionModel->connect;
                $teamWorkSectionName = mysqli_real_escape_string($connection,$_POST['Update_teamwork_section_name']);

                // id From Form
                $idFromForm         = mysqli_real_escape_string($connection,$_POST['teamwork_section_id']);

                $TeamWorkSectionDataById = $this->teamWorkSectionModel->getSection($idFromForm);

                $userId = $_SESSION['user']['user_id'];


                // Data
                $teamWorkSectionData = array(
                    'section_name' => $teamWorkSectionName
                );


                // check is Exists
                $teamWorkSectionArray = $this->teamWorkSectionModel->getAllSections();

                if($this->checkIsExists($teamWorkSectionArray,'section_name',$teamWorkSectionName))
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> TeamWork Section Name is Already Exists</div>';
                    exit;
                }


                // store data in dataBase After Update
                if(count($TeamWorkSectionDataById)>0 AND $TeamWorkSectionDataById['created_by'] == $userId)
                {
                    if($this->teamWorkSectionModel->updateTeamWorkSection($idFromForm,$teamWorkSectionData))
                    {
                        echo '<div class="alert alert-success"> <strong> Success! </strong> TeamWork Section Updated Successfully</div>';

                        echo "<meta http-equiv='refresh' content='2;URL=\"TeamWorkSection.php?id=".$idFromForm."\"' />";
                    }
                    else
                    {
                        echo '<div class="alert alert-danger"> <strong> Error! </strong> TeamWork Not Updated</div>';
                    }


                }
                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Section..</div>';
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
            $connection = $this->teamWorkSectionModel->connect;

            // id from url
            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get section data by id
            $section = $this->teamWorkSectionModel->getSection($id);


            // get Session of user id
            $userId = $_SESSION['user']['user_id'];

            // page Title
            $pageTitle  = $section['section_name'].' - Section';

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($section)>0 AND $section['created_by'] == $userId)
            {
                include (WEBINTY_VIEWS.'/admin/UpdateTeamWorkSection.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }



    }







    /**
     * Delete TeamWork Section
     */
    public function DeleteTeamWorkSection()
    {
        $this->checkPermission(4);

        $connection = $this->teamWorkSectionModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $section    = $this->teamWorkSectionModel->getSection($id);

        $userId     = $_SESSION['user']['user_id'];

        if(count($section)>0 AND $section['created_by'] == $userId)
        {
            if($this->teamWorkSectionModel->deleteTeamWorkSection($id))
            {
                echo '<div class="alert alert-success"> <strong> Success! </strong> Section Deleted Successfully</div>';
            }
            else
            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Section Not Deleted</div>';
            }

        }
        else
        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That Section </div>';
        }



    }






}