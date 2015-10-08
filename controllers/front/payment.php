<?php

/**
* Payment controller
*/
class MyModPaymentPaymentModuleFrontController extends ModuleFrontController
{
	public $ssl = true;

	public function initContent()
	{
		// Disable left and right column
		$this->display_column_left = false;
		$this->display_column_right = false;

		// Call parent
		parent::initContent();

		// Set template to use
		$this->setTemplate('payment.tpl');

		// Assign cart data to smarty
		$this->context->smarty->assign(array(
			'nb_products' => $this->context->cart->nbProducts(),
			'cart_currency' => $this->context->cart->id_curency,
			'currencies' => $this->module->getCurrency((int)$this->context->cart->id_currency),
			'total_amount' => $this->context->cart->getOrderTotal(true, Cart::BOTH),
			'path' => $this->module->getPathUri(),
		));

		// Check if curency is accepted
		if (!$this->checkCurrency())
			Tools::redirect('index.php?controller=order');
	}

	private function checkCurrency()
		{
			// Get cart currency and enabled currencies for this module
			$currency_order = new Currency($this->context->cart->id_currency);
			$currencies_module = $this->module->getCurrency($this->context->cart->id_currency);

			// Check if cart currency is one of the enabled currencies
			if (is_array($currencies_module))
				foreach ($currencies_module as $currency_module)
					if ($currency_order->id == $currency_module['id_currency'])
						return true;

			return false;
		}
}