<?php
session_start();
function is_valid(): bool
{
  $expireTime = $_SESSION["expireStamp"];
  // If expire time is after current time the session is still valid
  return $expireTime >= time();
}

/**
 * If session has expired then it will be destroyed.
 * Else it will be extended
 */
function try_extend_timer()
{
  if (!is_valid()) {
    session_destroy();
    header("location: ./");
    return;
  }

  $_SESSION["expireStamp"] = time() + 3600;
}
