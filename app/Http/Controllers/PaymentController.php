<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use App\Models\Transactions;
use App\Models\fm\FundraiserPagesModel;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;


class PaymentController extends Controller
{
    public function __construct()
    {

    /** PayPal api context **/
            $paypal_conf = \Config::get('paypal');
            $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
            );
            $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function payWithpaypal(Request $request)
    {

        $descWithSlug = $request->slug.'/'.$request->description;

        if($request->amount == 'other')
        {
            $donation_amount = $request->otheramount;
        } else {
            $donation_amount = $request->amount;
        }
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        

        $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($donation_amount);
        $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setDescription($descWithSlug);
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('/donation/status')) /** Specify return URL **/
                    ->setCancelUrl(URL::to('/donation/status'));

        $payment = new Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                /** dd($payment->create($this->_api_context));exit; **/
                try {
        $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
        if (\Config::get('app.debug')) {
        \Session::put('error', 'Connection timeout');
            return Redirect::route('paywithpaypal');
        } else {
        \Session::put('error', 'Some error occur, sorry for inconvenient');
            return Redirect::route('paywithpaypal');
        }
        }
        foreach ($payment->getLinks() as $link) {
        if ($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
                        break;
        }
        }
        /** add payment ID to session **/
                Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
        /** redirect to paypal **/
                    return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
                return Redirect::route('paywithpaypal');
        }

        public function getPaymentStatus(Request $request)
    {

        $payment_id = Session::get('paypal_payment_id');
        // Session::forget('paypal_payment_id');
        if (empty($request->Input('PayerID')) || empty($request->Input('token'))) {
        \Session::put('error', 'Payment failed');
            return redirect('/');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->Input('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        $jsonResult = $result->toJSON();
        $result_decoded = json_decode($jsonResult);

        // Txn Details
        $txnData = array(
            'txn_id' => $result_decoded->id,
            'amount' => $result_decoded->transactions[0]->amount->total,
            'currency' => $result_decoded->transactions[0]->amount->currency,
            'description' =>  $result_decoded->transactions[0]->description,
            'payerName' => $result_decoded->payer->payer_info->first_name.' '. $result_decoded->payer->payer_info->last_name,
            'payerEmail' => $result_decoded->payer->payer_info->email,
        );

        if ($result->getState() == 'approved') {
        \Session::put('success', 'Payment success');
        $this->saveOrder($txnData);
        return redirect('/');
        }
        \Session::put('error', 'Payment failed');
        return redirect('/');
    }

    protected function saveOrder($data)
    {
        // echo $data->slug;
        // dd($data);
        $desc = explode('/',$data['description']);
        $details = FundraiserPagesModel::where('slug','=',@$desc[0])
        ->select('fundraiser','student')
        ->first();

        // Commision Calculation

        $comission_amount = $data['amount'] / 100 * env('commision');
        $amountWithCommision = $data['amount'] - $comission_amount;

        $txn = new Transactions;
        $txn->txn_id = $data['txn_id'];
        $txn->fundraiser = $details->fundraiser;
        $txn->student = $details->student;
        $txn->amount_donated = $data['amount'];
        $txn->comission_amount = $comission_amount;
        $txn->amountWithoutComission = $amountWithCommision;
        $txn->payerName = $data['payerName'];
        $txn->payerEmail = $data['payerEmail'];
        $txn->currency = $data['currency'];
        $txn->description = @$desc[1];
        $txn->payment_method = 'Paypal';

        $txn->save();
        return redirect()->back();
    }


}
