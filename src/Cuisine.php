<?php
    class Cuisine
    {
            private $id;
            private $cuisine_name;

            function __construct($cuisine_name, $id=null)
            {
                $this->id = $id;
                $this->cuisine_name = $cuisine_name;
            }
            function setCuisineName($new_cuisine_name)
            {
              $this->cuisine_name = (string) $new_cuisine_name;
            }
            function getCuisineName()
            {
              return $this->cuisine_name;
            }
            function getId()
            {
              return $this->id;
            }

            static function deleteAll()
            {
                $GLOBALS['DB']->exec("DELETE FROM cuisine;");
            }

            function save()
            {
                $GLOBALS['DB']->exec("INSERT INTO cuisine (cuisine_name) VALUES ('{$this->cuisine_name}');");
                $this->id = $GLOBALS['DB']->lastInsertId();
            }

            static function getAll()
            {
                $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
                $cuisines = array();
                foreach ($returned_cuisines as $cuisine)
                {
                    $new_cuisine = new Cuisine($cuisine['cuisine_name'],$cuisine['id']);
                    array_push($cuisines,$new_cuisine);
                }
                return $cuisines;
            }

            // methods to update single cuisine
            function updateProperty($property, $update_value)
            {
                $GLOBALS['DB']->exec("UPDATE cuisine SET {$property}='{$update_value}' where id = {$this->getId()};");
                $this->$property = $update_value;
            }
            function updateCusineName($update_value)
            {
                $GLOBALS['DB']->exec("UPDATE cuisine SET cuisine_name ='{$update_value}' where id = {$this->getId()};");
                $this->cuisine_name = $update_value;
            }


            // method to delete single cuisine
            function deleteCuisine($id)
            {
                $GLOBALS['DB']->exec("DELETE FROM cuisine where id = {$id};");
            }

            // method to find single cuisine by id
            static function findCuisine()
            {
                $find_result = $GLOBALS['DB']->query("SELECT * FROM cuisine where id = {$id};");
                $found_cuisine = new Cuisine($find_result['cuisine_name'],$find_result['id']);
                return $found_cuisine;
            }

            // method to return all restaurants of given cuisine


    }
?>
