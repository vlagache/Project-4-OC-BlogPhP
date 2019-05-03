<?php

class ThumbnailController
{
  public function upload()
  {
    $chapterManager = new ChapterManager();
    $statusChapters = $chapterManager->showStatus('chapters');


    if ($_FILES['thumbnail']['error'] > 0 )
    {
      throw new Exception('Erreur lors du chargement de la miniature');
    } else
    {
      $name = basename($_FILES["thumbnail"]["name"]); // alaskaMiniature.jpg
      $elements = explode('.',$name); // alaskaMiniature & jpg
      $elements[0] .= $statusChapters['Auto_increment']; // alaskaMiniature10
      $nameUpFile = implode('.',$elements); // alaskaMiniature10.jpg


      $tmp_name = $_FILES['thumbnail']['tmp_name'];
      $destination = 'assets/images/thumbnails';

      move_uploaded_file($tmp_name,$destination . '/' . $nameUpFile);
      $directoryImg = $destination .'/'.$nameUpFile;
      $this->resize($directoryImg,$nameUpFile);
      unlink($directoryImg);
      return $nameUpFile;

    }
  }
  protected function resize($directory,$nameImg) // $image doit etre une directory
  {
    // $image = 'assets/images/thumbnails/circlecities7.jpg';
    $im_php = imagecreatefromjpeg($directory);
    $ximg = imagesx($im_php); // 2000
    $yimg = imagesy($im_php); // 1000
    $sizeMin = min($ximg, $yimg);
    $sizeMax = max($ximg,$yimg);

    if ( $ximg / $yimg < 1.5 )
    {
      $im_php = imagecrop($im_php, ['x' => 0 , 'y' => 0, 'width' => $sizeMax , 'height' => $sizeMax/1.5]);
    } else
    {
      $im_php = imagecrop($im_php, ['x' => 0 , 'y' => 0, 'width' => $sizeMin*1.5 , 'height' => $sizeMin]);
    }

    $im_php = imagescale($im_php, 400,265);
    imagejpeg($im_php,'assets/images/GD/'.$nameImg);


  }
}
