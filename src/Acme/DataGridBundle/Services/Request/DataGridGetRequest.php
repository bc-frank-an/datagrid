<?php

namespace Acme\DataGridBundle\Services\Request;


class DataGridGetRequest extends BaseDataGridRequest {

    public function getRequestType()
    {
        return "GET";
    }

    protected function initRequestData()
    {
        $page=$this->request->query->get('page')?$this->request->query->get('page'):1;
        $limit=$this->request->query->get('limit')?$this->request->query->get('limit'):10;
        $orderBy=$this->request->query->get('orderBy')?$this->request->query->get('orderBy'):null;
        $dir=$this->request->query->get('dir')?$this->request->query->get('dir'):null;

        if ($limit < 0) $limit = 10;
        if ($page < 0) $page = 1;

        $this->setData('page',$page);
        $this->setData('limit',$limit);
        $this->setData('order',$orderBy);
        $this->setData('dir',$dir);
    }

} 