<?php

    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Client::deleteAll();
        }

        function test_getId()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $result = $test_client->getId();

          $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $test_client->setId(2);

          $result = $test_client->getId();
          $this->assertEquals(2, $result);
        }

        function test_getStylistId()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $result = $test_client->getStylistId();

          $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
                {
        $name = 'Jenny';
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $client_name = 'Tim';
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($client_name, $id, $stylist_id);

        $test_client->save();

        $result = Client::getAll();
        $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $client_name2 = 'Tom';
          $test_client2 = new Client($client_name2, $id, $stylist_id);
          $test_client2->save();

          $result = Client::getAll();

          $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $client_name2 = 'Tom';
          $test_client2 = new Client($client_name2, $id, $stylist_id);
          $test_client2->save();

          Client::deleteAll();

          $result = Client::getAll();
          $this->assertEquals([], $result);
        }

        function test_findClient()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $client_name = 'Tim';
          $stylist_id = $test_stylist->getId();
          $test_client = new Client($client_name, $id, $stylist_id);
          $test_client->save();

          $client_name2 = 'Tom';
          $test_client2 = new Client($client_name2, $id, $stylist_id);
          $test_client2->save();

          $result = Client::findClient($test_client->getId());

          $this->assertEquals($test_client,$result);

        }

    }
?>
