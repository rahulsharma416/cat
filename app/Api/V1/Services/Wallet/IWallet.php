<?php
namespace App\Api\V1\Services\Wallet;

interface IWallet {
   public function initWallet();
   public function destroyWallet();
}