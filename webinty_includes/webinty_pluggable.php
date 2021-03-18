<?php
//Plugins :

//Actions :
$actions = array();

/**
 * add new action
 * @param $hook
 * @param $functionName
 */
function add_action($hook,$functionName)
{
    global $actions;
    $actions[$hook][] = $functionName;
}


/**
 * do action
 * @param $hook
 */
function do_action($hook)
{
    global $actions;
    if(isset($actions[$hook]))
    {
        foreach($actions[$hook] as $func)
        {
            if(function_exists($func))
                call_user_func($func);
        }
    }
}



//filters array
$filters = array();



/**
 * add new filter to filters array
 * @param $hook
 * @param $filter
 */
function add_filter($hook,$filter)
{
    global $filters;
    $filters[$hook][] = $filter;
}




/**
 * execute code related to filter
 * @param $hook
 * @param $content
 * @return mixed
 */
function do_filter($hook,$content)
{
    global $filters;
    if(isset($filters[$hook]))
    {
        foreach($filters[$hook] as $filter)
        {
            if(function_exists($filter))
                $content = call_user_func($filter,$content);
        }
    }
    return $content;
}

