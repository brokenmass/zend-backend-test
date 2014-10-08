<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\Console\Request as ConsoleRequest,
	Application\Service\CurrencyConverter,
	Application\Model\TransactionTable;

class TransactionController extends AbstractActionController
	{
	public function listtransactionAction()
		{
		$request = $this->getRequest();

		if (!$request instanceof ConsoleRequest)
			{
			throw new \RuntimeException('You can only use this action from a console!');
			}


		$merchantId   = $request->getParam('merchantId', false);
		if (!ctype_digit($merchantId))
			{
			echo "merchantId must be an integer \r\n";
			return -1;
			}

		$converter = new CurrencyConverter();
		$db = new TransactionTable();

		$transactions = $db->getMerchantTransactions($merchantId);

		echo str_pad("", 35, "-")."\r\n";
		echo str_pad("Transaction list for", 35, " ",STR_PAD_BOTH)."\r\n";
		echo str_pad("Merchant ".$merchantId, 35, " ",STR_PAD_BOTH)."\r\n";
		echo str_pad("", 35, "-")."\r\n";

		if(sizeof($transactions)>1)
			{
			echo str_pad("#", 5, " ", STR_PAD_LEFT) .
				str_pad("DATE", 15, " ", STR_PAD_LEFT) .
				str_pad("AMOUNT ", 15, " ", STR_PAD_LEFT) .
				"\r\n";

			foreach ($transactions as $index => $transaction)
				{
				$converted = $converter->convert($transaction["value"]);
				echo str_pad($index, 5, " ", STR_PAD_LEFT) .
					str_pad($transaction["date"], 15, " ", STR_PAD_LEFT) .
					str_pad($converted, 15, " ", STR_PAD_LEFT) .
					$this->mb_str_pad("(".($transaction["value"]).")", 15, " ", STR_PAD_LEFT) .
					"\r\n";
				}
			echo str_pad("", 35, "-")."\r\n";
			$converter->printRates();
			}
		else
			{
			echo str_pad("No available transactions", 35, " ",STR_PAD_BOTH)."\r\n";
			}
		echo str_pad("", 35, "-")."\r\n";
		}

	private function mb_str_pad ($input, $pad_length, $pad_string, $pad_style, $encoding="UTF-8")
		{
   		return str_pad($input,strlen($input)-mb_strlen($input,$encoding)+$pad_length, $pad_string, $pad_style);
		}
	}