<?php

/**
* Main module class
*/
class MyModPayment extends PaymentModule
{

	function __construct()
	{
		$this->name = 'mymodpayment';
		$this->tab = 'payment_gateways';
		$this->version = '0.1';
		$this->author = 'Vagios Vlachos';
		$this->bootstrap = true;

		parent::__construct();
		$this->displayName = $this->l('MyMod Payment');
		$this->description = $this->l('A simple payment module');
	}
}