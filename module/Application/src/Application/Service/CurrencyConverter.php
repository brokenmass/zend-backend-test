<?php

namespace Application\Service;

use Application\Service\CurrencyWebservice;

class CurrencyConverter
	{
	private static $symbolcode = array(
		"$" => "USD",
		"€" => "EUR",
		"£" => "GBP"
		);
	private $webservice;

	function __construct()
		{
		$this->webservice = new CurrencyWebservice();
		}

	public function convert($amount)
		{
		$amount1 = $amount;
		$symbol = mb_substr($amount, 0, 1, "utf-8");
		$value  = floatval(mb_substr($amount, 1, NULL, "utf-8"));

		if(self::$symbolcode[$symbol] != null)
			{
			$exchangerate = $this->webservice->getExchangeRate(self::$symbolcode[$symbol],"GBP");
			return "£" . ($exchangerate*$value);
			}
		else
			{
			return $amount;
			}

		}
	public function printRates()
		{
		echo "Currency Rates : \r\n";
		$this->webservice->printAllRates();
		}
	}