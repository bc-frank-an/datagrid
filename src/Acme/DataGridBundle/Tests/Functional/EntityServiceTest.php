<?php

namespace Acme\DataGridBundle\Tests\Functional;


use Acme\DataGridBundle\Entity\TestUserAddress;
use Acme\DataGridBundle\Services\Request\DataGridGetRequest;
use Acme\DataGridBundle\Tests\KernelAwareTest;
use Symfony\Component\HttpFoundation\Request;

class EntityServiceTest extends KernelAwareTest {

    /**
     * @var \Acme\DataGridBundle\Services\DataGrid\EntityService
     */
    private $entityService;


    public function setUp()
    {
        parent::setUp();

        $this->insertTestData();

        $this->entityService = $this->get('datagrid.entity_service');
        $this->entityService->init("AcmeDataGridBundle:TestUserAddress");
    }

    public function testGetFields()
    {
        $fields = $this->entityService->getFieldMetadata();

        $this->assertTrue(count($fields) === 7);

        $this->assertTrue($fields[0]['fieldName'] === 'id');

        $this->assertTrue($fields[0]['type'] === 'integer');

        $this->assertTrue($fields[1]['fieldName'] === 'shortName');

        $this->assertTrue($fields[1]['type'] === 'string');

        $this->assertTrue($fields[2]['fieldName'] === 'address_1');

        $this->assertTrue($fields[2]['type'] === 'string');

        $this->assertTrue($fields[3]['fieldName'] === 'address_2');

        $this->assertTrue($fields[3]['type'] === 'string');

        $this->assertTrue($fields[4]['fieldName'] === 'suburb');

        $this->assertTrue($fields[4]['type'] === 'string');

        $this->assertTrue($fields[5]['fieldName'] === 'state');

        $this->assertTrue($fields[5]['type'] === 'string');

        $this->assertTrue($fields[6]['fieldName'] === 'postcode');

        $this->assertTrue($fields[6]['type'] === 'string');

    }

    public function testLoadDataWithLimit()
    {
        $request=new Request();
        $request->query->set('page',1);
        $request->query->set('limit',15);
        $getReq=new DataGridGetRequest($request);

        $this->entityService->loadData($getReq);

        $this->entityService->getFieldMetadata();

        $arr = $this->entityService->toSimpleArray();

        $this->assertTrue(count($arr) == 15);

    }

    public function testLoadDataWithOrderAsc()
    {
        $request=new Request();
        $request->query->set('page',1);
        $request->query->set('limit',20);
        $request->query->set('orderBy','id');
        $request->query->set('dir','asc');
        $getReq=new DataGridGetRequest($request);

        $this->entityService->loadData($getReq);

        $this->entityService->getFieldMetadata();

        $arr = $this->entityService->toSimpleArray();

        $this->assertTrue(count($arr) == 20);


        $this->assertTrue($arr[0]['id'] == 1);

    }

    public function testLoadDataWithOrderDesc()
    {

        $request=new Request();
        $request->query->set('page',1);
        $request->query->set('limit',20);
        $request->query->set('orderBy','id');
        $request->query->set('dir','desc');
        $getReq=new DataGridGetRequest($request);

        $this->entityService->loadData($getReq);

        $this->entityService->getFieldMetadata();

        $arr = $this->entityService->toSimpleArray();

        $this->assertTrue(count($arr) == 20);


        $this->assertTrue($arr[0]['id'] == 500);

    }

    public function testTotalCount()
    {

        $count = $this->entityService->getTotalDataCount();

        $this->assertTrue($count == 500);

    }


    private function insertTestData()
    {
        $batchSize = 50;

        for ($i = 0; $i < 500; $i++) {
            $record = new TestUserAddress();
            $record->setAddress1("address1_data_#{$i}");
            $record->setAddress2("address2_data_#{$i}");
            $record->setPostcode("postcode_data_#{$i}");
            $record->setShortName("address_#{$i}");
            $record->setState("state_#{$i}");
            $record->setSuburb("suburb_#{$i}");
            $this->entityManager->persist($record);
            if (($i % $batchSize) === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }

        }
        $this->entityManager->flush();
        $this->entityManager->clear();

    }


}
 