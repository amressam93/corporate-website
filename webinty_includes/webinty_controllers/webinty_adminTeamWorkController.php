<?php


class webinty_adminTeamWorkController extends webinty_adminController
{


    /**
     * @var webinty_teamWorkModel
     */
    private $teamWorkModel;





    /**
     * webinty_adminTeamWorkController constructor.
     * @param webinty_teamWorkModel $teamWork
     */
    public function __construct(webinty_teamWorkModel $teamWork)
    {
        $this->teamWorkModel = $teamWork;
    }







    /**
     * Add TeamWork Model.
     */
    public function addMember()
    {
        $this->checkPermission(4);

        if(isset($_POST['member_name']) && isset($_POST['member_section']) && isset($_POST['jop_title']) && isset($_POST['aboutmember']))
        {
            $validator = new validation();

            $rules = array(

                'member_name'    => 'required',
                'member_section' => 'required',
                'jop_title'      => 'required',
                'aboutmember'    => 'required|min:20|max:85'
            );


            // set validation rules
            $validator->setRules($rules);

            // check Data
            if($validator->validate())
            {
                // date and Time Format
                date_default_timezone_set("Africa/Cairo");
                $date = date("l  h:i:s A - d.m.Y");

                // connection to Database
                $connection = $this->teamWorkModel->connect;

                $MemberName        = mysqli_real_escape_string($connection,$_POST['member_name']);
                $MemberSection     = mysqli_real_escape_string($connection,$_POST['member_section']);
                $MemberJopTitle    = mysqli_real_escape_string($connection,$_POST['jop_title']);
                $MemberDescription = mysqli_real_escape_string($connection,$_POST['aboutmember']);
                $MemberFaceBook    = mysqli_real_escape_string($connection,$_POST['member_facebook']);
                $MemberLinkedIn    = mysqli_real_escape_string($connection,$_POST['member_linkedin']);
                $MemberTwitter     = mysqli_real_escape_string($connection,$_POST['member_twitter']);
                $MemberGooglePlus  = mysqli_real_escape_string($connection,$_POST['member_googleplus']);
                $created_at        = $date;
                $created_by        = $_SESSION['user']['user_id'];

                // image directort
                $imageDirectory     = '../webinty_includes/webinty_uploads/teamwork';
                $MemberImage        = $this->uploadSingleImage('member_image',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


                // data
                $teamWorkData = array(

                    'member_name'        => $MemberName,
                    'member_section'     => $MemberSection,
                    'member_jop_title'   => $MemberJopTitle,
                    'member_description' => $MemberDescription,
                    'member_image'       => $MemberImage,
                    'member_facebook'    => $MemberFaceBook,
                    'member_linkedin'    => $MemberLinkedIn,
                    'member_twitter'     => $MemberTwitter,
                    'member_googleplus'  => $MemberGooglePlus,
                    'created_at'         => $created_at,
                    'created_by'         => $created_by

                );



                // check is Exists
                $TeamWorkMembersArray = $this->teamWorkModel->getAllMembers();

                if($this->checkIsExists($TeamWorkMembersArray,'member_name',$MemberName))

                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Member is Already Exists</div>';
                    exit;
                }



                // store data in data base
                if ($this->teamWorkModel->addMember($teamWorkData))
                {
                    echo '<div class="alert alert-success"> <strong> Success! </strong> Member Inserted Successfully</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Member Not Inserted</div>';
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
            $pageTitle = "Add TeamWork Member";

            // get All TeamWork Sections

            $teamWorkSectionsModel = new webinty_teamWorkSectionsModel();
            $sections              = $teamWorkSectionsModel->getAllSections();


            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');
            include (WEBINTY_VIEWS.'/admin/addTeamWorkMember.html');
            include (WEBINTY_VIEWS.'/admin/footer.html');
        }


    }








    /**
     * Get All TeamWork Members.
     */
    public function getAllMembers()
    {
        $this->checkPermission(4);

        $pageTitle = "TeamWork Members";


        // model
        $teamWorkMembers  = $this->teamWorkModel->getAllMembers();

        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');
        include (WEBINTY_VIEWS.'/admin/teamWorkMembers.html');
        include (WEBINTY_VIEWS.'/admin/footer.html');
    }







    /**
     * Get Member By Id.
     */
    public function getMemberById()
    {
        $this->checkPermission(4);

        $connection = $this->teamWorkModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $Member = $this->teamWorkModel->getMemberById($id);

        // $pageTitle = $Member['member_name'].' | TeamWork Member';
        $pageTitle = $this->getPageTitle($Member,'member_name','TeamWork Member','Page Not Found');


        // view
        include (WEBINTY_VIEWS.'/admin/header.html');
        include (WEBINTY_VIEWS.'/admin/menu.html');
        include (WEBINTY_VIEWS.'/admin/nav.html');

        if(count($Member)>0)
        {
            include (WEBINTY_VIEWS.'/admin/teamWorkMember.html');
        }
        else
        {
            include (WEBINTY_VIEWS.'/admin/404Error.html');
        }

        include (WEBINTY_VIEWS.'/admin/footer.html');

    }







    /**
     * Update Member Data.
     */
    public function updateMember()
    {
        $this->checkPermission(4);
        if(isset($_POST['updateMemberName']) && isset($_POST['updateTeamWorkSection']) && isset($_POST['updateMemberJopTitle']) && isset($_POST['updateAboutMember']))
        {

            $validator = new validation();

            $rules = array(

                'updateMemberName'          => 'required',
                'updateTeamWorkSection'     => 'required',
                'updateMemberJopTitle'      => 'required',
                'updateAboutMember'         => 'required|min:20|max:85'
            );

            // set validation rules
            $validator->setRules($rules);

            //check data

            if($validator->validate())

            {


            // date and Time Format
            date_default_timezone_set("Africa/Cairo");
            $date = date("l  h:i:s A - d.m.Y");

            // connection to Database
            $connection = $this->teamWorkModel->connect;

            $MemberName        = mysqli_real_escape_string($connection,$_POST['updateMemberName']);
            $MemberSection     = mysqli_real_escape_string($connection,$_POST['updateTeamWorkSection']);
            $MemberJopTitle    = mysqli_real_escape_string($connection,$_POST['updateMemberJopTitle']);
            $MemberDescription = mysqli_real_escape_string($connection,$_POST['updateAboutMember']);
            $MemberFaceBook    = mysqli_real_escape_string($connection,$_POST['updateMemberFacebookAccount']);
            $MemberLinkedIn    = mysqli_real_escape_string($connection,$_POST['updateMemberLinkedInAccount']);
            $MemberTwitter     = mysqli_real_escape_string($connection,$_POST['updateTwitterAccount']);
            $MemberGooglePlus  = mysqli_real_escape_string($connection,$_POST['updateMemberGooglePlusAccount']);



            // id From Form
            $idFromForm    = mysqli_real_escape_string($connection,$_POST['member_ID']);

            // TeamWork Member Data By Id From Form
            $teamWorkMemberInfo    = $this->teamWorkModel->getMemberById($idFromForm);

            // admin id
            $userId   = $_SESSION['user']['user_id'];

            // old Image
            $oldMemberImage           = $teamWorkMemberInfo['member_image'];

            // image directort
            $imageDirectory     = '../webinty_includes/webinty_uploads/teamwork';
            $MemberImage       = $this->uploadSingleImage('updateMemberImage',$imageDirectory,array('image/png','image/jpg','image/jpeg'));


            // data
            $teamWorkData = array(

                'member_name'        => $MemberName,
                'member_section'     => $MemberSection,
                'member_jop_title'   => $MemberJopTitle,
                'member_description' => $MemberDescription,
                'member_facebook'    => $MemberFaceBook,
                'member_linkedin'    => $MemberLinkedIn,
                'member_twitter'     => $MemberTwitter,
                'member_googleplus'  => $MemberGooglePlus,

            );


            // update Image

            if($MemberImage)

            {
                $teamWorkData['member_image'] = $MemberImage;
            }



            // store data in dataBase After Update

            if(count($teamWorkMemberInfo)>0 AND $teamWorkMemberInfo['created_by']==$userId)
            {
                if($this->teamWorkModel->updateMemberData($idFromForm,$teamWorkData))
                {
                    if($MemberImage)
                    {
                        unlink('../webinty_includes/webinty_uploads/teamwork/'.$oldMemberImage);
                    }

                    echo '<div class="alert alert-success"> <strong> Success! </strong> Member Data Updated Successfully</div>';

                    echo "<meta http-equiv='refresh' content='2;URL=\"teamWorkMember.php?id=".$idFromForm."\"' />";

                }
                else
                {
                    echo '<div class="alert alert-danger"> <strong> Error! </strong> Member Data Not Updated</div>';
                }


            }

            else
            {
                echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Update This Member</div>';
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
            $connection = $this->teamWorkModel->connect;

            $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

            $id         = mysqli_real_escape_string($connection,$idFromUrl);

            // get Member Data By id
            $Member    = $this->teamWorkModel->getMemberById($id);

            // -2 get SESSION Of User Id
            $userId = $_SESSION['user']['user_id'];

            // page Title
            //$pageTitle  = $Member['member_name'].' | teamWork Member';
            $pageTitle  = $this->getPageTitle($Member,'member_name','teamWork Member','Page Not Found');

            // display Form
            include (WEBINTY_VIEWS.'/admin/header.html');
            include (WEBINTY_VIEWS.'/admin/menu.html');
            include (WEBINTY_VIEWS.'/admin/nav.html');

            if(count($Member)>0 AND $Member['created_by'] == $userId)
            {
                // get All teamwork sections

                $MemberSections  = new webinty_teamWorkSectionsModel();
                $sections        = $MemberSections->getAllSections();

                include (WEBINTY_VIEWS.'/admin/updateTeamWorkMember.html');
            }
            else
            {
                include (WEBINTY_VIEWS.'/admin/404Error.html');
            }

            include (WEBINTY_VIEWS.'/admin/footer.html');

        }

    }








    /**
     * Delete Member Data.
     */
    public function deleteMember()
    {
        $this->checkPermission(4);

        $connection = $this->teamWorkModel->connect;

        $idFromUrl  = (isset($_GET['id']))? (int)$_GET['id']:0;

        $id         = mysqli_real_escape_string($connection,$idFromUrl);

        $Member     = $this->teamWorkModel->getMemberById($id);

        $userId     = $_SESSION['user']['user_id'];

        if(count($Member)>0 AND $Member['created_by'] == $userId)
        {
            if($this->teamWorkModel->DeleteMember($id))
            {
                $memberPhoto = $Member['member_image'];
                if($memberPhoto)
                {
                    unlink('../webinty_includes/webinty_uploads/teamwork/'.$memberPhoto);
                }

                echo '<div class="alert alert-success"> <strong> Success! </strong> Member Deleted Successfully</div>';

            }
            else
            {
                echo '<div class="alert alert-success"> <strong> Error! </strong> Member Not Deleted</div>';
            }


        }
        else
        {
            echo '<div class="alert alert-danger"> <strong> Error! </strong> You Dont Have Permissions To Delete That Member </div>';
        }

    }






}