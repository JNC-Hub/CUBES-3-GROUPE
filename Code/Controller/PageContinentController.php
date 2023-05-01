<?php>
class ImageController {
  private $model;

  public function __construct($model) {
    $this->model = $model;
  }

  public function showImages() {
    $images = $this->model->getImages();
    require_once('view/PageContinentModel.php');
  }
}
