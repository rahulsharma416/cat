<?php

namespace App\Api\V1\Controllers;

use Log;
use Config;
use App\Utils;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\JobRequest;
use App\JobRequests;
use App\Bill;
use App\User;
use App\JobLog;
use \Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BillController extends Controller
{	
   
   /**
    * @SWG\Post(
    *    tags={"Bills"},
    *    path="/bills/:{page?}",
    *    description="Gets you all the Job Requests with Pending status for a Manufacturer",
    *    @SWG\Parameter(
    *       name="id",
    *       in="query",
    *       type="string",
    *       required=true,
    *       description="The User Id for whome we need to find the Job Requests"
    *    ),
    *    @SWG\Response(
    *       response=200,
    *       description="Retrieved dataset"
    *    ),
    *    security={
    *       {
    *          "token": {"send:token"}
    *       }
    *    }
    * )
    */
   public function getBills() {
      $pageResponse = [];
      $bills = Bill::select(['amount_pending', 'amount_paid', 'total_amount'])->get();
      $page = 1;
      $count = 0;
      $pageResponse['status'] = 'success';
      $pages = intval($bills->count() / 5);
      if(intval($bills->count() % 5) > 0) 
          ++$pages;
      $pageResponse['no_of_pages'] = $pages;
      foreach($bills as $bill){
         $pageResponse['Page' . $page][] = $bill;
         ++$count;
         if($count > 4) {
             $count = 0;
             ++$page;
         }
      }
      return (response()->json($pageResponse));
   } 
}
