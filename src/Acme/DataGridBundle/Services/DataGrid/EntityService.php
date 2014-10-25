<?php

namespace Acme\DataGridBundle\Services\DataGrid;

use Acme\DataGridBundle\Services\Request\BaseDataGridRequest;
use Acme\DataGridBundle\Services\Utils\EntityFieldUtil;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * This class is used to load entity data for the data grid
 * Class EntityService
 * @package Acme\DataGridBundle\Services\DataGrid
 */
class EntityService {

    private $className;

    /* @var EntityManager  */
    private $em;

    /* @var ClassMetadata*/
    private $classMetadata;

    private $fieldMetadata;

    private $entityData;

    public function __construct($doctrine)
    {
        $this->em = $doctrine->getManager();
    }

    public function init($className)
    {
        $this->className = $className;
        $this->classMetadata = $this->em->getClassMetadata($this->className);
    }

    /**
     * Get field infomation from doctrine class metadata
     * @return array
     */
    public function getFieldMetadata()
    {
        $this->fieldMetadata = array();

        foreach ($this->classMetadata->getFieldNames() as $name) {
            $mapping = $this->classMetadata->getFieldMapping($name);

            $this->fieldMetadata[] = array('fieldName' => $mapping['fieldName'], 'type' => $mapping['type']);
        }
        return $this->fieldMetadata;

    }

    /**
     * Get Total Number of Rows
     * @return mixed
     */
    public function getTotalDataCount()
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('count(d)')->from($this->className, 'd');

        $count = $qb->getQuery()->getSingleScalarResult();

        return $count;

    }

    /**
     * load raw ORM table data into array
     * @param BaseDataGridRequest $request
     * @return array
     */
    public function loadData(BaseDataGridRequest $request)
    {
        $order = $request->getData('order');
        $dir = $request->getData('dir');
        $limit = $request->getData('limit');
        $page = $request->getData('page');

        $orderCriteria = array();
        if ($order && $dir) {
            $orderCriteria = array($order => $dir);
        }

        $this->entityData = $this->em->getRepository($this->className)
            ->findBy(array(), $orderCriteria, $limit, ($page - 1) * $limit);


        return $this->entityData;
    }

    /**
     * Generate simple array for frontend display
     * @return array
     */
    public function toSimpleArray()
    {
        if ($this->entityData && $this->fieldMetadata && count($this->entityData) > 0) {
            $res = array();

            foreach ($this->entityData as $row) {
                $r = array();
                foreach ($this->fieldMetadata as $field) {
                    $func = EntityFieldUtil::getEntityGetterName($field['fieldName']);
                    $r[$field['fieldName']] = $row->$func();
                }
                $res[] = $r;
            }
            return $res;
        }

    }
} 