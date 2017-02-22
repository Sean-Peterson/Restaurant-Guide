<?php
    class Animal
    {
            private $id;
            private $type_id;
            private $breed;
            private $name;
            private $gender;
            private $admittance_date;

            function __construct($id = null, $type_id, $breed, $name, $gender, $admittance_date)
            {
                $this->id = $id;
                $this->type_id = $type_id;
                $this->breed = $breed;
                $this->name = $name;
                $this->gender = $gender;
                $this->admittance_date = $admittance_date;
            }
            function setBreed($new_breed)
            {
              $this->breed = (string) $new_breed;
            }
            function getBreed()
            {
              return $this->breed;
            }


    }
?>
