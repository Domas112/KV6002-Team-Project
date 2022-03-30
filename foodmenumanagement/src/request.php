<?php

class Request
{
    private $path;
    private $basepath = FOODMENUMANAGEMENT_BASEPATH;

    public function __construct()
    {
        $this->setPath();
    }

    private function setPath(){
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        $this->path = str_replace($this->basepath, "", $this->path);
        $this->path = trim($this->path,"/");
        $this->path = strtolower($this->path);
    }

    public function getPath(){
        return $this->path;
    }
}