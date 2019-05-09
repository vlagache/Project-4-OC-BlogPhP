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
   public function header()
   {
     $template = $this->template;
     header('Location:' . HOST . $template);


   }
}
