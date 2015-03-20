<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
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

        function test_getId()
        {
          $name = 'Jenny';
          $id = 1;
          $test_stylist = new Stylist($name, $id);

          $result = $test_stylist->getId();

          $this->assertEquals(1, $result);
        }
    }

?>
