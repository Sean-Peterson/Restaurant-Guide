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
    protected function tearDown()
    {
        Cuisine::deleteAll();
    }

    function test_getters()
    {
        // Arrange
        $id = 1;
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name,$id);

        // Act
        $result = array($test_cuisine->getId(), $test_cuisine->getCuisineName());
        $expected_result = array(1, 'Thai');

        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_save()
    {
      // Arrange
      $cuisine_name = 'Thai';
      $test_cuisine = new Cuisine ($cuisine_name);
      $test_cuisine->save();

      // Act
      $result = Cuisine::getAll();

      // Assert
      $this->assertEquals($result[0],$test_cuisine);
    }

    function test_getAll()
    {
      // Arrange
      $cuisine_name = 'Thai';
      $cuisine_name2 = 'Mexican';
      $test_cuisine = new Cuisine ($cuisine_name);
      $test_cuisine->save();
      $test_cuisine2 = new Cuisine ($cuisine_name2);
      $test_cuisine2->save();

      // Act
      $result = Cuisine::getAll();

      // Assert
      $this->assertEquals($result,[$test_cuisine,$test_cuisine2]);
    }


}

?>
