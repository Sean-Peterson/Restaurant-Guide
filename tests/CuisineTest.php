<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Cuisine.php";

$server = 'mysql:host=localhost:8889;dbname=restaurant_guide_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class CuisineTest extends PHPUnit_Framework_TestCase
{
    // protected function tearDown()
    // {
    //     Cuisine::deleteAll();
    // }

    function test_getters()
    {
        // Arrange
        $id = 1;
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($id, $cuisine_name);

        // Act
        $result = array($test_cuisine->getId(), $test_cuisine->getCuisineName());
        $expected_result = array(1, 'Thai');

        // Assert
        $this->assertEquals($result, $expected_result);

    }


}

?>
