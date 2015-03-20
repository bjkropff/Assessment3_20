<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Stylist.php';
    require_once __DIR__.'/../src/Client.php';


    $app = new Silex\Application;
    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path'=>__DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get('/stylist/{id}', function ($id) use ($app) {
      $stylist = Stylist::findStylist($id);
      return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'client' => $stylist->getClients()));
    });

    $app->post('/index', function() use ($app) {
      $stylist = new Stylist($_POST['name']);
      $stylist->save();
      return $app['twig']->render('index.twig', array('stylist' => Stylist::getAll()));
    });

    $app->post('/stylist', function() use ($app) {
      $client_name = $_POST['name'];
      $stylist_id = $_POST['stylist_id'];
      $client = new Client($client_name, $id = null, $stylist_id);
      $client->save();
      $stylist = Stylist::findClient($stylist_id);
      return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'client' => $stylist->getClients()));
    });

    $app->post('/delete_stylist', function() use ($app) {
      Stylist::deleteAll();
      return $app['twig']->render('index.twig');
    });

    $app->post('/delete_client', function() use ($app) {
      Client::deleteAll();
      return $app['twig']->render('stylist.twig');
    });

    $app->get('/stylist/{id}/edit', function($id) use ($app) {
      $stylist = Stylist::findClient($id);
      return $app['twig']->render('stylist_edit.twig', array('stylist' => $stylist));
    });

    $app->patch('/stylist/{id}', function($id) use ($app) {
      $name = $POST['name'];
      $stylist = Stylist::findStylist($id);
      $stylist->update($name);
      return $app['twig']->render('stylist.twig', array('stylist' => $stylist, 'client' => $stylist->getClients()));
    });

    $app->delete('/stylist/{id}', function($id) use ($app) {
      $stylist = Stylist::findStylist($id);
      $stylist->delete();
      return $app['twig']->render('index.twig', array('stylist' => Stylist::getAll()));
    });

    return $app;

?>
