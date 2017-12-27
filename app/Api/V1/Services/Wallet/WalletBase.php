<?php
namespace App\Api\V1\Services\Wallet;

use App\Wallet;

class WalletBase implements IWallet {
   
   private $statusActive = 'ACTIVE';
   private $statusInactive = 'ACTIVE';
   private $initBalance = 0;
   private $userId;
   
   public function __construct($userId) {
      $this->__set('userId', $userId);
   }
   
   public function initWallet() {
      $model = new Wallet();
      $model->user_id = $this->__get('userId');
      $model->balance = 0;
      $model->status = $this->__get('statusActive');
      return $model->save();
   }
   
   public function __set($name, $value) {
      return $this->$name = $value;
   }
   
   public function __get($name) {
      return $this->$name;
   }
   
   public function destroyWallet(){}
}