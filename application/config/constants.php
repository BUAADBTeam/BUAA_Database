<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('shop', 1);

//Register.php
define('scRegistered', 0);
define('failedEmail', 1);
define('errorInfo', 2);
define('incompleteInfo', 3);
define('invalidEmail', 4);
define('invalidName', 5);
define('validEmail', 6);
define('validName', 7);

//Database.php
define('emptyWhere', 1);
define('noColomnFound', 2);

//Orderm.php
define('userMode', 1);
define('shopMode', 2);
define('deliveryMode', 3);
define('orderCreated', 0);
define('orderSubmitted', 1);
define('orderPaid', 2);
define('orderAcceped', 3);
define('orderAllocated', 4);
define('orderStartDelivery', 5);
define('orderCompleted', 6);


//Accessm.php
define('userId', 1);
define('shopId', 2);
define('deliveryId', 3);
define('visitorId', 0);