<?php
/**
* 
*/
class Statement
{
	private $list = array();
	
	public function load($html)
	{
		$doc = new DOMDocument();

		$doc->preserveWhiteSpace = false;

		$doc->loadHTML($html);

		$tables = $doc->getElementsByTagName('table');

		if ($tables->length === 0) { throw new Exception('Couldn\'t find anything useful in your HTML, sorry.'); }

		$finder = new DomXPath($doc);

		$rows = $finder->query("tbody/tr", $tables->item(12));

		foreach ($rows as $row) 
		{
			$tx = new Transaction();

			$tx->load($row);

			$this->push($tx);
		}
	}
	
	public function push(Transaction $tx)
	{
		$this->list[] = $tx;
	}
	
	public function toCSV()
	{
		$csv = "Date,Payee,Category,Memo,Outflow,Inflow\n";

		foreach ($this->list as $tx) 
		{
			$inout = (strpos($tx->change, '-') === FALSE) ? ',' . $tx->change : substr($tx->change, 1) . ',';
			$csv .= $tx->date->format('d-m-Y') . "," . $tx->description . ",,," . $inout . "\n";
		}

		header('Content-Type: text/csv; charset=utf-8'); 
		echo $csv;
	}
}
?>