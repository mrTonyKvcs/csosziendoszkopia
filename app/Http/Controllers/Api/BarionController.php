<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarionController extends Controller
{
    public function callback(Request $request)
    {
        require_once app_path('Barion/BarionClient.php');

        $myPosKey = "b847cf2ff72c4f5e9768595a988c9cbb";
        $apiVersion = 2;

        // Test environment
        $environment = \BarionEnvironment::Test;

        $BC = new \BarionClient($myPosKey, $apiVersion, $environment);
        $paymentDetails = $BC->GetPaymentState($request->paymentId);

        //\Log::info(print_r($paymentDetails, true));
        if ($paymentDetails->Status == 'Succeeded') {
            $this->paymentSuccessful($paymentDetails, $request->applicant_id);
        } else {
            \Log::info(print_r('Sikertelen fizetes', true));
        }
    }

    public function paymentSuccessful($details, $applicantId)
    {
        $applicant = \App\Applicant::find($applicantId);
        $applicant->update([
            'payment_id' => $details->PaymentId,
            'payment_request_id' => $details->PaymentRequestId,
            'order_number' => $details->OrderNumber
        ]);
    }
}
