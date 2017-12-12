<?php

use Propel\Common\Config\ConfigurationManager;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Propel\Runtime\Propel;

// Load the configuration file 
$configManager = new ConfigurationManager( '../propel.php' );

// Set up the connection manager
$manager = new ConnectionManagerSingle();
$manager->setConfiguration( $configManager->getConnectionParametersArray()[ 'default' ] );
$manager->setName('default');

// Add the connection manager to the service container
$serviceContainer = Propel::getServiceContainer();
$serviceContainer->setAdapterClass('default', 'mysql');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setDefaultDatasource('default');

