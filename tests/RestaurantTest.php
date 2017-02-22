<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Restaurant.php";
require_once "src/Cuisine.php";

$server = 'mysql:host=localhost:8889;dbname=restaurant_guide_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RestaurantTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Cuisine::deleteAll();
        Restaurant::deleteAll();
    }

    function test_getters()
    {
        // Arrange
        $id=1;
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name,$id);
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id,$id);

        // Act
        $result = array(
            $test_restaurant->getRestaurantName(),
            $test_restaurant->getPrice(),
            $test_restaurant->getDescription(),
            $test_restaurant->getIdCuisine(),
            $test_restaurant->getId()
        );
        $expected_result = array($restaurant_name,$price,$description,$id,$id);

        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_save()
    {
        // Arrange
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name);
        $test_cuisine->save();
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant->save();

        // Act
        $result = Restaurant::getAll();


        // Assert
        $this->assertEquals($result[0], $test_restaurant);
    }

    function test_getAll()
    {
        // Arrange
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name);
        $test_cuisine->save();
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant->save();
        $restaurant_name2 = "Fancy Mee Sen";
        $price2 = "$$";
        $description2 = "Better than Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant2 = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant2->save();

        // Act
        $result = Restaurant::getAll();


        // Assert
        $this->assertEquals($result, [$test_restaurant,$test_restaurant2]);
    }

    function test_UpdateProperty()
    {
        // Arrange
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name);
        $test_cuisine->save();
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant->save();
        $id = $test_restaurant->getId();
        $restaurant_name_update = "Fancy Mee Sen";
        $test_restaurant->updateProperty("restaurant_name",$restaurant_name_update);
        $price_update = "$$";
        $test_restaurant->updateProperty("price",$price_update);
        $description_update = "Better than Good enough thai food";
        $test_restaurant->updateProperty("description",$description_update);


        // Act
        $result_restaurant = Restaurant::getAll();
        $result = array(
            $result_restaurant[0]->getRestaurantName(),
            $result_restaurant[0]->getPrice(),
            $result_restaurant[0]->getDescription(),
            $result_restaurant[0]->getIdCuisine(),
            $result_restaurant[0]->getId()
        );
        $expected_result = array($restaurant_name_update,$price_update,$description_update,$id_cuisine,$id);

        // Assert
        $this->assertEquals($result, $expected_result);
    }

    function test_findRestaurant()
    {
        // Arrange
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name);
        $test_cuisine->save();
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant->save();

        // Act
        $result =  Restaurant::findRestaurant($test_restaurant->getId());

        // Assert
        $this->assertEquals($result, $test_restaurant);
    }

    function test_findRestaurantByProperty()
    {
        // Arrange
        $cuisine_name = 'Thai';
        $test_cuisine = new Cuisine ($cuisine_name);
        $test_cuisine->save();
        $restaurant_name = "Mee Sen";
        $price = "$";
        $description = "Good enough thai food";
        $id_cuisine=$test_cuisine->getId();
        $test_restaurant = new Restaurant($restaurant_name,$price,$description,$id_cuisine);
        $test_restaurant->save();

        // Act
        $result =  Restaurant::findRestaurantByProperty("restaurant_name", "Mee Sen");

        // Assert
        $this->assertEquals($result[0], $test_restaurant);
    }







}

?>
