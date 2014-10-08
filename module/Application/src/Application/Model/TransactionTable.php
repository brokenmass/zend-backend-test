<?php

namespace Application\Model;

use Application\Service\CsvImporter;

class TransactionTable
	{
	public $rows;

	function __construct()
		{
		$importer = new CsvImporter(__DIR__ . '../../../../../../sampleData/data.csv',true);
		$this->rows = $importer->get(0);
		}

	function getMerchantTransactions($merchantId)
		{
		$result = array();
		foreach ($this->rows as $index => $row)
			{
			if(intval($row["merchant"]) == $merchantId)
				array_push($result, $row);
			}
		return $result;
		}
	}