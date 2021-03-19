<?php

namespace App\Http\Controllers;

use App\Models\Disburse;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
class DisburseController extends Controller
{
    public function index()
    {
        $disburses = Disburse::all();
        return $disburses;
    }

    public function store($disbursement)
    {
        $disburse = new Disburse();
        $disburse->id = $disbursement->id;
        $disburse->amount = $disbursement->amount;
        $disburse->status = $disbursement->status;
        $disburse->timestamp = $disbursement->timestamp;
        $disburse->bank_code = $disbursement->bank_code;
        $disburse->account_number = $disbursement->account_number;
        $disburse->beneficiary_name = $disbursement->beneficiary_name;
        $disburse->remark = $disbursement->remark;
        $disburse->receipt = $disbursement->receipt;
        $disburse->time_served = strtotime($disbursement->time_served) < 0 ? null : $disbursement->time_served;
        $disburse->fee = $disbursement->fee;
        $disburse->save();

        return $disburse;
    }

    public function getDisburseById($id) {
      $guzzle = new HttpClient();
      try{
        $reqDisburse = $guzzle->get(
            env('SBIG_FLIP_BASE_URL').'disburse/'.$id,
            [
              'headers' => [
                  'Authorization' => 'Basic '.env('SBIG_FLIP_TOKEN'),
              ],
            ]
          );

        if ($reqDisburse->getStatusCode() == 200) {
          print_r(json_decode($reqDisburse->getBody()));
        }
      } catch (RequestException $ex) {
        if ($ex->hasResponse()) {
            try {
                $response= $ex->getResponse()->getBody()->getContents();
                $responseJSON = json_decode($response,true);
                print_r(response(['msg' => $responseJSON], 400));
            } catch (\Throwable $th) {}
        }
        print_r(response(['msg' =>$ex->getMessage()], 400));
      }
    }

    public function postDisbursement() {
        $guzzle = new HttpClient();
        try{
          $reqDisburse = $guzzle->post(
              env('SBIG_FLIP_BASE_URL').'disburse',
              [
                'headers' => [
                    'Authorization' => 'Basic '.env('SBIG_FLIP_TOKEN'),
                    "Content-Type" => "application/x-www-form-urlencoded",
                ],
                'form_params' => [
                    "bank_code" => "bca",
                    "account_number" => 1234567890,
                    "amount" => 100000,
                    "remark" => "penarikan oleh xxx"
                ]
              ]
            );
  
          if ($reqDisburse->getStatusCode() == 200) {
              $disburse = $this->store(json_decode($reqDisburse->getBody()));
              print_r($disburse);exit;
          }
        } catch (RequestException $ex) {
          if ($ex->hasResponse()) {
              try {
                  $response= $ex->getResponse()->getBody()->getContents();
                  $responseJSON = json_decode($response,true);
                  print_r(response(['msg' => $responseJSON], 400));
              } catch (\Throwable $th) {}
          }
          print_r(response(['msg' =>$ex->getMessage()], 400));
        }
      }
}
