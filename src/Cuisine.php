<?php
    class Cuisine
    {
            private $id;
            private $cuisine_name;

            function __construct($id = null, $cuisine_name)
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



    }
?>
