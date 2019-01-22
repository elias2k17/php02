<?php

require 'vendor/autoload.php';
require 'classes/mygallery.php';

// Routing
$page = 'home';
if (isset($_GET['p'])) {
  $page = $_GET['p'];
}

// Template rendering.
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader);
$gallery = new MyGallery($twig, "images/");


try {
  switch ($page) {
    case "home":
      $gallery->ShowHome();
      break;
    case "gallery":
      $gallery->ShowGallery();
      break;
    case "image":
      if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];
        $gallery->ShowImage($id);
      }
      break;
    default:
      $gallery->ShowPage404();
      break;
  }
} catch (Exception $e) {
  die("ERROR: " . $e->getMessage());
}