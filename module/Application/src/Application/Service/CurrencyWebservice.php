<?php

namespace Application\Service;

use Zend\Math\Rand;

class CurrencyWebservice
	{
	private $exchangerates = array();
	public function getExchangeRate($currencyFrom,$currencyTo)
		{
		if($currencyFrom == $currencyTo)
			{
			return 1;
			}
		elseif ($this->exchangerates[$currencyFrom."->".$currencyTo] != null)
			{
			return $this->exchangerates[$currencyFrom."->".$currencyTo];
			}
		elseif ($this->exchangerates[$currencyTo."->".$currencyFrom] != null)
			{
			return 1/$this->exchangerates[$currencyTo."->".$currencyFrom];
			}
		else
			{
			$this->exchangerates[$currencyFrom."->".$currencyTo] = 2* round(Rand::getFloat(),2);
			return $this->exchangerates[$currencyFrom."->".$currencyTo];
			}
		}
	public function printAllRates()
		{
		foreach ($this->exchangerates as $key => $value)
			{
			echo $key . " : " . $value ."\r\n";
			}
		}
	}