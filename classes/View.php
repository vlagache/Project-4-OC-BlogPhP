<?php

class View
{
   private $template;

   public function __construct($template)
   {
     $this->template = $template;
   }

   public function render($data = array())
   {
     extract($data);
     $template = $this->template;

     ob_start();
     include (VIEW.$template.'.php');
     $content = ob_get_clean();
     require(VIEW.'template.php');

   }
   /**
    * [header header('Location:') does not work on 1&1 , use of a JS script]
    * @return [String] [description]
    */
   public function header()
   {
     $template = $this->template;
     // header('Location:' . HOST . $template);
     if ($template == null)
     {
       echo '<script>window.location.href=""+"'.HOST.'"+"";</script>';
     } else
     {
       echo '<script>window.location.href=""+"'.HOST.$template.'"+"";</script>';
     }
   }
}
