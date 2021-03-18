<?php



class webinty_model

{

    private $_errors = array();


    /*
     * add Error
     */

    public function addError($error)

    {
        if(is_array($error))

            $this->_errors = $error;

        else
        $this->_errors[] = $error;
    }


    /*
     * get Errors
     */

    public function getErrors()

    {
        return $this->_errors;
    }

}