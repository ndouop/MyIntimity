<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Paydunya\Checkout\Store as PDStore;
use \Paydunya\Setup;
use Response;
use App\Models\Don;
class PayDunyaController extends Controller
{
	private $masterkey;
	private $publickey;
	private $privatekey;
	private $token;
	private $mode;
	private static $minAmount;
	const MINAMOUNT = 1000;

    function __construct()
    {
    	$this->masterkey=env('PAY_DUNYA_MASTER_KEY');
    	$this->publickey=env('PAY_DUNYA_PUBLIC_KEY');
    	$this->privatekey=env('PAY_DUNYA_PRIVATE_KEY');
    	$this->token=env('PAY_DUNYA_TOKEN');
    	$this->mode=env('PAY_DUNYA_MODE');


    	Setup::setMasterKey(env('PAY_DUNYA_MASTER_KEY'));
    	Setup::setPublicKey(env('PAY_DUNYA_PUBLIC_KEY'));
    	Setup::setPrivateKey(env('PAY_DUNYA_PRIVATE_KEY'));
    	Setup::setToken(env('PAY_DUNYA_TOKEN'));
    	Setup::setMode(env('PAY_DUNYA_MODE'));

    	PDStore::setName(env('PAY_DUNYA_SITE_NAME'));
    	PDStore::setTagline(env('PAY_DUNYA_SITE_TAGLINE'));
    	PDStore::setPhoneNumber(env('PAY_DUNYA_SITE_PHONENUMBER'));
    	PDStore::setPostalAddress(env('PAY_DUNYA_SITE_POSTALADDRESS'));
    	PDStore::setWebsiteUrl(env('PAY_DUNYA_SITE_WEBSITEURL'));
    	PDStore::setLogoUrl(env('PAY_DUNYA_SITE_LOGOURL'));
    	PDStore::setCallbackUrl('http://localhost:8000/paydunya/setcallback');
    	PDStore::setCancelUrl(url("paydunya/cancel_url"));
    	PDStore::setReturnUrl(url("paydunya/return_url"));

    	$this->middleware('auth');
    }

	public function getCallBack()
	{
		return view('boutique.paydunya.getCallBack');
	}

	public function setCallBack(Request $request)
	{\DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->method::setcallback",
				    			"message"=>"ok",
				    			"table_name"=>"dons"
				    		]);
		$data = $request['data'];
		//dd([$this->masterkey,$request->all()['hash'],hash('sha512', $this->masterkey)]);
		try {
		    //Prenez votre MasterKey, hashez la et comparez le résultat au hash reçu par IPN
		    if($data['hash'] !== hash('sha512', $this->masterkey)) {

			    if ($data['status'] == "completed") {
			          

				    $invoice = $data['invoice'];
				    $items = $invoice['items'];
				    $token = $invoice['token'];
				    $taxes = $invoice['taxes'];
				    $total_amount = $invoice['total_amount'];
				    $description = $invoice['description'];
				    $custom_data_array = $data['custom_data'];
				    $actions_array = $data['actions'];
				    $client = $data['customer'];
				    $receipt_url = $data['receipt_url'];

				    $don = $items['item_0'];
				    $don_string_to_array = explode("_", $don['name']);
				    $don_id = $don_string_to_array[1];

				    $don_in_db = Don::whereId($don_id)->first();
				    try {
				    	$don_in_db->confirm = true;
				    	$don_in_db->save();
				    } catch (\Illuminate\Database\QueryException $e) {
				    	\DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->setcallback::method",
				    			"message"=>$e->getMessage(),
				    			"table_name"=>"dons"
				    		]);
				    }
		      	}

		    } else {
		    	\DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->method::setcallback",
				    			"message"=>"Cette requête n'a pas été émise par PayDunya",
				    			"table_name"=>"dons"
				    		]);
		        die("Cette requête n'a pas été émise par PayDunya");
		    }
		} catch(Exception $e) {

		    \DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->method::setcallback",
				    			"message"=>$e->getMessage(),
				    			"table_name"=>"dons"
				    		]);
		}
	}


	public function invoice_payement(Request $request)
	{
		$invoice = new \Paydunya\Checkout\CheckoutInvoice();
		$invoice->setCallbackUrl(url("paydunya/setcallback"));
		$invoice->addChannels(['card', 'jonijoni-senegal', 'orange-money-senegal']);
		$data = $request->all();

		$val=\Validator::make($data,[
				'montant'=>'required',
			]);

		if ($val->fails()) {
			return Response::json(['statut'=>false,'message'=>'le champs Montant requis']);
		}

		if ($this::MINAMOUNT > $data['montant']) {
			return Response::json(['statut'=>false,'message'=>'le montant ne peut etre inferieur a '.$this::MINAMOUNT]);
		}

		$array_don = [
			'montant'=>$data['montant']
			,'mode'=>$data['mode']
			,"user_id"=>auth()->user()->id
			,'devise'=>"fcfa"
		];

		$id_don = $this->store_don($array_don);
		if (!$id_don) {

			return Response::json(['statut'=>false,'message'=>'Remplissez les champs du formulaire.']);
		}
		


		$invoice->addItem('donation_'.$id_don,1,$data['montant'],1*$data['montant'],$data['message']);

		$invoice->setTotalAmount($data['montant']);

		if ($invoice->create()) {
			
			return Response::json(['statut'=>true,'url_'=>$invoice->getInvoiceUrl()]);
			
		}else{
			
			return Response::json(['statut'=>false,'message'=>$invoice->response_text]);
		}

	}

	public function formcmd()
	{
		return view('boutique.paydunya.commande');
	}

	public function livraison($array)
	{
		$liv = new \App\Models\Livraison;

		try {
			$create = \App\Models\Livraison::create($array);
			return true;
		} catch (\Illuminate\Database\QueryException $e) {
			dd($e->getMessage());
			return false;
		}
	}

	
	public function return_url(Request $request)
	{
		$token = $request->token;
		$data = array();

		$invoice = new \Paydunya\Checkout\CheckoutInvoice();

		if ($invoice->confirm($token)) {

		  // Récupérer le statut du paiement
		  // Le statut du paiement peut être soit completed, pending, cancelled
		
		  $data['status']=$invoice->getStatus();
		  $data['customer_name']=$invoice->getCustomerInfo('name');
		  $data['customer_email']=$invoice->getCustomerInfo('email');
		  $data['customer_phone']=$invoice->getCustomerInfo('phone');
		  $data['invoice_url']=$invoice->getReceiptUrl();
		  $data['total_amount']=$invoice->getTotalAmount();

		  return redirect('/')->with("return_donation_data",$data);

		}else{
			\DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->method::return_url",
				    			"message"=>'status='.$invoice->getStatus().'///response_text='.$invoice->response_text.'///response_code='.$invoice->response_code,
				    			"table_name"=>"dons"
				    		]);
			return redirect('/')->with("return_donation_data",[]);
		}
	}

	public function saveInvoice($array)
	{
		try {
			\App\Models\Facture::create($array);
			return true;
		} catch (\Illuminate\Database\QueryException $e) {
			dd($e->getMessage());
			return false;
		}
	}


	public function store_don($array)
	{
		
		try {
			$don = Don::create($array);
			return $don->id;
		} catch (\Illuminate\Database\QueryException $e) {
			\DB::table('errors')->insert([
				    			'source'=>"PayDunyaController::class->method::store_don",
				    			"message"=>$e->getMessage(),
				    			"table_name"=>"dons"
				    		]);
			return false;
		}
	}



}