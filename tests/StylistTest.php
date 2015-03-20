<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Stylist::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = 'Jenny';
            $id = null;
            $test_stylist = new Stylist($name, $id);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setId()
        {
          $name = 'Tim';
          $id = null;
          $test_stylist = new Stylist($name, $id);

          $test_stylist->setId(2);

          $result = $test_stylist->getId();
          $this->assertequals(2, $result);
        }

        function test_getId()
        {
          $name = 'Jenny';
          $id = 1;
          $test_stylist = new Stylist($name, $id);

          $result = $test_stylist->getId();

          $this->assertEquals(1, $result);
        }

        function test_save()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $result = Stylist::getAll();

          $this->assertEquals($test_stylist, $result[0]);
        }

        function test_getAll()
        {
          $name = 'Jenny';
          $id = null;
          $name2 = 'JennyDos';
          $id2 = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();
          $test_stylist2 = new Stylist($name2, $id2);
          $test_stylist2->save();

          $result = Stylist::getAll();

          $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function test_deleteAll()
        {
          $name = 'Jenny';
          $id = null;
          $name2 = 'JennyDos';
          $id2 = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();
          $test_stylist2 = new Stylist($name2, $id2);
          $test_stylist2->save();

          Stylist::deleteAll();
          $result = Stylist::getAll();

          $this->assertEquals([], $result);
        }

        function test_findStylist()
        {
          $name = 'Jenny';
          $id = 1;
          $name2 = 'JennyDos';
          $id2 = 2;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();
          $test_stylist2 = new Stylist($name2, $id);
          $test_stylist2->save();

          $result = Stylist::findStylist($test_stylist->getId());

          $this->assertEquals($test_stylist, $result);
        }

        function test_getClients()
        {
          $name = 'Jenny';
          $id = null;
          $test_stylist = new Stylist($name, $id);
          $test_stylist->save();

          $test_stylist_id = $test_stylist->getId();

          $client_name = "Tim";
          $test_client = new Client($client_name, $id, $test_stylist_id);
          $test_client->save();

          $client_name2 = "Tom";
          $test_client2 = new Client($client_name2, $id, $test_stylist_id);
          $test_client->save();

          $result = $test_stylist->getClients();

          $this->assertEquals([$test_client, $test_client2], $result);  
        }
    }

?>
