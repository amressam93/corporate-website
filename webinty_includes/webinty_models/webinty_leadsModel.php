<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/05/2017
 * Time: 06:07 م
 */

class webinty_leadsModel extends webinty_model

{

    /*
     * add lead
     */

    public function addLead($leadData)

    {
        if(webinty_system::Get('database')->Insert('leads',$leadData))

            return true;

        return false;
    }



     /*
      * update lead
      */

    public function updateLead($id,$leadData)

    {
        if(webinty_system::Get('database')->Update('leads',$leadData,"WHERE `leads`.`lead_id` = $id"))

            return true;

        return false;
    }




     /*
      * delete lead
      */

    public function deleteLead($id)

    {
        if(webinty_system::Get('database')->Delete('leads',"WHERE `leads`.`lead_id` = $id"))

            return true;

        return false;
    }





     /*
      * get All Leads
      */

    public function getAllLeads($extra = '')

    {
        webinty_system::Get('database')->Execute("SELECT * FROM `leads` $extra");

        if(webinty_system::Get('database')->NumRows()>0)

            return webinty_system::Get('database')->GetRows();

        return [];
    }




     /*
      * get lead by ID
      */

    public function getLead($id)

    {
        $leads = $this->getAllLeads("WHERE `leads`.`lead_id` = $id");

        if (count($leads)>0)

            return $leads[0];

        return [];
    }



    /*
     *  get Number Of leads
     */


    public function getNumberOfLeads()

    {
        $leadsNumber = webinty_system::Get('database')->Select_Count('leads');

        return $leadsNumber;
    }




    /*
     * search lead
     */

    public function searchLead($keyword)

    {
        return $this->getAllLeads("WHERE `leads`.`lead_name` LIKE '%$keyword%' OR `leads`.`lead_email` LIKE '%$keyword%' OR `leads`.`lead_mobile` LIKE '%$keyword%'");
    }

}