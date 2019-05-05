<?php

class ThumbnailController
{
  const DIRECTORY_THUMBNAILS = 'assets/images/thumbnails';

  /**
   * [upload upload image on the server and resizes it]
   * @param  [Int] $idChapter [Chapter number of the thumbnail]
   * @return [String] $nameResizeImg   [Name of the file on the server]
   */
  public function upload($idChapter)
  {
    if ($_FILES['thumbnail']['error'] == 0 )
    {
      $name = basename($_FILES["thumbnail"]["name"]); // alaskaMiniature.jpg
      $elements = explode('.',$name); // alaskaMiniature & jpg
      $elements[0] .= '-'.$idChapter; // alaskaMiniature10
      $nameUpFile = implode('.',$elements); // alaskaMiniature10.jpg


      $tmp_name = $_FILES['thumbnail']['tmp_name'];
      $directoryImg = self::DIRECTORY_THUMBNAILS .'/'.$nameUpFile;

      move_uploaded_file($tmp_name,$directoryImg);
      $nameResizeImg = $this->resize($directoryImg);
      unlink($directoryImg); // Delete first version
      return $nameResizeImg;
    } else
    {
      throw new Exception('Erreur lors du chargement de la miniature');
    }
  }
  /**
   * [remplace Delete the old thumbnail and upload the new one ]
   * @param  [String] $nameImg   [name of the thumbnail to replace ]
   * @param  [Int] $idChapter [Number of chapter to edited]
   * @return [String] $nameResizeImg [name of the new thumbnail on the server]
   */
  public function remplace($nameImg,$idChapter)
  {

    $this->delete($nameImg);
    $nameResizeImg = $this->upload($idChapter);
    return $nameResizeImg;
  }
/**
 * [resize Resize an image with a ratio of 1.5 ( size 400*265 )]
 * @param  [String] $directoryImg [file where the image is located ]
 * @return [String] $nameResizeImg [name of resize Img]
 */
  protected function resize($directoryImg)
  {

    $im_php = imagecreatefromjpeg($directoryImg);
    $ximg = imagesx($im_php); // 2000
    $yimg = imagesy($im_php); // 1000
    $sizeMin = min($ximg, $yimg);
    $sizeMax = max($ximg,$yimg);

    if ( $ximg / $yimg < 1.5 )
    {
      $yStrip = $yimg - ($sizeMax / 1.5);
      $im_php = imagecrop($im_php, ['x' => 0 , 'y' => $yStrip/2, 'width' => $sizeMax , 'height' => $sizeMax/1.5]);
    } else
    {
      $xStrip = $ximg - ( $sizeMin * 1.5 );
      $im_php = imagecrop($im_php, ['x' => $xStrip/2 , 'y' => 0, 'width' => $sizeMin*1.5 , 'height' => $sizeMin]);
    }

    $im_php = imagescale($im_php, 400,265);
    $nameImg = basename($directoryImg);

    $elements = explode('.',$nameImg);
    $elements[0] .= 'R';
    $nameResizeImg = implode('.',$elements);

    imagejpeg($im_php,self::DIRECTORY_THUMBNAILS.'/'.$nameResizeImg);
    return $nameResizeImg;
  }
  /**
   * [delete deletes a thumbnail from the server]
   * @param  [String] $nameImg [Name of the image to be deleted]
   * @return [type]          [description]
   */
  public function delete($nameImg)
  {
    $directoryImg = self::DIRECTORY_THUMBNAILS.'/'.$nameImg;
    unlink($directoryImg);
  }
}
