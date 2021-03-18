<?php


/**
 * Description of mysqli
 *
 * @author syam
 */


class webinty_mysql

{
    private $connection;
    private $last; //last query [result]


    public function __construct()

    {
        $this->dbconnect();
        $this->Execute('SET NAMES utf8');
        $this->connection->set_charset("utf8");
    }



    public function idAfterInsert()

    {
        $idAfterInserted = $this->connection->insert_id;
        return $idAfterInserted;
    }



    public function dbconnect()

    {

        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if($this->connection)
            return TRUE;

        return FALSE;
    }





    public function Execute($query)
    {
        //$query = $this->connection->real_escape_string($query);
        if($result = $this->connection->query($query))
        {
            $this->last = $result;
            return TRUE;
        }
        return FALSE;
    }



    public function Execute_Multi($query)
    {
        //$query = $this->connection->real_escape_string($query);
        if($result = $this->connection->multi_query($query))
        {
            $this->last = $result;
            return TRUE;
        }
        return FALSE;
    }



    public function GetRows()
    {
        $result = array();
        $rows   = $this->NumRows();
        for($i = 0;$i<$rows;$i++)
        {
            $result[] = $this->last->fetch_assoc();
        }
        if(count($result) > 0)
            return $result;

        $this->last->free();

        return NULL;
    }


    public function GetRow()
    {
        $result = array();
        $rows   = $this->NumRows();
        for($i = 0;$i<$rows;$i++)
        {
            $result[] = $this->last->fetch_assoc();
        }
        if(count($result) > 0)
            return $result[0];

        $this->last->free();

        return NULL;
    }



    public function NumRows()
    {
        return $this->last->num_rows;
    }


    public function AffectedRows()
    {
        return $this->connection->affected_rows;
    }


    /**
     * Count Results in Table
     * @param type $table
     */
    public function Select_Count($table,$extra = '')
    {
        $this->Execute("SELECT COUNT(*) FROM `$table` $extra");
        $count = $this->GetRow();
        return $count['COUNT(*)'];
    }



    /**
     * Inserting row into database
     * @param string $table
     * @param array $data
     * @return boolean
     */
    public function Insert($table,$data)
    {

        // setup some variables for fields and values
        $fields  = '';
        $values = '';
        // populate them
        foreach ($data as $f => $v)
        {
            $fields  .= "`$f`,";
            $values .= ( is_numeric( $v ) && ( intval( $v ) == $v ) ) ? $v."," : "'$v',";
        }

        // remove our trailing ,
        $fields = substr($fields, 0, -1);
        // remove our trailing ,
        $values = substr($values, 0, -1);

        $querystring = "INSERT INTO `{$table}` ({$fields}) VALUES({$values})";
        //echo $querystring;
        //Check If Row Inserted
        if($this->Execute($querystring))
            return TRUE;

        return FALSE;
    }

    /**
     *
     * @param string $from
     * @param string $where
     * @return boolean
     */
    public function Delete($from,$where)
    {
        $query = sprintf('DELETE FROM `%s` %s',$from,$where);
        // echo $query;
        $result = $this->Execute($query);
        if($result && $this->AffectedRows()>0)
            return TRUE;

        return FALSE;
    }



    /**
     *
     * @param string $table
     * @param string $array
     * @return Boolean
     */
    public function Update($table,$data,$where='')
    {
        //set $key = $value :)

        $query  = '';
        foreach ($data as $f => $v) {
            (is_numeric($v) && intval($v) == $v || is_float($v))? $v."," : "'$v' ,";
            $query  .= "`$f` = '{$v}' ,";
        }

        //Remove trailing ,
        $query = substr($query, 0,-1);

        $querystring = "UPDATE `{$table}` SET {$query} {$where}";
        //echo $querystring;
        $update = $this->Execute($querystring);
        if($update)
            return TRUE;

        return FALSE;
    }



    public function Last()
    {
        return $this->connection->insert_id;
    }



    /**
     * Deconstructor :)
     */
    public function __destruct() {
        $this->connection->close();
    }
}
