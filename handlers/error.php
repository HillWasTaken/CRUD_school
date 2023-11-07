<?php
global $errorMessage;
function exceptionHandler($exc): void
{
  $errorMessage = $exc->getMessage();
  var_dump($exc);
}

set_exception_handler('exceptionHandler');
