<?php
// simple class to throw a user exception
class SimpleClass {
   public function boom() {
      throw new Exception('Threw an exception.');
   }
}
$sc = new SimpleClass();
$sc->boom();
?>