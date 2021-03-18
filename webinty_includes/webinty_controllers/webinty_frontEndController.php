<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/08/2017
 * Time: 05:43 م
 */
class webinty_frontEndController extends webinty_adminController

{

    /*
     * Home page Function
     */


    public function HomePage()

    {

        $pageTitle = "الرئيسيه :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();

        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/slider.html');
        include (WEBINTY_VIEWS.'/webinty_front/home.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }




    public function corporate_website_design()

    {

        $pageTitle = "تصميم موقع شركه احترافي :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/corporate_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }





    public function ecommerce_website_design()

    {

        $pageTitle = "انشاء متجر الكتروني :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/eCommerce_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }








    public function medical_website_design()

    {

        $pageTitle = "تصميم موقع طبي لعياده او مستشفي :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/medical_wesite_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }









    public function realestate_website_design()

    {

        $pageTitle = "تصميم موقع عقاري لشركات التسويق العقاري وشركات التطوير العقاري  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();

        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/realestate_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function travel_website_design()

    {

        $pageTitle = "تصميم موقع سياحي لشركات السياحه لحجز الرحلات  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();

        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/travel_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function magazine_website_design()

    {

        $pageTitle = "تصميم موقع إخباري - تصميم موقع مجله أو جريده الكترونيه  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();



        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/magazine_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }






    public function education_website_design()

    {

        $pageTitle = "تصميم موقع تعليمي - تصميم موقع مدرسة - تصميم موقع جامعة  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/education_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function resturant_website_design()

    {

        $pageTitle = "تصميم موقع مطعم وتوصيل وجبات الطعام  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/resturant-website-design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }





    public function furniture_website_design()

    {

        $pageTitle = "تصميم موقع شركه اثاث أو شركه ديكورات داخليه  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/furniture_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }




    public function transport_website_design()

    {

        $pageTitle = "تصميم موقع شركه نقل وشحن  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/transport_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }




    public function lawyer_website_design()

    {

        $pageTitle = "تصميم موقع محامي لمكاتب الاستشارات القانونيه  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/lawyer_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }





    public function training_center_website_design()

    {

        $pageTitle = "تصميم موقع لمركز تدريب  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();



        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/training_center_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }



    public function landing_page_website_design()

    {

        $pageTitle = "تصميم موقع صفحه واحده - صفحه هبوط Landing Page  :: ويب ينتى";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/landing_page_website_design.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }






    public function internet_website_design_service()

    {

        $pageTitle = "خدمات تصميم مواقع انترنت وبرمجه المواقع :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/internet_website_design_service.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }





    public function internet_marketing_service()

    {

        $pageTitle = "خدمات تسويق الكتروني - تنفيذ وادارة حمله اعلانيه على الانترنت :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();



        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include(WEBINTY_VIEWS . '/webinty_front/internet_marketing_service.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }






    public function internet_marketing_google_ads()

    {

        $pageTitle = "اعلانات جوجل ادوردز Google Adwords :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();



        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/internet_marketing_google_ads.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }





    public function internet_marketing_facebook_ads()

    {

        $pageTitle = "اعلانات الفيسبوك Facebook Ads - من افضل الشركات التسويق علي الفيس بوك :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/internet_marketing_facebook_ads.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }



    public function internet_marketing_seo()

    {

        $pageTitle = "تحسين المواقع لمحركات البحث search engine optimization :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/internet_marketing_search_engine_optimization.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }






    public function programming_php_website()

    {

        $pageTitle = "برمجه مواقع انترنت برمجه مواقع خاصه php :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/programming_php_website.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }




    public function hosting_page()

    {

        $pageTitle = "استضافة مواقع - خدمات استضافة المواقع - شركه استضافة مواقع :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/hosting_page.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }



    public function about_us_page()

    {

        $pageTitle = "نبذه عن شركة ويب ينتي لتصميم وبرمجة المواقع :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/about_us_page.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function our_team_page()

    {

        $pageTitle = "فريق العمل :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all team
        $teamWorkMembers      = new webinty_teamWorkModel();
        $members              = $teamWorkMembers->getAllMembersDescending();



        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();


        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/our_team_page.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function contact_us_page()

    {

        $pageTitle = "تواصل معنا :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();

        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/contact_us_page.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }







    public function faq_page()

    {

        $pageTitle = "الاسئلة الشائعة :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();


        // All FAQ Categories
        $faqCategories    = new webinty_faqCategoriesModel();
        $categories       = $faqCategories->getAllFaqCategories();

        $allfaqs             = new webinty_faqModel();

        // all faqs
        $faqs                = $allfaqs->getAllFAQs();

        $NumberOfAllFaqs     = $allfaqs->getNumberOfAllFaqs();


        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/FAQ.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');

    }






    public function offers_page()
    {
        $pageTitle = "عروض  :: ويب ينتي";


        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();



        // view
        include (WEBINTY_VIEWS.'/webinty_front/header.html');
        include (WEBINTY_VIEWS.'/webinty_front/offers.html');
        include (WEBINTY_VIEWS.'/webinty_front/footer.html');
    }







    public function offer_page()
    {




        // all public information Data
        $publicInfomation = new webinty_publicInfoModel();
        $publicData       = $publicInfomation->getAllInformatiosData();


        // all offer categories
        $allOfferCategories = new webinty_offerCategoriesModel();
        $offerCategories    = $allOfferCategories->getAllOfferCategories();




        $connection                           = $allOfferCategories->connect;

        $offerCategoryIdFromUrl               = (isset($_GET['categoryId']))? (int)$_GET['categoryId']:0;

        $offerCategoryId                      = mysqli_real_escape_string($connection,$offerCategoryIdFromUrl);

        // category by id
        $offerCategoryById                    = $allOfferCategories->getCategory($offerCategoryId);


        // all offers
        $offersModel  = new webinty_offerModel();
        $offers = $offersModel->getOffersByCategory($offerCategoryId);


        $pageTitle = $this->getPageTitle($offerCategoryById,'offer_category_seo_title','ويب ينتي','Page Not Found :: 404 | webinty');


        // view


        if(count($offerCategoryById)>0)
        {
            include (WEBINTY_VIEWS.'/webinty_front/header.html');
            include(WEBINTY_VIEWS . '/webinty_front/offer.html');
            include (WEBINTY_VIEWS.'/webinty_front/footer.html');
        }
        else
        {
            include(WEBINTY_VIEWS . '/webinty_front/page-404.html');
        }





    }






}