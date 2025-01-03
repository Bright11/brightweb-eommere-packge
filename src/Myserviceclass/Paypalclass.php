<?php

namespace Brightweb\Ecommerce\Myserviceclass;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Paypalclass
{
    /**
     * Create a new class instance.
     */
    protected $clientId;
    protected $clientSecret;
    protected $apiUrl;
    public function __construct()
    {
        //
        $this->clientId=config("brightwebconfig.paypal.client_id");
        $this->clientSecret=config("brightwebconfig.paypal.client_secret");
        $this->apiUrl=config("brightwebconfig.paypal.api_url",'https://api.sandbox.paypal.com');
    }

    public function getAccessToken()
    {
        $response=Http::withBasicAuth($this->clientId, $this->clientSecret)->asForm()->post("{$this->apiUrl}/v1/oauth2/token",[
            'grant_type'=>'client_credentials'
        ]);

        return $response->json()['access_token']?? null;
    }

    public function createPaypalOrder($amount)
    {
        $accessToken = $this->getAccessToken();
        $response= Http::withToken($accessToken)->post("{$this->apiUrl}/v2/checkout/orders",[
            'intent'=>'CAPTURE',
            'purchase_units'=>[[
                'amount'=>[
                    'currency_code'=>'USD',
                    'value'=>$amount,
                ],
            ]],
            'application_context'=>[
                'return_url'=>route("paypal.successPaypal"),
                'cancel_url'=>route("paypal.cancel"),
            ],
        ]);
        return $response->json();
    }

    public function captureOrder($orderId, $payerId)
    {
        $accessToken=$this->getAccessToken();
        $response=Http::withToken($accessToken)->post("{$this->apiUrl}/v2/checkout/orders/{$orderId}/capture",[
            'payer_id'=>$payerId,
        ]);

        if(!$response->successful()){
            Log::error("PayPal capture order error " .$response->body());
            abort(500, "Error capture order with Paypal");
        }
        return $response->json();

    }


}
