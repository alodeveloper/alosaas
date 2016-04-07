<?php
namespace App\Libraries;

use Request;
use Session;
/**
 * Account utilities
 */
class Account
{
  public function url($url, $parameters = array(), $secure = false)
  {
    $isSubdomain = config('alosaas.isSubdomain', false);
    //$subdomain = Request::get('accounts');

    if(!$isSubdomain) {
      $url = config('alosaas.url', '') . $url;
    }
    return url($url, $parameters, $secure);
  }

  public function current($currentAccount = false)
  {
    if($currentAccount) {
      Session::put('currentAccount', $currentAccount);  
    }
    return Session::get('currentAccount');
  }

}
