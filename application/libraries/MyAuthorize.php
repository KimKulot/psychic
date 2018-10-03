<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of MyAuthorize
 *
 * @author wahyu widodo
 */
 
include(APPPATH ."/vendor/autoload.php"); 
 
class MyAuthorize {
	
	public $merchanAuthentication;
	public $refId;

	public function __construct(){		
		$this->merchanAuthentication = new net\authorize\api\contract\v1\MerchantAuthenticationType(); 
		$this->merchanAuthentication->setName("45rf36d8EUX"); 
		$this->merchanAuthentication->setTransactionKey("5X5AkH76nK7gw8t2");
		$this->refId = 'ref'.time();
	}
	
	public function chargerCreditCard($detCus){	
		$errors = [];
        $success = true;
        $data = null;
		$creditCard = new net\authorize\api\contract\v1\CreditCardType();
		$creditCard->setCardNumber($detCus['cnumber']);
		$creditCard->setExpirationDate($detCus['cexpdate']);					 	
		$creditCard->setCardCode($detCus['ccode']);
		$paymentOne = new net\authorize\api\contract\v1\PaymentType();
		$paymentOne->setCreditCard($creditCard);
		$order = new net\authorize\api\contract\v1\OrderType();
		$order->setDescription($detCus['cdesc']);
		// Preparin customer information object
		$billto = new net\authorize\api\contract\v1\CustomerAddressType();
		$billto->setFirstName($detCus['fname']);
		$billto->setLastName($detCus['lname']);
		$billto->setAddress($detCus['address']);
		$billto->setCity($detCus['city']);
		$billto->setState($detCus['state']);
		$billto->setCountry($detCus['country']);
		$billto->setZip($detCus['zip']);
		$billto->setPhoneNumber($detCus['phone']);
		$billto->setEmail($detCus['email']);
		// create transaction 
		$transactionRequestType = new net\authorize\api\contract\v1\TransactionRequestType();
		$transactionRequestType->setTransactionType("authCaptureTransaction");
		$transactionRequestType->setAmount($detCus['amount']); 
		$transactionRequestType->setOrder($order);
		$transactionRequestType->setPayment($paymentOne);
		$transactionRequestType->setBillTo($billto);
		$request = new net\authorize\api\contract\v1\CreateTransactionRequest();
		$request->setMerchantAuthentication($this->merchanAuthentication);
		$request->setRefId($this->refId); 				  	
		$request->setTransactionRequest($transactionRequestType);
		$controllerx = new net\authorize\api\controller\CreateTransactionController($request);
		$response = $controllerx->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
		if ($response != null){
			$data = $response;
		    $tresponse = $response->getTransactionResponse();
		    if (($tresponse != null) && ($tresponse->getResponseCode()=="1") ) {
		      echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
		      echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
		      return compact('data', 'success', 'errors');
		    }else{
		    	$errors['credit_card'] = "Charge Credit Card ERROR :  Invalid response";
		    	$success = false;
		        return compact('data', 'success', 'errors');
		    }
		} else{
		    $errors['credit_card'] = "Charge Credit card Null response returned";
	        $success = false;
		    return compact('data', 'success', 'errors');
		}
	}
}