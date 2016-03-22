<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * facade class for accesing account related utilities
 */
class Account extends Facade
{

  protected static function getFacadeAccessor() { return 'account'; }

}
