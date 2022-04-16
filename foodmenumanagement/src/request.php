<?php

/**
 * request.php
 * The PHP class has implemented several getter and setter to handle the variables. The class will be used to retrieve
 * the path and parameter from the URL. The class will also get the request method of the API.
 *
 * @author Teck Xun Tan W20003691
 */

class Request
{
    private $path;
    private $admin_basepath = FOODMENUMANAGEMENT_BASEPATH;
    private $cust_basepath = FOODMENU_BASEPATH;
    private $err_basepath = ERROR_BASEPATH;

    /**
     * Default constructor to set the $path to their respective base path
     */
    public function __construct($mode)
    {
        if($mode == "admin"){
            //Set path to admin base path
            $this->setPath($this->admin_basepath);

        }else if($mode == "customer"){
            //Set path to customer base path
            $this->setPath($this->cust_basepath);

        }else if($mode == "error"){
            //Set path to error base path
            $this->setPath($this->err_basepath);
        }

        //Set the header
        $this->setHeader();
    }

    /**
     * setPath
     * The setter method to process and set the URL path to an appropriate value.
     */
    private function setPath($path){
        //Retrieving the path of the URL
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];

        //Sanitising the URL
        $this->path = str_replace($path, "", $this->path);
        $this->path = trim($this->path,"/");
        $this->path = strtolower($this->path);
    }

    /**
     * getPath
     * The getter method to retrieve the path variable.
     */
    public function getPath(){
        //Return the path variable
        return $this->path;
    }

    /**
     * setHeader
     * The setter method to change the header to the appropriate header. For example, if the website is requesting
     * for API call, the header should change the header into displaying content in JSON format.
     */
    private function setHeader(){
        //Setting the header
        header("Access-Control-Allow-Origin: *");

        if(substr($this->getPath(),0,3) !== "api") {
            //Set the content type to HTML if the path does not contain "api"
            header("Content-Type: text/html; charset=UTF-8");
        }else{
            //Set the content type to JSON if the path contain "api"
            header("Content-Type: application/json; charset=UTF-8");
        }
    }
}