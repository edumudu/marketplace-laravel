<?php

namespace App\Payment\PagSeguro;

class Notification
{
  public function getTrasaction()
  {
    if (!\PagSeguro\Helpers\Xhr::hasPost()) throw new \InvalidArgumentException($_POST);

    $response = \PagSeguro\Services\Transactions\Notification::check(
      \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

    return $response;
  }
}