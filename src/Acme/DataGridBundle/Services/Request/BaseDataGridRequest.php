<?php


namespace Acme\DataGridBundle\Services\Request;

use Symfony\Component\HttpFoundation\Request;

abstract class BaseDataGridRequest {

    protected $request;

    protected $data;

    abstract public function getRequestType();

    abstract protected function initRequestData();

    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->data=array();
        $this->initRequestData();
    }

    public function getData($key)
    {
        if(isset($this->data[$key]))return $this->data[$key];
        return null;
    }

    public function setData($key,$value)
    {
        $this->data[$key]=$value;
    }

} 