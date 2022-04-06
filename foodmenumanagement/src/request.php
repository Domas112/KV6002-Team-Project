<?php

class Request
{
    private $path;
    private $admin_basepath = FOODMENUMANAGEMENT_BASEPATH;
    private $cust_basepath = FOODMENU_BASEPATH;
    private $err_basepath = ERROR_BASEPATH;

    public function __construct($mode)
    {
        if($mode == "admin"){
            $this->setPath($this->admin_basepath);
        }else if($mode == "customer"){
            $this->setPath($this->cust_basepath);
        }else if($mode == "error"){
            $this->setPath($this->err_basepath);
        }

        $this->setResponse();
    }

    private function setPath($path){
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = str_replace($path, "", $this->path);
        $this->path = trim($this->path,"/");
        $this->path = strtolower($this->path);
    }

    private function setResponse(){
        if(substr($this->getPath(),0,3) !== "api") {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: text/html; charset=UTF-8");
        }else{
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
        }
    }

    public function getPath(){
        return $this->path;
    }
}