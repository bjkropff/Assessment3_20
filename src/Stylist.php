<?php
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

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

        static function deleteAll()
        {
          $GLOBALS['DB']->exec('DELETE FROM stylist *;');
        }

        static function findStylist($search_id)
        {
          $found_stylist = null;
          $stylists = Stylist::getAll();
          foreach($stylists as $stylist){
            $stylist_id = $stylist->getId();
            if($stylist_id == $search_id){
              $found_stylist = $stylist;
            }
          }
          return $found_stylist;
        }

        function getClients()
        {
          $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE stylist_id = {$this->getId()};");
          $clients = array();
          foreach($returned_clients as $client) {
            $client_name = $client['client_name'];
            $id = $client['id'];
            $stylist_id = $client['stylist_id'];
            $new_client = new Client($client_name, $id, $stylist_id);
            array_push($clients, $new_client);
          }
          return $clients;
        }

        function update($new_name)
        {
          $GLOBALS['DB']->exec("UPDATE stylist SET name = '{$new_name}' WHERE id = {$this->getId()}");
          $this->setName($new_name);
        }

        function delete()
        {
          $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
          $GLOBALS['DB']->exec("DELETE FROM client WHERE stylist_id = {$this->getId()};");
        }
    }

?>
