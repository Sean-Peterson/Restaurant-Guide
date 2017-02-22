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

            // need to write save, getall, deleteall to pass next tests.
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


    }
?>
