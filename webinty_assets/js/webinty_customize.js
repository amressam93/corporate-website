/**
 * Created by User on 15/05/2017.
 */






    /*
     * start function user login
     */

    $(document).ready(function () {


        $('#login_form').on('submit',function (event) {

            event.preventDefault();



            $.ajax({

                url:  '../../ar/login/index.php',
                type: 'POST',
                data:  new FormData(this),
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS

                beforeSend: function () {
                    $("#login_spinner").show();
                    $("#login").hide();
                },

                complete: function () {
                    $("#login_spinner").hide();
                    $("#login").show();
                },

                success:function(data)

                {
                    if(data == "login")

                    {
                        window.location = "../../admin_dashboard/";
                    }

                    else

                    {
                        $('#login_result').html(data);
                        $('#login_result').show();
                    }

                }

            });

        });


    });


    /*
     * End function user login
     */











    /*
     *  start function add user group
     */


         $(function () {

             $('#userGroupsForm').validate({

                 rules: {

                     groupName: {
                         required: true,
                         lettersonly: true,
                         nowhitespace: true
                     }
                 },

                 messages: {
                     groupName: {
                         required: '<div style="color: red">please Enter Vaild Input</div>',
                         lettersonly: '<div style="color: red">Group Name Should Only Include letters With No space Please</div>',
                         nowhitespace: '<div style="color: red">No white Space Please</div>'

                     }
                 },


                 errorElement: "em",
                 errorPlacement: function ( error, element ) {
                     // Add the `help-block` class to the error element
                     error.addClass( "help-block" );

                     if ( element.prop( "type" ) === "checkbox" ) {
                         error.insertAfter( element.parent( "label" ) );
                     } else {
                         error.insertAfter( element );
                     }
                 },
                 highlight: function ( element, errorClass, validClass ) {
                     $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                 },
                 unhighlight: function (element, errorClass, validClass) {
                     $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                 }


             });

         });




        $('#userGroupsForm').on('submit',function (event) {

            event.preventDefault();

            if($('#userGroupsForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addUserGroup.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#userGroup_spinner").show();
                        $("#userGroup_submit").hide();
                    },

                    complete: function () {
                        $("#userGroup_spinner").hide();
                        $("#userGroup_submit").show();
                    }

                }).done(function (data) {

                    $('#userGroup_result').html(data);
                    $('#userGroup_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#userGroupsForm')[0].reset();

                });
            }

        });


       /*
        *  End function add user group
        */














     /*
      * start function delete User Groups
      */


       $('.confirmDeleteUserGroup').click(function (event) {

           event.preventDefault();

           if (confirm('Are you sure you want to Delete This User Groups'))

           {
               var userGroupID = $(this).attr('id');

               $.ajax({


                   method: 'GET',
                   data: {id:userGroupID},
                   url: '../admin_dashboard/deleteUserGroup.php'


               }).done(function (data) {

                   $('#deleteUserGroup_result').html(data);
                   $('#deleteUserGroup_result').show();
                   $("html, body").animate({ scrollTop: 0 }, "slow");

                   window.setTimeout(function(){

                       $('#deleteUserGroup_result').hide();
                       location.reload();

                   }, 5000);

               });


           }

           else

           {
               // Do nothing!
           }

       });


     /*
      * End function Delete User Groups
      */








     /*
      * start function update user groups
      */





        $(function () {

            $('#updateUserGroupForm').validate({

                rules: {

                    groupName: {
                        required: true,
                        lettersonly: true,
                        nowhitespace: true

                    }
                },

                messages: {
                    groupName: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        lettersonly: '<div style="color: red">Group Name Should Only Include letters With No space Please</div>',
                        nowhitespace: '<div style="color: red">No white Space Please</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateUserGroupForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateUserGroupForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateUserGroup.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateUserGroup_spinner").show();
                        $("#updateUserGroup_submit").hide();
                    },

                    complete: function () {
                        $("#updateUserGroup_spinner").hide();
                        $("#updateUserGroup_submit").show();
                    }

                }).done(function (data) {

                    $('#updateUserGroup_result').html(data);
                    $('#updateUserGroup_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateUserGroup_result').hide();

                    },4000);

                });
            }

        });



     /*
      * End function update user group
      */














    /*
     *  Start function add user
     */



    $(function () {

        $('#AddUserForm').validate({

            rules: {

                name: {
                    required: true,
                    lettersonly: true,
                    nowhitespace: true
                },

                username: {

                    required: true,
                    lettersonly: true
                },

                password: {

                    required: true,
                    minlength: 6
                },

                email: {

                    required: true,
                    email: true
                },

                aboutuser: {

                    required: true,
                    minlength: 10
                },

                user_group: {

                    required: true
                },

                userImage: {

                    required: true
                }
            },

            messages: {

                name: {
                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    lettersonly: '<div style="color: red">Name Should Only Include letters With No space Please</div>',
                    nowhitespace: '<div style="color: red">No white Space Please</div>'
                },

                username: {
                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    lettersonly: '<div style="color: red">Name Should Only Include letters With No space Please</div>'
                },

                password: {
                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    minlength: '<div style="color: red">please Enter Minimum 6 Characters</div>'

                },

                email: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:    '<div style="color: red">please Enter Vaild Email Adrress</div>'
                },

                aboutuser: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    minlength: '<div style="color: red">please Enter Minimum 6 Characters</div>'
                },

                user_group: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },


                userImage: {

                    required: '<div style="color: red">Please Select Your First Profile Image</div>'
                }


            },


            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
            }


        });

    });




    $('#AddUserForm').on('submit',function (event) {

        event.preventDefault();

        if($('#AddUserForm').valid())

        {

            $.ajax({
                url: '../admin_dashboard/addUser.php',
                type: 'POST',
                data:  new FormData(this),
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS


                beforeSend: function () {
                    $("#user_spinner").show();
                    $("#user_submit").hide();
                },

                complete: function () {
                    $("#user_spinner").hide();
                    $("#user_submit").show();
                }

            }).done(function (response) {

                $('#usersResult').html(response);
                $('#usersResult').show();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $('#AddUserForm')[0].reset();

            });
        }

    });



    /*
     *  End function add user
     */



















    /*
     * start function update user
     */



        $(function () {

            $('#updateUserForm').validate({

                rules: {

                    Name: {
                        required: true,
                        lettersonly: true,
                        nowhitespace: true
                    },

                    username: {

                        required: true,
                        lettersonly: true
                    },



                    email: {

                        required: true,
                        email: true
                    },

                    aboutuser: {

                        required: true,
                        minlength: 10
                    },

                    user_group: {

                        required: true
                    }
                },

                messages: {

                    name: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        lettersonly: '<div style="color: red">Name Should Only Include letters With No space Please</div>',
                        nowhitespace: '<div style="color: red">No white Space Please</div>'
                    },

                    username: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        lettersonly: '<div style="color: red">Name Should Only Include letters With No space Please</div>'
                    },


                    email: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:    '<div style="color: red">please Enter Vaild Email Adrress</div>'
                    },

                    aboutuser: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter Minimum 6 Characters</div>'
                    },

                    user_group: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateUserForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateUserForm').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/updateUser.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#updateUser_spinner").show();
                        $("#updateUser_submit").hide();
                    },

                    complete: function () {
                        $("#updateUser_spinner").hide();
                        $("#updateUser_submit").show();
                    }

                }).done(function (response) {

                    $('#updateUserResult').html(response);
                    $('#updateUserResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateUserResult').hide();

                    },4000);

                });
            }

        });




    /*
     * End Function update user
     */


















    /*
     * Start Function Delete User
     */



        $(".confirmDeleteUser").click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This User'))

            {
                var userID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:userID},
                    url: '../admin_dashboard/deleteUser.php'


                }).done(function (data) {

                    $('#deleteUserResult').html(data);
                    $('#deleteUserResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#deleteUserResult').hide();
                        location.reload();

                    }, 5000);

                });


            }

            else

            {
                // Do nothing!
            }

        });




    /*
     *  End Function Delete User
     */












        /*
         * Start function add public Info
         */




    $(function () {

        $('#AddPublicInfoForm').validate({

            rules: {

                company_name: {
                    required: true
                },

                aboutcompany: {

                    required: true,
                    minlength: 10

                },

                company_address: {

                    required: true
                },


                company_logo: {

                    required: true
                },

                mobile1: {

                    required: true,
                    number: true,
                    rangelength: [3, 11]
                },

                mobile2: {

                    required: true,
                    number: true,
                    rangelength: [3, 11]
                },

                email_info: {

                    required: true,
                    email: true
                },

                email_sales: {

                    required: true,
                    email: true
                },

                email_marketing: {

                    required: true,
                    email: true
                },

                email_technical: {

                    required: true,
                    email: true
                },

                email_callcenter: {

                    required: true,
                    email: true
                },

                facebook: {

                    required: true
                },

                twitter: {

                    required: true

                },

                linkedin: {

                    required: true
                },

                googleplus: {

                    required: true

                },

                skype: {

                    required: true
                },

                blogger: {

                    required: true
                },

                wordpress: {

                    required: true
                },

                tumblr: {

                    required: true

                },

                vimeo:{

                    required: true

                },

                instagram: {

                    required: true

                },
                landline_phone_number: {

                    number: true
                },

                sales_mobile_number_1: {

                    number: true
                },

                sales_mobile_number_2: {

                    number: true
                },

                sales_mobile_number_3: {

                    number: true
                },

                Technical_Support_Mobile_number_1: {

                    number: true
                },

                Technical_Support_Mobile_number_2: {

                    number: true

                },

                customer_service_Mobile_number_1: {

                    number: true
                },

                customer_service_Mobile_number_2: {
                    number: true
                },

                hosting_service_Mobile_number: {

                    number: true
                },

                whatsapp_main_mobile_number: {
                    number: true
                },

                whatsapp_sales_mobile_number: {

                    number: true
                }




            },

            messages: {

                company_name: {
                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                aboutcompany: {
                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    minlength: '<div style="color: red">please Enter Minimum 10 Characters</div>'
                },

                company_address: {
                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                company_logo: {

                    required: '<div style="color: red">Please Select Company Logo Picture</div>'
                },

                mobile1: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    number:  '<div style="color: red">please Enter Vaild Number</div>',
                    rangelength: '<div style="color: red">Please Enter a value between 3 and 11 Number</div>'
                },

                mobile2: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    number:    '<div style="color: red">please Enter Vaild Number</div>',
                    rangelength: '<div style="color: red">Please Enter a value between 3 and 11 Number</div>'
                },

                email_info: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                },

                email_sales: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                },

                email_marketing: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:     '<div style="color: red">please Enter Vaild Email Address</div>'

                },

                email_technical: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                },

                email_callcenter: {

                    required: '<div style="color: red">please Enter Vaild Input</div>',
                    email:     '<div style="color: red">please Enter Vaild Email Address</div>'

                },

                facebook: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                twitter:{

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                linkedin: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'

                },

                googleplus: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                skype: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                blogger: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },


                wordpress: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },



                tumblr: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                vimeo: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'

                },

                instagram: {

                    required: '<div style="color: red">please Enter Vaild Input</div>'
                },

                landline_phone_number: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                sales_mobile_number_1: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                sales_mobile_number_2: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                sales_mobile_number_3: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'
                },

                Technical_Support_Mobile_number_1: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                Technical_Support_Mobile_number_2: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                customer_service_Mobile_number_1: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                customer_service_Mobile_number_2: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                hosting_service_Mobile_number: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                whatsapp_main_mobile_number: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                },

                whatsapp_sales_mobile_number: {

                    number:  '<div style="color: red">please Enter Vaild Number</div>'

                }


            },


            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
            }


        });

    });




    $('#AddPublicInfoForm').on('submit',function (event) {

        event.preventDefault();

        if($('#AddPublicInfoForm').valid())

        {

            $.ajax({
                url: '../admin_dashboard/addPublicInfo.php',
                type: 'POST',
                data:  new FormData(this),
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS


                beforeSend: function () {
                    $("#publicInfo_spinner").show();
                    $("#publicInfo_submit").hide();
                },

                complete: function () {
                    $("#publicInfo_spinner").hide();
                    $("#publicInfo_submit").show();
                }

            }).done(function (response) {

                $('#publicInfoResult').html(response);
                $('#publicInfoResult').show();
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $('#AddPublicInfoForm')[0].reset();

            });
        }

    });






    /*
     *  End Function Add Public Info
     */















    /*
     * Start Function Update Public Info
     */




        $(function () {

            $('#updatePublicInfoForm').validate({

                rules: {

                    company_name: {
                        required: true
                    },

                    aboutcompany: {

                        required: true,
                        minlength: 10

                    },

                    company_address: {

                        required: true
                    },



                    mobile1: {

                        required: true,
                        number: true,
                        rangelength: [3, 11]
                    },

                    mobile2: {

                        required: true,
                        number: true,
                        rangelength: [3, 11]
                    },

                    email_info: {

                        required: true,
                        email: true
                    },

                    email_sales: {

                        required: true,
                        email: true
                    },

                    email_marketing: {

                        required: true,
                        email: true
                    },

                    email_technical: {

                        required: true,
                        email: true
                    },

                    email_callcenter: {

                        required: true,
                        email: true
                    },

                    facebook: {

                        required: true
                    },

                    twitter: {

                        required: true

                    },

                    linkedin: {

                        required: true
                    },

                    googleplus: {

                        required: true

                    },

                    skype: {

                        required: true
                    },

                    blogger: {

                        required: true
                    },

                    wordpress: {

                        required: true
                    },

                    tumblr: {

                        required: true

                    },

                    vimeo:{

                        required: true

                    },

                    instagram: {

                        required: true

                    },
                    update_landline_phone_number: {

                        number: true
                    },

                    update_sales_mobile_number_1: {

                        number: true
                    },

                    update_sales_mobile_number_2: {

                        number: true
                    },

                    update_sales_mobile_number_3: {

                        number: true
                    },

                    update_Technical_Support_Mobile_number_1: {

                        number: true
                    },

                    update_Technical_Support_Mobile_number_2: {

                        number: true

                    },

                    update_customer_service_Mobile_number_1: {

                        number: true
                    },

                    update_customer_service_Mobile_number_2: {
                        number: true
                    },

                    update_hosting_service_Mobile_number: {

                        number: true
                    },

                    update_whatsapp_main_mobile_number: {
                        number: true
                    },

                    update_whatsapp_sales_mobile_number: {

                        number: true
                    }




                },

                messages: {

                    company_name: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    aboutcompany: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter Minimum 10 Characters</div>'
                    },

                    company_address: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },


                    mobile1: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number:  '<div style="color: red">please Enter Vaild Number</div>',
                        rangelength: '<div style="color: red">Please Enter a value between 3 and 11 Number</div>'
                    },

                    mobile2: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number:    '<div style="color: red">please Enter Vaild Number</div>',
                        rangelength: '<div style="color: red">Please Enter a value between 3 and 11 Number</div>'
                    },

                    email_info: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                    },

                    email_sales: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                    },

                    email_marketing: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:     '<div style="color: red">please Enter Vaild Email Address</div>'

                    },

                    email_technical: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:     '<div style="color: red">please Enter Vaild Email Address</div>'
                    },

                    email_callcenter: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        email:     '<div style="color: red">please Enter Vaild Email Address</div>'

                    },

                    facebook: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    twitter:{

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    linkedin: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'

                    },

                    googleplus: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    skype: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    blogger: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },


                    wordpress: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },



                    tumblr: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    vimeo: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'

                    },

                    instagram: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },



                    update_landline_phone_number: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_sales_mobile_number_1: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_sales_mobile_number_2: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_sales_mobile_number_3: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'
                    },

                    update_Technical_Support_Mobile_number_1: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_Technical_Support_Mobile_number_2: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_customer_service_Mobile_number_1: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_customer_service_Mobile_number_2: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_hosting_service_Mobile_number: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_whatsapp_main_mobile_number: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    },

                    update_whatsapp_sales_mobile_number: {

                        number:  '<div style="color: red">please Enter Vaild Number</div>'

                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updatePublicInfoForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updatePublicInfoForm').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/updatePublicInfo.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#updatepublicInfo_spinner").show();
                        $("#updatepublicInfo_submit").hide();
                    },

                    complete: function () {
                        $("#updatepublicInfo_spinner").hide();
                        $("#updatepublicInfo_submit").show();
                    }

                }).done(function (response) {

                    $('#updatepublicInfoResult').html(response);
                    $('#updatepublicInfoResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updatepublicInfoResult').hide();

                    },4000);

                });
            }

        });







        /*
         * End Function Update Public Info
         */















        /*
         * Start Function Delete Public Info
         */




        $(".confirmDeletePublicInfo").click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Information'))

            {
                var infoID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:infoID},
                    url: '../admin_dashboard/deletePublicInfo.php'


                }).done(function (data) {

                    $('#publicInformations_result').html(data);
                    $('#publicInformations_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#publicInformations_result').hide();
                        location.reload();

                    }, 5000);

                });


            }

            else

            {
                // Do nothing!
            }

        });







        /*
         * End Function Delete Public Info
         */


















        /*
         * Start Function Add Subject Category
         */



        $(function () {

            $('#AddSubjectCategory').validate({

                rules: {

                    categoryname: {
                        required: true
                    },

                    categorydescription: {
                        required: true,
                        minlength: 50
                    },

                    subjectcategoryseotitle: {

                        required: true
                    },

                    subjectcategoryseodescription: {

                        required: true
                    },

                    subjectcategoryseokeywords: {

                        required: true
                    }
                },

                messages: {

                    categoryname: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    categorydescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter Minimum 50 Characters</div>'
                    },

                    subjectcategoryseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectcategoryseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectcategoryseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddSubjectCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#AddSubjectCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addSubjectCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addSubjectCategory_spinner").show();
                        $("#addSubjectCategory_submit").hide();
                    },

                    complete: function () {
                        $("#addSubjectCategory_spinner").hide();
                        $("#addSubjectCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#addSubjectCategoryResult').html(data);
                    $('#addSubjectCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddSubjectCategory')[0].reset();

                });
            }

        });



        /*
         * End Function Add Subject Category
         */













        /*
         *  start Function Update Subject Category
         */


        $(function () {

            $('#updateSubjectCategory').validate({

                rules: {

                    categoryname: {
                        required: true
                    },

                    categorydescription: {
                        required: true,
                        minlength: 50
                    },

                    subjectcategoryseotitle: {

                        required: true
                    },

                    subjectcategoryseodescription: {

                        required: true
                    },

                    subjectcategoryseokeywords: {

                        required: true
                    }

                },

                messages: {

                    categoryname: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    categorydescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter Minimum 50 Characters</div>'
                    },

                    subjectcategoryseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectcategoryseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectcategoryseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateSubjectCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#updateSubjectCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateSubjectCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateSubjectCategory_spinner").show();
                        $("#updateSubjectCategory_submit").hide();
                    },

                    complete: function () {
                        $("#updateSubjectCategory_spinner").hide();
                        $("#updateSubjectCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#updateSubjectCategoryResult').html(data);
                    $('#updateSubjectCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateSubjectCategoryResult').hide();

                    },4000);

                });
            }

        });




        /*
         *  End Function Update Subject Category
         */













        /*
         * Start Function Delete Subject Category
         */



        $('.confirmDeleteSubjectCategory').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Subject Category'))

            {
                var subjectCategoryID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:subjectCategoryID},
                    url: '../admin_dashboard/deleteSubjectCategory.php'


                }).done(function (data) {

                    $('#subjects_categories_result').html(data);
                    $('#subjects_categories_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#subjects_categories_result').hide();
                        location.reload();

                    }, 5000);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         * End Function Delete Subject Category
         */














        /*
         *  start Function Add subject
         */



        $(function () {

            $('#AddSubject').validate({

                rules: {

                    subjecttitle: {
                        required: true
                    },

                    subjectdescription: {

                        required: true,
                        minlength: 20
                    },

                    subjectimage: {

                        required: true
                    },

                    subjectseotitle: {

                        required: true
                    },

                    subjectseodescription: {

                        required: true
                    },

                    subjectseokeywords: {

                        required: true
                    },

                    subjectseoimagealt: {

                        required: true
                    },

                    subjectseoimagetitle: {

                        required: true
                    },

                    subjectCategory: {

                        required: true
                    }
                },

                messages: {


                    subjecttitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectdescription: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter At least 20 Characters</div>'
                    },

                    subjectimage: {
                        required: '<div style="color: red">Please Select Subject Image</div>'
                    },

                    subjectseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseoimagealt: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },


                    subjectseoimagetitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddSubject').on('submit',function (event) {

            event.preventDefault();

            if($('#AddSubject').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/addSubject.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#addSubject_spinner").show();
                        $("#subjectBox").hide();
                    },

                    complete: function () {
                        $("#addSubject_spinner").hide();
                        $("#subjectBox").show();
                    }

                }).done(function (response) {

                    $('#addSubject_Result').html(response);
                    $('#addSubject_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddSubject')[0].reset();

                });
            }

        });






        /*
         *  End Function Add subject
         */


















        /*
         *  Start Function Update Subject
         */





        $(function () {

            $('#updateSubject').validate({

                rules: {

                    subjecttitle: {
                        required: true
                    },

                    subjectdescription: {

                        required: true,
                        minlength: 20
                    },


                    subjectseotitle: {

                        required: true
                    },

                    subjectseodescription: {

                        required: true
                    },

                    subjectseokeywords: {

                        required: true
                    },

                    subjectseoimagealt: {

                        required: true
                    },

                    subjectseoimagetitle: {

                        required: true
                    },

                    subjectCategory: {

                        required: true
                    }

                },

                messages: {


                    subjecttitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectdescription: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter At least 20 Characters</div>'
                    },

                    subjectseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectseoimagealt: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },


                    subjectseoimagetitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    subjectCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateSubject').on('submit',function (event) {

            event.preventDefault();

            if($('#updateSubject').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/updateSubject.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#updateSubject_spinner").show();
                        $("#updateSubject_submit").hide();
                    },

                    complete: function () {
                        $("#updateSubject_spinner").hide();
                        $("#updateSubject_submit").show();
                    }

                }).done(function (response) {

                    $('#updateSubject_Result').html(response);
                    $('#updateSubject_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateSubject_Result').hide();

                    },3000);

                });
            }

        });



        /*
         *  End Function Update Subject
         */
















        /*
         *  Start Function Delete Subject
         */



        $('.confirmDeleteSubject').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Subject'))

            {
                var subjectID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:subjectID},
                    url: '../admin_dashboard/deleteSubject.php'


                }).done(function (data) {

                    $('#subjects_result').html(data);
                    $('#subjects_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#subjects_result').hide();
                        location.reload();

                    }, 3000);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         *  End Function Delete Subject
         */













        /*
         * Start Function Add Article
         */




        $(function () {

            $('#AddArticleForm').validate({

                rules: {

                    articletitle: {
                        required: true
                    },

                    articledescription: {

                        required: true,
                        minlength: 20
                    },

                    'articleimage[]': {

                        required: true,
                        extension: "png|jpg|jpeg"
                    },


                    articleseotitle: {

                        required: true
                    },

                    articleseodescription: {

                        required: true
                    },

                    articleseokeywords: {

                        required: true
                    },

                    articleseoimagealt: {

                        required: true
                    },

                    articleseoimagetitle: {

                        required: true
                    },

                    articlesubject: {

                        required: true
                    },

                    add_article_seo_og_image: {
                        required: true
                    }
                },

                messages: {

                    articletitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articledescription: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter At least 20 Characters</div>'
                    },

                    'articleimage[]': {
                        required: '<div style="color: red">Please Select At least One Image And image type jpg/png/jpeg is allowed </div>',
                        extension: '<div style="color: red">Only image type jpg/png/jpeg is allowed</div>'
                    },

                    articleseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseoimagealt: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseoimagetitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articlesubject: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    add_article_seo_og_image: {
                        required: '<div style="color: red">Please Select Article Seo og Image</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddArticleForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddArticleForm').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/addArticle.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#addArticle_spinner").show();
                        $("#addArticle_submit").hide();
                    },

                    complete: function () {
                        $("#addArticle_spinner").hide();
                        $("#addArticle_submit").show();
                    }

                }).done(function (response) {

                    $('#articleResult').html(response);
                    $('#articleResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddArticleForm')[0].reset();

                });
            }

        });


        /*
         * End Function Add Article
         */












        /*
         * Start Function Update Article
         */



        $(function () {

            $('#updateArticleForm').validate({

                rules: {

                    articletitle: {
                        required: true
                    },

                    articledescription: {

                        required: true,
                        minlength: 20
                    },

                    articleseotitle: {

                        required: true
                    },

                    articleseodescription: {

                        required: true
                    },

                    articleseokeywords: {

                        required: true
                    },

                    articleseoimagealt: {

                        required: true
                    },

                    articleseoimagetitle: {

                        required: true
                    },


                    articlesubject: {

                        required: true
                    }


                },

                messages: {


                    articletitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articledescription: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">please Enter At least 20 Characters</div>'
                    },


                    articleseotitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseodescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseokeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseoimagealt: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articleseoimagetitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    articlesubject: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateArticleForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateArticleForm').valid())

            {

                $.ajax({
                    url: '../admin_dashboard/updateArticle.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS


                    beforeSend: function () {
                        $("#updateArticle_spinner").show();
                        $("#updateArticle_submit").hide();
                    },

                    complete: function () {
                        $("#updateArticle_spinner").hide();
                        $("#updateArticle_submit").show();
                    }

                }).done(function (response) {

                    $('#updateArticleResult').html(response);
                    $('#updateArticleResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateArticleResult').hide();

                    },4000);

                });
            }

        });



        /*
         * End Function Update Article
         */












        /*
         *  Start Function Delete Article
         */



        $('.confirmDeleteArticle').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Article'))

            {
                var articleID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:articleID},
                    url: '../admin_dashboard/deleteArticle.php'


                }).done(function (data) {

                    $('#articles_result').html(data);
                    $('#articles_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#articles_result').hide();
                        location.reload();

                    }, 5000);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         *  End Function Delete Article
         */










            /*
             * Start Function Delete Image By Article Id
             */



            $('.confirmDeleteImageArticle').click(function (event) {

                event.preventDefault();

                if (confirm('Are you sure you want to Delete This Image'))

                {
                    var imageID = $(this).attr('id');


                    var url =  (window.location.href);
                    var id_after = url.split('?')[1];
                    var cut = id_after.split('&');
                    var articleIdAfterCut = cut[0];
                    var id_article = articleIdAfterCut.split('id=')[1];


                    $.ajax({

                        method: 'GET',
                        data: {id:imageID,articleID:id_article},
                        url: '../admin_dashboard/deleteImage.php'


                    }).done(function (data) {

                        $('#articleImages_result').html(data);
                        $('#articleImages_result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#articleImages_result').hide();
                            location.reload();

                        }, 2000);

                    });


                }

                else

                {
                    // Do nothing!
                }

            });




            /*
             * End Function Delete Image By Article Id
             */











        /*
         * Start Function Validate Add Image
         */


        $(function () {

            $('#addArticleImage_form').validate({

                rules: {

                    'imagesOfArticle[]': {

                        required: true,
                        extension: "png|jpg|jpeg"
                    }
                },

                messages: {



                    'imagesOfArticle[]': {
                        required: '<div style="color: red">Please Select At least One Image And image type jpg/png/jpeg is allowed </div>',
                        extension: '<div style="color: red">Only image type jpg/png/jpeg is allowed</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });


        /*
         * End Function Validate Add Image
         */






















        /*
         * Start Function Add Faq Categories
         */




        $(function () {

            $('#AddFaqCategory').validate({

                rules: {

                    faqCategoryname: {
                        required: true
                    }
                },

                messages: {
                    faqCategoryname: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddFaqCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#AddFaqCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addFaqCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addFaqCategory_spinner").show();
                        $("#addFaqCategory_submit").hide();
                    },

                    complete: function () {
                        $("#addFaqCategory_spinner").hide();
                        $("#addFaqCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#addFaqCategoryResult').html(data);
                    $('#addFaqCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddFaqCategory')[0].reset();

                });
            }

        });






        /*
         * End Function Add Faq Categories
         */
















        /*
         * Start Function Update FAQ category
         */




        $(function () {

            $('#updateFaqCategory').validate({

                rules: {

                    faqCategoryname: {
                        required: true
                    }
                },

                messages: {
                    faqCategoryname: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateFaqCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#updateFaqCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateFaqCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateFaqCategory_spinner").show();
                        $("#updateFaqCategory_submit").hide();
                    },

                    complete: function () {
                        $("#updateFaqCategory_spinner").hide();
                        $("#updateFaqCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#updateFaqCategoryResult').html(data);
                    $('#updateFaqCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateFaqCategoryResult').hide();

                    },3000);

                });
            }

        });





        /*
         * End Function Update FAQ category
         */














        /*
         * Start Function Delete Faq Category
         */





            $('.confirmDeleteFaqCategory').click(function (event) {

                event.preventDefault();

                if (confirm('Are you sure you want to Delete This FAQ Category'))

                {
                    var faqCategoryID = $(this).attr('id');

                    $.ajax({


                        method: 'GET',
                        data: {id:faqCategoryID},
                        url: '../admin_dashboard/deleteFaqCategory.php'


                    }).done(function (data) {

                        $('#FAQ_categories_result').html(data);
                        $('#FAQ_categories_result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#FAQ_categories_result').hide();
                            location.reload();

                        }, 2500);

                    });


                }

                else

                {
                    // Do nothing!
                }

            });




        /*
         * End Function Delete Faq Category
         */



















        /*
         *  Start Function Add Faq
         */




        $(function () {

            $('#AddFaqForm').validate({

                rules: {

                    faqQuestion: {
                        required: true
                    },

                    faqAnswer: {

                        required: true
                    },

                    faqCategory: {

                        required: true
                    }
                },

                messages: {
                    faqQuestion: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    faqAnswer: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    faqCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddFaqForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddFaqForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addFaq.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addFaq_spinner").show();
                        $("#addFaq_submit").hide();
                    },

                    complete: function () {
                        $("#addFaq_spinner").hide();
                        $("#addFaq_submit").show();
                    }

                }).done(function (data) {

                    $('#addFaqResult').html(data);
                    $('#addFaqResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddFaqForm')[0].reset();

                });
            }

        });





        /*
         *  End Function Add Faq
         */














        /*
         * Start Function Update Faq
         */







        $(function () {

            $('#updateFaqForm').validate({

                rules: {

                    faqQuestion: {
                        required: true
                    },

                    faqAnswer: {

                        required: true
                    },

                    faqCategory: {

                        required: true
                    }


                },

                messages: {
                    faqQuestion: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    faqAnswer: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    faqCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateFaqForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateFaqForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateFaq.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateFaq_spinner").show();
                        $("#updateFaq_submit").hide();
                    },

                    complete: function () {
                        $("#updateFaq_spinner").hide();
                        $("#updateFaq_submit").show();
                    }

                }).done(function (data) {

                    $('#updateFaqResult').html(data);
                    $('#updateFaqResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateFaqResult').hide();

                    },3000);

                });
            }

        });



        /*
         * End Function Update Faq
         */

















        /*
         * Start Function Delete Faq
         */


        $('.confirmDeleteFaq').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This FAQ'))

            {
                var faqID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:faqID},
                    url: '../admin_dashboard/deleteFaq.php'


                }).done(function (data) {

                    $('#faqs_result').html(data);
                    $('#faqs_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#faqs_result').hide();
                        location.reload();

                    }, 2500);

                });


            }

            else

            {
                // Do nothing!
            }

        });




        /*
         * End Function Delete Faq
         */















        /*
         * Start Function add offer category
         */




        $(function () {

            $('#AddOfferCategory').validate({

                rules: {

                    offerCategoryname: {
                        required: true
                    },

                    offerCategoryDescription: {
                        required: true
                    },

                    offerCategorySeoTitle: {

                        required: true
                    },

                    offerCategorySeoDescription: {

                        required: true
                    },

                    offerCategorySeoKeywords: {

                        required: true
                    }
                },

                messages: {


                    offerCategoryname: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategoryDescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoTitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoDescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoKeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddOfferCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#AddOfferCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addOfferCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addOfferCategory_spinner").show();
                        $("#addOfferCategory_submit").hide();
                    },

                    complete: function () {
                        $("#addOfferCategory_spinner").hide();
                        $("#addOfferCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#addOfferCategoryResult').html(data);
                    $('#addOfferCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddOfferCategory')[0].reset();

                });
            }

        });



        /*
         * End Function add offer category
         */



















        /*
         * start Function Update Offer Category
         */




        $(function () {

            $('#updateOfferCategory').validate({

                rules: {

                    offerCategoryname: {
                        required: true
                    },

                    offerCategoryDescription: {
                        required: true
                    },

                    offerCategorySeoTitle: {

                        required: true
                    },

                    offerCategorySeoDescription: {

                        required: true
                    },

                    offerCategorySeoKeywords: {

                        required: true
                    }

                },

                messages: {

                    offerCategoryname: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategoryDescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoTitle: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoDescription: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerCategorySeoKeywords: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateOfferCategory').on('submit',function (event) {

            event.preventDefault();

            if($('#updateOfferCategory').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateOfferCategory.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateOfferCategory_spinner").show();
                        $("#updateOfferCategory_submit").hide();
                    },

                    complete: function () {
                        $("#updateOfferCategory_spinner").hide();
                        $("#updateOfferCategory_submit").show();
                    }

                }).done(function (data) {

                    $('#updateOfferCategoryResult').html(data);
                    $('#updateOfferCategoryResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateOfferCategoryResult').hide();

                    },3000);

                });
            }

        });






        /*
         * End Function Update Offer Category
         */














        /*
         * Start Function Delete Offer Category
         */




        $('.confirmDeleteOfferCategory').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Offer Category'))

            {
                var offerCategoryID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:offerCategoryID},
                    url: '../admin_dashboard/deleteOfferCategory.php'


                }).done(function (data) {

                    $('#offer_categories_result').html(data);
                    $('#offer_categories_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#offer_categories_result').hide();
                        location.reload();

                    }, 2500);

                });


            }

            else

            {
                // Do nothing!
            }

        });




        /*
         * End Function Delete Offer Category
         */






















        /*
         *  Start Function Add Offer
         */



        $(function () {

            $('#AddOfferForm').validate({

                rules: {

                    offerTitle: {
                        required: true
                    },

                    offerPrice: {

                        required: true,
                        number: true
                    },

                    offerCategory: {

                        required: true
                    }
                },

                messages: {
                    offerTitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerPrice: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number: '<div style="color: red">please Enter Vaild Number</div>'
                    },

                    offerCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddOfferForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddOfferForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addOffer.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addOffer_spinner").show();
                        $("#addOffer_submit").hide();
                    },

                    complete: function () {
                        $("#addOffer_spinner").hide();
                        $("#addOffer_submit").show();
                    }

                }).done(function (data) {

                    $('#addOfferResult').html(data);
                    $('#addOfferResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddOfferForm')[0].reset();

                });
            }

        });



        /*
         *  End Function Add Offer
         */













        /*
         * Start Function Update Offer
         */



        $(function () {

            $('#updateOfferForm').validate({

                rules: {

                    offerTitle: {
                        required: true
                    },

                    offerPrice: {

                        required: true,
                        number: true
                    },

                    offerCategory: {

                        required: true
                    }


                },

                messages: {

                    offerTitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    offerPrice: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number: '<div style="color: red">please Enter Vaild Number</div>'
                    },

                    offerCategory: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }
                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateOfferForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateOfferForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateOffer.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateOffer_spinner").show();
                        $("#updateOffer_submit").hide();
                    },

                    complete: function () {
                        $("#updateOffer_spinner").hide();
                        $("#updateOffer_submit").show();
                    }

                }).done(function (data) {

                    $('#updateOfferResult').html(data);
                    $('#updateOfferResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateOfferResult').hide();

                    },2500);

                });
            }

        });



        /*
         * End Function Update Offer
         */
















        /*
         * Start Function Delete Offer
         */


        $('.confirmDeleteOffer').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Offer'))

            {
                var offerID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:offerID},
                    url: '../admin_dashboard/deleteOffer.php'


                }).done(function (data) {

                    $('#offers_result').html(data);
                    $('#offers_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#offers_result').hide();
                        location.reload();

                    }, 2500);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         * End Function Delete Offer
         */
















        /*
         * Start Function Add Client Ticket
         */



        $(function () {

            $('#AddClientTicketForm').validate({

                rules: {

                    clientName: {
                        required: true
                    },


                    clientPhoneNumber: {

                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    },

                    clientServiceType: {

                        required: true
                    },


                    clientCity: {

                        required: true
                    },

                    clientStatus: {

                        required: true
                    }
                },

                messages: {
                    clientName: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientPhoneNumber: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number: '<div style="color: red">please Enter Vaild Number</div>',
                        minlength: '<div style="color: red">please Enter Vaild Mobile Phone Number</div>',
                        maxlength: '<div style="color: red">please Enter Vaild Mobile Phone Number</div>'
                    },

                    clientServiceType: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientCity: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientStatus: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddClientTicketForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddClientTicketForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addClientTicket.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addClientTicket_spinner").show();
                        $("#addClientTicket_submit").hide();
                    },

                    complete: function () {
                        $("#addClientTicket_spinner").hide();
                        $("#addClientTicket_submit").show();
                    }

                }).done(function (data) {

                    $('#addClientTicket_Result').html(data);
                    $('#addClientTicket_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddClientTicketForm')[0].reset();

                });
            }

        });





        /*
         * End Function Add Client Ticket
         */











       /*
        * Start Function Update Client Ticket
        */





        $(function () {

            $('#updateClientTicketForm').validate({

                rules: {

                    clientName: {
                        required: true
                    },


                    clientPhoneNumber: {

                        required: true,
                        number: true,
                        minlength: 11,
                        maxlength: 11
                    },

                    clientServiceType: {

                        required: true
                    },


                    clientCity: {

                        required: true
                    },

                    clientStatus: {

                        required: true
                    }


                },

                messages: {

                    clientName: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientPhoneNumber: {

                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        number: '<div style="color: red">please Enter Vaild Number</div>',
                        minlength: '<div style="color: red">please Enter Vaild Mobile Phone Number</div>',
                        maxlength: '<div style="color: red">please Enter Vaild Mobile Phone Number</div>'
                    },

                    clientServiceType: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientCity: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    clientStatus: {

                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateClientTicketForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateClientTicketForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateClientTicket.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateClientTicket_spinner").show();
                        $("#updateClientTicket_submit").hide();
                    },

                    complete: function () {
                        $("#updateClientTicket_spinner").hide();
                        $("#updateClientTicket_submit").show();
                    }

                }).done(function (data) {

                    $('#updateClientTicket_Result').html(data);
                    $('#updateClientTicket_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateClientTicket_Result').hide();

                    },2500);

                });
            }

        });






        /*
         * End Function Update Client Ticket
         */
















           /*
            * Start Function Delete Client Ticket
            */




        $('.confirmDeleteClientTicket').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Ticket'))

            {
                var ticketID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:ticketID},
                    url: '../admin_dashboard/deleteClientTicket.php'


                }).done(function (data) {

                    $('#clientTickets_result').html(data);
                    $('#clientTickets_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#clientTickets_result').hide();
                        location.reload();

                    }, 2500);

                });


            }

            else

            {
                // Do nothing!
            }

        });



            /*
             * End Function Delete  Client Ticket
             */












            /*
             *  Start Function Add client Note
             */




            $(function () {

                $('#AddClientNoteForm').validate({

                    rules: {

                        clientNote: {
                            required: true
                        }
                    },

                    messages: {


                        clientNote: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        }

                    },


                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `help-block` class to the error element
                        error.addClass( "help-block" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                    }


                });

            });




            $('#AddClientNoteForm').on('submit',function (event) {

                event.preventDefault();

                if($('#AddClientNoteForm').valid())

                {
                    $.ajax({

                        url: '../admin_dashboard/addClientNote.php',
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        beforeSend: function () {
                            $("#addClientNote_spinner").show();
                            $("#addClientNote_submit").hide();
                        },

                        complete: function () {
                            $("#addClientNote_spinner").hide();
                            $("#addClientNote_submit").show();
                        }

                    }).done(function (data) {

                        $('#addClientNote_Result').html(data);
                        $('#addClientNote_Result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#AddClientNoteForm')[0].reset();

                    });
                }

            });



            /*
             *  End Function Add client Note
             */

















            /*
             * Start Function Delete Client Note
             */



            $('.confirmDeleteClientNote').click(function (event) {

                event.preventDefault();

                if (confirm('Are you sure you want to Delete This Note'))

                {
                    var noteID = $(this).attr('id');

                    $.ajax({


                        method: 'GET',
                        data: {id:noteID},
                        url: '../admin_dashboard/deleteNote.php'


                    }).done(function (data) {

                        $('#clientNotes_result').html(data);
                        $('#clientNotes_result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#clientNotes_result').hide();
                            location.reload();

                        }, 2500);

                    });


                }

                else

                {
                    // Do nothing!
                }

            });




            /*
             * End Function Delete Client Note
             */











            /*
             *  Start Function Add Web Design Single Faq
             */




            $(function () {

                $('#AddWebDesignForm').validate({

                    rules: {

                        webDesignFaqQuestion: {
                            required: true
                        },

                        webDesignFaqAnswer: {

                            required: true
                        }

                    },

                    messages: {

                        webDesignFaqQuestion: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        },

                        webDesignFaqAnswer: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        }

                    },


                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `help-block` class to the error element
                        error.addClass( "help-block" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                    }


                });

            });




            $('#AddWebDesignForm').on('submit',function (event) {

                event.preventDefault();

                if($('#AddWebDesignForm').valid())

                {
                    $.ajax({

                        url: '../admin_dashboard/addWebDesignFaq.php',
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        beforeSend: function () {
                            $("#addWebDesignFaq_spinner").show();
                            $("#addWebDesignFaq_submit").hide();
                        },

                        complete: function () {
                            $("#addWebDesignFaq_spinner").hide();
                            $("#addWebDesignFaq_submit").show();
                        }

                    }).done(function (data) {

                        $('#addWebDesignFaq_Result').html(data);
                        $('#addWebDesignFaq_Result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#AddWebDesignForm')[0].reset();

                    });
                }

            });




            /*
             *  End Function Add Web Design Single Faq
             */












            /*
             * Start Function Update Web Design single Faq
             */




            $(function () {

                $('#updateWebDesignForm').validate({

                    rules: {

                        webDesignFaqQuestion: {
                            required: true
                        },

                        webDesignFaqAnswer: {

                            required: true
                        }

                    },

                    messages: {

                        webDesignFaqQuestion: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        },

                        webDesignFaqAnswer: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        }

                    },


                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `help-block` class to the error element
                        error.addClass( "help-block" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                    }


                });

            });




            $('#updateWebDesignForm').on('submit',function (event) {

                event.preventDefault();

                if($('#updateWebDesignForm').valid())

                {
                    $.ajax({

                        url: '../admin_dashboard/updateWebDesignFaq.php',
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        beforeSend: function () {
                            $("#updateWebDesignFaq_spinner").show();
                            $("#updateWebDesignFaq_submit").hide();
                        },

                        complete: function () {
                            $("#updateWebDesignFaq_spinner").hide();
                            $("#updateWebDesignFaq_submit").show();
                        }

                    }).done(function (data) {

                        $('#updateWebDesignFaq_Result').html(data);
                        $('#updateWebDesignFaq_Result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#updateWebDesignFaq_Result').hide();

                        },3000);

                    });
                }

            });



            /*
             * End Function Update Web Design single Faq
             */














            /*
             *  Start Function Delete Web Design Single Faq
             */



            $('.confirmDeleteWebDesignFaq').click(function (event) {

                event.preventDefault();

                if (confirm('Are you sure you want to Delete This FAQ'))

                {
                    var webDesignFaqID = $(this).attr('id');

                    $.ajax({


                        method: 'GET',
                        data: {id:webDesignFaqID},
                        url: '../admin_dashboard/deleteWebDesignFaq.php'


                    }).done(function (data) {

                        $('#webDesignFaqs_result').html(data);
                        $('#webDesignFaqs_result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#webDesignFaqs_result').hide();
                            location.reload();

                        }, 2000);

                    });


                }

                else

                {
                    // Do nothing!
                }

            });



            /*
             *  End Function Delete Web Design Single Faq
             */
















            /*
             * Start Function Add Hosting Single Faq
             */





            $(function () {

                $('#AddHostingForm').validate({

                    rules: {

                        hostingFaqQuestion: {
                            required: true
                        },

                        hostingFaqAnswer: {

                            required: true
                        }

                    },

                    messages: {

                        hostingFaqQuestion: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        },

                        hostingFaqAnswer: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        }

                    },


                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `help-block` class to the error element
                        error.addClass( "help-block" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                    }


                });

            });




            $('#AddHostingForm').on('submit',function (event) {

                event.preventDefault();

                if($('#AddHostingForm').valid())

                {
                    $.ajax({

                        url: '../admin_dashboard/addHostFaq.php',
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        beforeSend: function () {
                            $("#addHostingFaq_spinner").show();
                            $("#addHostingFaq_submit").hide();
                        },

                        complete: function () {
                            $("#addHostingFaq_spinner").hide();
                            $("#addHostingFaq_submit").show();
                        }

                    }).done(function (data) {

                        $('#addHostingFaq_Result').html(data);
                        $('#addHostingFaq_Result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        $('#AddHostingForm')[0].reset();

                    });
                }

            });





        /*
         * End Function Add Hosting Single Faq
         */












        /*
         *  Start Function Update Hosting Single Faq
         */




            $(function () {

                $('#updateHostingForm').validate({

                    rules: {

                        hostingFaqQuestion: {
                            required: true
                        },

                        hostingFaqAnswer: {

                            required: true
                        }

                    },

                    messages: {

                        hostingFaqQuestion: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        },

                        hostingFaqAnswer: {
                            required: '<div style="color: red">please Enter Vaild Input</div>'
                        }


                    },


                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `help-block` class to the error element
                        error.addClass( "help-block" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.parent( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                    }


                });

            });




            $('#updateHostingForm').on('submit',function (event) {

                event.preventDefault();

                if($('#updateHostingForm').valid())

                {
                    $.ajax({

                        url: '../admin_dashboard/updateHostingFaq.php',
                        type: 'POST',
                        data:  new FormData(this),
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        beforeSend: function () {
                            $("#updateHostingFaq_spinner").show();
                            $("#updateHostingFaq_submit").hide();
                        },

                        complete: function () {
                            $("#updateHostingFaq_spinner").hide();
                            $("#updateHostingFaq_submit").show();
                        }

                    }).done(function (data) {

                        $('#updateHostingFaq_Result').html(data);
                        $('#updateHostingFaq_Result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#updateHostingFaq_Result').hide();

                        },2500);

                    });
                }

            });




        /*
         *  End Function Update Hosting Single Faq
         */













        /*
         *  Start Function Delete Hosting Faq Single Faq
         */





        $('.confirmDeleteHostingFaq').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This FAQ'))

            {
                var hostingID = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:hostingID},
                    url: '../admin_dashboard/deleteHostingFaq.php'


                }).done(function (data) {

                    $('#hotingFaqs_result').html(data);
                    $('#hotingFaqs_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#hotingFaqs_result').hide();
                        location.reload();

                    }, 2000);

                });


            }

            else

            {
                // Do nothing!
            }

        });




        /*
         *  End Function Delete Hosting Faq Single Faq
         */















        /*
         * Start Function Add Emarketing Single Faq
         */






        $(function () {

            $('#AddEmarketingForm').validate({

                rules: {

                    emarketingFaqQuestion: {
                        required: true
                    },

                    emarketingFaqAnswer: {

                        required: true
                    }

                },

                messages: {

                    emarketingFaqQuestion: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    emarketingFaqAnswer: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddEmarketingForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddEmarketingForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addEmarketingFaq.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#addEmarketingFaq_spinner").show();
                        $("#addEmarketingFaq_submit").hide();
                    },

                    complete: function () {
                        $("#addEmarketingFaq_spinner").hide();
                        $("#addEmarketingFaq_submit").show();
                    }

                }).done(function (data) {

                    $('#addEmarketingFaq_Result').html(data);
                    $('#addEmarketingFaq_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddEmarketingForm')[0].reset();

                });
            }

        });






        /*
         * End Function Add Emarketing Single Faq
         */












        /*
         * Start Function Update Emarketing Single Faq
         */




        $(function () {

            $('#updateEmarketingForm').validate({

                rules: {

                    emarketingFaqQuestion: {
                        required: true
                    },

                    emarketingFaqAnswer: {

                        required: true
                    }

                },

                messages: {

                    emarketingFaqQuestion: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    emarketingFaqAnswer: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateEmarketingForm').on('submit',function (event) {

            event.preventDefault();

            if($('#updateEmarketingForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateEmarketingFaq.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateEmarketingFaq_spinner").show();
                        $("#updateEmarketingFaq_submit").hide();
                    },

                    complete: function () {
                        $("#updateEmarketingFaq_spinner").hide();
                        $("#updateEmarketingFaq_submit").show();
                    }

                }).done(function (data) {

                    $('#updateEmarketingFaq_Result').html(data);
                    $('#updateEmarketingFaq_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateEmarketingFaq_Result').hide();

                    },2500);

                });
            }

        });





        /*
         * End Function Update Emarketing Single Faq
         */





















        /*
         * Start Function Delete Emarketing Single Faq
         */



            $('.confirmDeleteEmarketingFaq').click(function (event) {

                event.preventDefault();

                if (confirm('Are you sure you want to Delete This FAQ'))

                {
                    var emarketingID = $(this).attr('id');

                    $.ajax({


                        method: 'GET',
                        data: {id:emarketingID},
                        url: '../admin_dashboard/deleteEmarketingFaq.php'


                    }).done(function (data) {

                        $('#emarketingFaqs_result').html(data);
                        $('#emarketingFaqs_result').show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");

                        window.setTimeout(function(){

                            $('#emarketingFaqs_result').hide();
                            location.reload();

                        }, 2000);

                    });


                }

                else

                {
                    // Do nothing!
                }

            });



        /*
         * End Function Delete Emarketing Single Faq
         */



















        /*
         * Start Function Add TeamWork Section
         */






        $(function () {

            $('#AddTeamWorkSection').validate({

                rules: {

                    teamwork_section_name: {
                        required: true
                    }

                },

                messages: {

                    teamwork_section_name: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }

                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddTeamWorkSection').on('submit',function (event) {

            event.preventDefault();

            if($('#AddTeamWorkSection').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addTeamWorkSection.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#teamwork_section_spinner").show();
                        $("#teamwork_section_submit").hide();
                    },

                    complete: function () {
                        $("#teamwork_section_spinner").hide();
                        $("#teamwork_section_submit").show();
                    }

                }).done(function (data) {

                    $('#add_teamworkSectionResult').html(data);
                    $('#add_teamworkSectionResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddTeamWorkSection')[0].reset();

                });
            }

        });




        /*
         * End Function Add TeamWork Section Single Faq
         */






















        /*
         * Start Update TeamWork Section Function
         */




        $(function () {

            $('#UpdateTeamWorkSection').validate({

                rules: {

                    Update_teamwork_section_name: {
                        required: true
                    }
                },

                messages: {

                    Update_teamwork_section_name: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#UpdateTeamWorkSection').on('submit',function (event) {

            event.preventDefault();

            if($('#UpdateTeamWorkSection').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateTeamWorkSection.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#Update_teamwork_section_spinner").show();
                        $("#Update_teamwork_section_submit").hide();
                    },

                    complete: function () {
                        $("#Update_teamwork_section_spinner").hide();
                        $("#Update_teamwork_section_submit").show();
                    }

                }).done(function (data) {

                    $('#Update_teamworkSectionResult').html(data);
                    $('#Update_teamworkSectionResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#Update_teamworkSectionResult').hide();

                    },2500);

                });
            }

        });





        /*
         * End Update TeamWork Section Function
         */















        /*
         * Start Delete teamwork section Function
         */



        $('.confirmDeleteTeamWorkSection').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Section'))

            {
                var teamWorkSection = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:teamWorkSection},
                    url: '../admin_dashboard/deleteTeamWorkSection.php'


                }).done(function (data) {

                    $('#AllTeamWorkSections_result').html(data);
                    $('#AllTeamWorkSections_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#AllTeamWorkSections_result').hide();
                        location.reload();

                    }, 4000);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         * End Delete TeamWork Section Function
         */












        /*
         * Start Add TeamWork Member Function
         */






        $(function () {

            $('#AddTeamWorkMemberForm').validate({

                rules: {

                    member_name: {
                        required: true
                    },

                    member_section: {
                        required: true
                    },

                    jop_title: {
                        required: true
                    },
                    aboutmember: {
                        required: true,
                        minlength: 20,
                        maxlength: 85
                    }




                },

                messages: {

                    member_name: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    member_section: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    jop_title: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    aboutmember: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">The Minimum Length Of 20 Characters Is Reached</div>',
                        maxlength: '<div style="color: red">The Maximum Length Of 85 Characters Is Reached</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#AddTeamWorkMemberForm').on('submit',function (event) {

            event.preventDefault();

            if($('#AddTeamWorkMemberForm').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/addTeamWorkMember.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#teamWorkMember_spinner").show();
                        $("#teamWorkMember_submit").hide();
                    },

                    complete: function () {
                        $("#teamWorkMember_spinner").hide();
                        $("#teamWorkMember_submit").show();
                    }

                }).done(function (data) {

                    $('#addTeamWorkResult').html(data);
                    $('#addTeamWorkResult').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#AddTeamWorkMemberForm')[0].reset();

                });
            }

        });




        /*
         * End Add TeamWork Member Function
         */






















        /*
         * Start Update TeamWork Member Function
         */




        $(function () {

            $('#updateTeamWorkMember').validate({

                rules: {

                    updateMemberName: {
                        required: true
                    },

                    updateTeamWorkSection: {
                        required: true
                    },

                    updateMemberJopTitle: {
                        required: true
                    },
                    updateAboutMember: {
                        required: true,
                        minlength: 20,
                        maxlength: 85
                    }




                },

                messages: {

                    updateMemberName: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    updateTeamWorkSection: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    updateMemberJopTitle: {
                        required: '<div style="color: red">please Enter Vaild Input</div>'
                    },

                    updateAboutMember: {
                        required: '<div style="color: red">please Enter Vaild Input</div>',
                        minlength: '<div style="color: red">The Minimum Length Of 20 Characters Is Reached</div>',
                        maxlength: '<div style="color: red">The Maximum Length Of 85 Characters Is Reached</div>'
                    }


                },


                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `help-block` class to the error element
                    error.addClass( "help-block" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.parent( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                }


            });

        });




        $('#updateTeamWorkMember').on('submit',function (event) {

            event.preventDefault();

            if($('#updateTeamWorkMember').valid())

            {
                $.ajax({

                    url: '../admin_dashboard/updateTeamWorkMember.php',
                    type: 'POST',
                    data:  new FormData(this),
                    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                    processData: false, // NEEDED, DON'T OMIT THIS

                    beforeSend: function () {
                        $("#updateTeamWorkMember_spinner").show();
                        $("#updateMember_submit").hide();
                    },

                    complete: function () {
                        $("#updateTeamWorkMember_spinner").hide();
                        $("#updateMember_submit").show();
                    }

                }).done(function (data) {

                    $('#updateTeamWorkMember_Result').html(data);
                    $('#updateTeamWorkMember_Result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#updateTeamWorkMember_Result').hide();

                    },2500);

                });
            }

        });





        /*
         * End Update TeamWork Member Function
         */





















        /*
         * Start Delete teamwork Member Function
         */



        $('.confirmDeleteTeamWorkMember').click(function (event) {

            event.preventDefault();

            if (confirm('Are you sure you want to Delete This Member'))

            {
                var teamWorkMember = $(this).attr('id');

                $.ajax({


                    method: 'GET',
                    data: {id:teamWorkMember},
                    url: '../admin_dashboard/deleteTeamWorkMember.php'


                }).done(function (data) {

                    $('#AllTeamWorkMembers_result').html(data);
                    $('#AllTeamWorkMembers_result').show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");

                    window.setTimeout(function(){

                        $('#AllTeamWorkMembers_result').hide();
                        location.reload();

                    }, 4000);

                });


            }

            else

            {
                // Do nothing!
            }

        });



        /*
         * End Delete TeamWork Member Function
         */

