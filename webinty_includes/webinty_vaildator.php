<?php


//validation
class validation
{

    private $_errors = array();
    private $rules   = array();

    /**
     * set validation rules
     * @param $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     *
     * @param $rulesString
     * @return array
     */
    public function getMethods($rulesString)
    {
        //required|min:333|max:23030|email
        $allRules = explode('|',$rulesString);

        $newRulesArray = array();

        foreach($allRules as $rule)
        {
            $newRulesArray[] = explode(':',$rule);
        }

        return $newRulesArray;
    }


    /**
     *
     * @return bool
     */
    public function validate()
    {
        /*
         * $this->rules = array(
         *  'username' => 'required|min:333|max:23030',
         *  'email' => 'min'
         * )
         */
        //                        username
        foreach($this->rules as $inputName => $rulesString)
        {
            $rulesArray = $this->getMethods($rulesString);

            foreach($rulesArray as $methodArray)
            {
                $methodName = $methodArray[0];
                //$methodParamer = $methodArray[1];

                if(isset($methodArray[1]))
                    $this->$methodName($inputName,$methodArray[1]);
                else
                    $this->$methodName($inputName);

            }

        }

        if(count($this->_errors)>0)
            return false;


        return true;
    }




    /**
     * add new error to errors array
     * @param $error
     */
    public function addError($error)
    {
        $this->_errors[] = $error;
    }


    /**
     * returns errors array
     * @return array|null
     */
    public function getErrors()
    {
        if(count($this->_errors)>0)
            return $this->_errors;

        return null;
    }


    /**
     * check min number of characters for field
     * @param $inputName
     * @param $min
     * @return bool
     */
    public function min($inputName,$min)
    {
        $input = $_POST[$inputName];

        if(isset($input) && strlen($input)>= $min)
            return true;

        $this->addError('input '.$inputName.' must have '.$min.' characters or more');
        return false;
    }


    /**
     * check max number of characters for field
     * @param $inputName
     * @param $max
     * @return bool
     */
    public function max($inputName,$max)
    {
        $input = $_POST[$inputName];

        if(isset($input) && strlen($input)<= $max)
            return true;

        $this->addError('input '.$inputName.' must have '.$max.' characters or less');
        return false;
    }


    /**
     * check if field has values
     * @param $inputName
     * @return bool
     */
    public function required($inputName)
    {
        $input = $_POST[$inputName];

        if(isset($input) && strlen($input)>0)
            return true;

        $this->addError('input '.$inputName. ' is required');
        return false;
    }


    public function intValue($inputName)
    {
        return (int)$_POST[$inputName];
    }


    /**
     * validate email
     * @param $inputname
     * @return bool
     */
    public function email($inputname)
    {
        $input = $_POST[$inputname];
        if(filter_var($input,FILTER_VALIDATE_EMAIL) === false)
        {
            $this->addError('input '.$inputname.' must be valid email');
            return false;
        }
        return true;
    }

}
