<?php
/**
* 
*/
class Statement
{
	private $list = array();
	
	public function load($type, $html)
	{
		$doc = new DOMDocument();

		$doc->preserveWhiteSpace = false;

		$doc->loadHTML($html);

		$tables = $doc->getElementsByTagName('tbody');

		if ($tables->length === 0) { throw new Exception('Couldn\'t find anything useful in your HTML, sorry.'); }

		$finder = new DomXPath($doc);

		$table_item = ($type == 'current') ? 2 : 3;

		$rows = $finder->query("tr", $tables->item($table_item));

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

		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename=statement-'.time().'.csv');
		header('Pragma: no-cache');

		echo $csv;
	}
}
?>