<?php


namespace Acme\DataGridBundle\Twig\Extension;


use Acme\DataGridBundle\Services\DataGrid\DataGridService;

/**
 * Implementation of data grid twig extension
 * Class DataGridExtension
 * @package Acme\DataGridBundle\Twig\Extension
 */
class DataGridExtension extends \Twig_Extension
{

    protected $environment;

    protected $templateName;

    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'datagrid' => new \Twig_Function_Method($this, 'dataGrid', array('is_safe' => array('html'))),
            'datagrid_rows' => new \Twig_Function_Method($this, 'getDataGridRows', array('is_safe' => array('html'))),
            'datagrid_header' => new \Twig_Function_Method($this, 'getDataGridHeader', array('is_safe' => array('html'))),
            'datagrid_pagination' => new \Twig_Function_Method($this, 'getDataGridPagination', array('is_safe' => array('html')))
        );

    }

    public function getName()
    {
        return "data_grid_extension";
    }


    public function dataGrid(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid', array('dg' => $dataGrid, 'title' => $dataGrid->getEntityName()));

    }

    public function getDataGridRows(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid_rows', array('rowData' => $dataGrid->getData()));

    }

    public function getDataGridHeader(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid_header', array('headerData' => $dataGrid->getFields()));
    }

    public function getDataGridPagination(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid_pagination', array(
            'total' => $dataGrid->getTotalRows(),
            'totalPages' => $dataGrid->getTotalPages(),
            'currentPage' => $dataGrid->getCurrentpage(),
            'currentLimit' => $dataGrid->getCurrentLimit(),
            'limitList' => $dataGrid->getLimits(),
            'currentOrder' => $dataGrid->getCurrentOrder(),
            'currentDir' => $dataGrid->getCurrentDir()
        ));
    }

    protected function renderBlock($name, $parameters)
    {
        return $this->environment
            ->loadTemplate($this->templateName)
            ->renderBlock($name, array_merge($this->environment->getGlobals(), $parameters));

    }
}