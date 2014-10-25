<?php

namespace Acme\DataGridDemoBundle\Controller;

use Acme\DataGridBundle\Services\Request\DataGridRequestFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // Get Request Object
        $req=DataGridRequestFactory::getInstance($request);
        //initialize datagrid object
        $dataGrid = $this->get('datagrid.datagrid_service')->getDataGrid("AcmeDataGridBundle:TestUserAddress", $req);
        //render datagrid
        return $this->render('AcmeDataGridDemoBundle:Default:datagrid_index.html.twig', array('datagrid' => $dataGrid));
    }
}
