Data Grid Demo
================

This application contains a simple "Data Grid" bundle based on symfony 2.3 and a demonstration of utilizing it against real data entity.

1 Instructions
---------------------

After clone the project, please execute the following command/process:

	
1)  	Install required Symfony vendors using:

    php composer.phar install   
	
2)	Create/modify local database according to /app/config/parameters.yml:

    database_name: datagrid
    database_user: root
    database_password: root

3)      Load testing data by running the test:

    phpunit -c app ./src/Acme/DataGridBundle/Tests/Functional/

4)	Make sure /app/cache and /app/log folders are writable, then open the following url: 

    http://localhost/app_dev.php/datagridDemo

2 Features Implemented
-------------

1)	Showing all data/fields in the provided entity

2)	Max result display and pagination. User can navigate to next/previous page and specify the page number (enter page number in input field and hit enter to load the page).

3)	Order by single column. Click on table header to change the order.


3 Reasons of Approach and Technology
-------------

As a standalone Symfony 2 bundle, the design is aiming to achieve the following goals:

1)	Be able to used with a simple and generic pattern. 

By using Doctrine and Twig Extension, the entire module is accessible with 3 lines of code:

    ###In controller:	
    //YourController.php
    // Get Request Object
    $req=DataGridRequestFactory::getInstance($request);
    //initialize datagrid object
    $dataGrid = $this->get('datagrid.datagrid_service')->getDataGrid("TARGET_ENTITY_NAME", $req);
    //render datagrid
    return $this->render('YOUR_TEMPLATE', array('datagrid' => $dataGrid));

    ###In view:
    //YOUR_TEMPLATE.twig
    {{ datagrid(datagrid) }}
 
2)	Be able to customize in a simple and reusable manner

To customize the view, all the datagrid components are defined through blocks and it can be specified through "dataGridTemplateName" parameter. By default, the "AcmeDataGridBundle:Datagrid:blocks.html.twig" is applied.

All datagrid components are defined as blocks so components can be reused easily.


4 Future Enhancements
-----------

1)	Standardize the way of extending features (say filtering and editing).

Due to time limit, the "DataGridService" and "DataGridExtension" are kind of tight coupled at this stage. A generic interface can be defined to all the functions inside "DataGridExtension->getFunctions", which will make "DataGridExtension" implemented based on the interface of "DataGridService".


2)	Loading related entity

Currenly the related entity collections are not considered. This feature can be implemented in EntitySevice and controller by the view.

3)	Multi-user consistency

When performing functions that alter the entity data, a unique identifier (say a hash value) needs to be stored against table, operation and user session. A force reload is required if the identifier is changed during the previous operation.

4)	Security checking

When performing add/edit actions, all field data needs to be encoded in order to prevent XSS attack.





