<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;
use \PayPal\Api\Payer;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Exception\PayPalConnectionException;
use \PayPal\Api\PaymentExecution;
use Cart;
use App\Services\VentaService;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = Config::get('paypal');
        $this->apiContext = New ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        ); 

        $this->apiContext->setConfig($paypalConfig['settings']);
    }


    public function payWithPaypal($monto){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($monto);
        $amount->setCurrency('MXN');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect()->route('cart.checkout')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            VentaService::storeVenta(Cart::getContent(), Auth::id());
            Cart::clear();
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect()->route('cart.checkout')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect()->route('cart.checkout')->with(compact('status'));
    }
}
