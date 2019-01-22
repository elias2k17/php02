<?php
class MyGallery {
	private $twigEngine;
	private $dir_images;
	static private $image_list = array();

	public function __construct(Twig_Environment $engine, $img){
		$this->twigEngine = $engine;
		$this->dir_images = $img;
	}

	public function ShowHome() {
		$values = array(
			'page' => array('title' => 'Home page',),
			'person' => array('name' => '%username%'));
		echo $this->twigEngine->render('home.twig', $values);
	}

	public function FillImageList() {
		$img_list = scandir($this->dir_images);
		$img_list_full_path = array();
		$count_img = count($img_list) - 2;
		if ($count_img == 0) {
			$values = array("images" => array());
		} else {
			$j = 0;
			for($i = 2; $i <= $count_img + 1; $i++) {
				$img_list_full_path[$j] = "/" . $this->dir_images . $img_list[$i];
				$j++;
			}
			$values = array("images" => $img_list_full_path);
		}
		$this::$image_list = $values;
		return $values;
	}

	public function ShowGallery() {
		$this->FillImageList();
		echo $this->twigEngine->render('gallery.twig', $this::$image_list);
	}

	public function ShowImage($id) {
		$this->FillImageList();
		$img_src = $this::$image_list["images"][$id - 1];
		$value = array();
		if (isset($img_src)) {
			$value = array("image" => array("src" => $img_src));
		}
		echo $this->twigEngine->render('image.twig', $value);
	}

	public function ShowPage404() {
		header('HTTP/1.0 404 Not Found');
		echo $this->twigEngine->render('404.twig');
	}
}