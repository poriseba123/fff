<?php

namespace app\components;

use Yii;
use Yii\base\Component;
use Yii\base\InvalidConfigException;
use Yii\base\ErrorException;
use Yii\helpers\ArrayHelper;
use Yii\helpers\Url;
use paypalpal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentCard;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;

class Paypal extends Component {

    public $apiClientId;
    public $apiSecretKey;
    public $apiCurrency;
    public $apiContext;

    public function init() {
        parent::init();

        $this->apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential($this->apiClientId, $this->apiSecretKey)
        );
    }

    public function express_checkout($payment_info) {



        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        //------Set item list------

        $item_data = [];
        if (count($item_data) > 0) {
            foreach ($payment_info['item_list'] as $row) {
                $item = new Item();
                $item->setName($row['title'])
                        ->setCurrency($this->apiCurrency)
                        ->setQuantity($row['quantity'])
                        ->setPrice($row['item_price']);

                array_push($item_data, $item);
            }
        }

        $itemList = new ItemList();
        if (count($item_data) > 0) {

            $itemList->setItems($item_data);
        }

        //----Set total amount
        $amount = new Amount();
        $amount->setCurrency($this->apiCurrency)
                ->setTotal($payment_info['total_amount']);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($payment_info['description'])
                ->setInvoiceNumber(uniqid());

        //--------Set redirect urls------
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($payment_info['return_url'])
                ->setCancelUrl($payment_info['cancel_url']);


        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

        $request = clone $payment;


        //--------Create payment url-------
        try {
            $payment->create($this->apiContext);
            $approvalUrl = $payment->getApprovalLink();
            return $approvalUrl;
        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    public function express_success($payment_info) {


        $paymentId = $payment_info['paymentId'];
        $PayerID = $payment_info['PayerID'];
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($PayerID);

        $transaction = new Transaction();
        $amount = new Amount();

        if (isset($payment_info['details']) && count($payment_info['details']) > 0) {


            //------Set payment details
            $details = new Details();
            $details->setShipping($payment_info['details']['shipping'])
                    ->setTax($payment_info['details']['tax'])
                    ->setSubtotal($payment_info['details']['sub_total']);
        }
        $amount->setCurrency($this->apiCurrency);
        $amount->setTotal($payment_info['total_amount']);

        if (isset($payment_info['details']) && count($payment_info['details']) > 0) {
            $amount->setDetails($details);
        }


        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        try {

            $result = $payment->execute($execution, $this->apiContext);


            //----Payment execute
            try {
                $payment = Payment::get($paymentId, $this->apiContext);
                $paymentInformation = [];
                $paymentInformation['transaction_id'] = $payment->id;
                $paymentInformation['cart_id'] = $payment->cart;
                $paymentInformation['invoice_number'] = $payment->transactions[0]->invoice_number;
                $paymentInformation['sale_id'] = $payment->transactions[0]->related_resources[0]->sale->id;
                return $paymentInformation;
            } catch (Exception $ex) {

                print_r($ex);
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {

            $data = json_decode($ex->getData());
            $exception = $data->message;
            $data = [];
            $data['type'] = 'warning';
            $data['message'] = $exception;
            return $data;
        } catch (Exception $ex) {

            print_r($ex);
        }
    }

    public function credit_card($payment_info) {

        //-------Set credit card details
        $card = new PaymentCard();
        $card->setType($payment_info['card']['card_type'])
                ->setNumber($payment_info['card']['card_number'])
                ->setExpireMonth($payment_info['card']['card_expiry_month'])
                ->setExpireYear($payment_info['card']['card_expiry_year'])
                ->setCvv2($payment_info['card']['card_expiry_cvv'])
                ->setFirstName($payment_info['card']['first_name'])
                ->setBillingCountry("US")
                ->setLastName($payment_info['card']['last_name']);

        $fi = new FundingInstrument();
        $fi->setPaymentCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

        //--------Set item list
        $item_data = [];
        if (count($item_data) > 0) {
            foreach ($payment_info['item_list'] as $row) {
                $item = new Item();
                $item->setName($row['title'])
                        ->setDescription($row['description'])
                        ->setCurrency($this->apiCurrency)
                        ->setQuantity($row['quantity'])
                        ->setTax($row['tax'])
                        ->setPrice($row['item_price']);

                array_push($item_data, $item);
            }
        }

        $itemList = new ItemList();
        if (count($item_data) > 0) {

            $itemList->setItems($item_data);
        }

        //--------Set payment details--------
        $details = new Details();
        $details->setShipping($payment_info['details']['shipping'])
                ->setTax($payment_info['details']['tax'])
                ->setSubtotal($payment_info['details']['sub_total']);

        $amount = new Amount();
        $amount->setCurrency($this->apiCurrency);
        $amount->setTotal($payment_info['total_amount']);
        $amount->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($payment_info['description'])
                ->setInvoiceNumber(uniqid());

        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            //------Execute payment
            $payment->create($this->apiContext);
            return $payment;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {

            $data = json_decode($ex->getData());
            $exception = $data->message;
            $data = [];
            $data['type'] = 'warning';
            $data['message'] = $exception;
            return $data;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
    }

    public function get_payment_details($paymentId) {

        //------------Get payment details.  $paymentId is transaction id.
        try {
            $payment = Payment::get($paymentId, $this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {

            $data = json_decode($ex->getData());
            $exception = $data->message;
            $data = [];
            $data['type'] = 'warning';
            $data['message'] = $exception;
            return $data;
        } catch (Exception $ex) {
            
        }
        return $payment;
    }

    public function refund($sale_id, $amount) {

        //------------Refund a transaction.  $sale_id is transaction sale id.
        //---------Set Amount------
        $amt = new Amount();
        $amt->setCurrency($this->apiCurrency)
                ->setTotal($amount);

        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);

        $sale = new Sale();
        $sale->setId($sale_id);
        try {

            $refundedSale = $sale->refundSale($refundRequest, $this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {

            $data = json_decode($ex->getData());
            $exception = $data->message;
            $data = [];
            $data['type'] = 'warning';
            $data['message'] = $exception;
            return $data;
        } catch (Exception $ex) {
            
        }

        return $refundedSale;
    }

}

?>