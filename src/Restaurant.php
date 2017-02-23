<?php
    class Restaurant
    {
            private $restaurant_name;
            private $price;
            private $description;
            private $id_cuisine;
            private $id;

            function __construct($restaurant_name, $price, $description, $id_cuisine, $id=null)
            {
                $this->restaurant_name = $restaurant_name;
                $this->price = $price;
                $this->description = $description;
                $this->id_cuisine = $id_cuisine;
                $this->id = $id;
            }
            function getRestaurantName()
            {
              return $this->restaurant_name;
            }
            function getPrice()
            {
              return $this->price;
            }
            function getDescription()
            {
              return $this->description;
            }
            function getIdCuisine()
            {
              return $this->id_cuisine;
            }
            function getId()
            {
              return $this->id;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM restaurants;");
            }

            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name, price, description, id_cuisine) VALUES ('{$this->restaurant_name}','{$this->price}','{$this->description}',{$this->id_cuisine});");
                $this->id = $GLOBALS['DB']->lastInsertId();
            }

            static function getAll()
            {
                $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
                $restaurants = array();
                foreach ($returned_restaurants as $restaurant)
                {
                    $new_restaurant = new Restaurant($restaurant['restaurant_name'],$restaurant['price'], $restaurant['description'],$restaurant['id_cuisine'],$restaurant['id']);
                    array_push($restaurants,$new_restaurant);
                }
                return $restaurants;
            }

            // methods to update single cuisine
            function updateProperty($property, $update_value)
            {
                $GLOBALS['DB']->exec("UPDATE restaurants SET {$property}='{$update_value}' where id = {$this->getId()};");
                $this->$property = $update_value;
            }
            // function updateCusineName($update_value)
            // {
            //     $GLOBALS['DB']->exec("UPDATE restaurant SET restaurant_name ='{$update_value}' where id = {$this->getId()};");
            //     $this->restaurant_name = $update_value;
            // }


            // method to delete single restaurant
            function deleteRestaurant()
            {
                $GLOBALS['DB']->exec("DELETE FROM restaurants where id = {$this->id};");
            }

            // method to find single restaurant by id
            static function findRestaurant($id)
            {
                $find_results = $GLOBALS['DB']->query("SELECT * FROM restaurants where id = {$id};");
                $found_restaurant = null;
                foreach($find_results as $result){
                    $found_restaurant = new Restaurant($result['restaurant_name'],$result['price'], $result['description'],$result['id_cuisine'],$result['id']);
                }
                return $found_restaurant;
            }

            static function findRestaurantByProperty($property, $search_value)
            {
                $find_results = $GLOBALS['DB']->query("SELECT * FROM restaurants where {$property} = '{$search_value}';");
                $found_restaurants = array();
                foreach($find_results as $result){
                    $found_restaurant = new Restaurant($result['restaurant_name'],$result['price'], $result['description'],$result['id_cuisine'],$result['id']);
                    array_push($found_restaurants, $found_restaurant);
                }
                return $found_restaurants;
            }

            // method to return all restaurants of given cuisine


    }
?>
