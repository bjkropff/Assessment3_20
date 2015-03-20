<?php

      $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

      class Client
      {
        private $client_name;
        private $id;
        private $stylist_id;

        function __construct($client_name, $id = null, $stylist_id)
        {
          $this->client_name = $client_name;
          $this->id = $id;
          $this->stylist_id = $stylist_id;
        }

        function getClientName()
        {
          return $this->client_name;
        }

        function setClientName($new_client_name)
        {
          $this->client_name = (string) $new_client_name;
        }

        function getId()
        {
          return $this->id;
        }

        function setId($new_id)
        {
          $this->id = (int) $new_id;
        }

        function getStylistId()
        {
          return $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
          $this->stylist_id = (int) $new_stylist_id;
        }

        function save()
        {
          $statement = $GLOBALS['DB']->query("INSERT INTO client (client_name, stylist_id) VALUES ('{$this->getClientName()}', {$this->getStylistId()}) RETURNING id;");
          $result = $statement->fetch(PDO::FETCH_ASSOC);
          $this->setId($result['id']);
        }

        static function getAll()
        {
          $returned_clients = $GLOBALS['DB']->query('SELECT * FROM client;');

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

        static function deleteAll()
        {
          $GLOBALS['DB']->exec('DELETE FROM client *;');
        }


      }
?>
