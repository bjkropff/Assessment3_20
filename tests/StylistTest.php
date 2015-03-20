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
    }

?>
