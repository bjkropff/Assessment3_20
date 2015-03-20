<?php
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class Stylist
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name =  $name;
            $this->id = $id;
        }

        function getName()
        {
          return $this->name;
        }

        function setName($new_name)
        {
          $this->name = (string) $new_name;
        }

        function getId()
        {
          return $this->id;
        }

        function setId($new_id)
        {
          $this->id = (int) $new_id;
        }

        function save()
        {
          $statement = $GLOBALS['DB']->query("INSERT INTO stylist (name) VALUES ('{$this->getName()}') RETURNING id;");
          $result = $statement->fetch(PDO::FETCH_ASSOC);
          $this->setId($result['id']);
        }

        static function getAll()
        {
          $returned_stylist = $GLOBALS['DB']->query("SELECT * FROM stylist;");
          $stylist = array();
          foreach($returned_stylist as $current_stylist){
            $name = $current_stylist['name'];
            $id = $current_stylist['id'];
            $new_stylist = new Stylist($name, $id);
            array_push($stylist, $new_stylist);
          }
          return $stylist;
        }
    }

?>
