<?php


namespace Acme\DataGridBundle\Twig\Extension;


use Acme\DataGridBundle\Services\DataGrid\DataGridService;

class DataGridExtension extends \Twig_Extension {

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
            'datagrid_rows' => new \Twig_Function_Method($this, 'getDataGridRows', array('is_safe' => array('html'))));
    }

    public function getName()
    {
        return "data_grid_extension";
    }


    public function dataGrid(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid', array('dg' => $dataGrid,'title'=>$dataGrid->getEntityName()));

    }

    public function getDataGridRows(DataGridService $dataGrid)
    {
        return $this->renderBlock('grid_rows', array('rowData' => $dataGrid->getData()));

    }

    protected function renderBlock($name, $parameters)
    {
        return $this->environment
            ->loadTemplate($this->templateName)
            ->renderBlock($name, array_merge($this->environment->getGlobals(), $parameters));

    }
}