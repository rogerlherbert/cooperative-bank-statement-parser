<?php
/**
* 
*/
class Transaction
{
	private $date;
	private $description;
	private $change;
	
	public function __set($property, $value)
	{
		if (property_exists($this, $property)) 
		{
			$this->{$property} = $value;
		}
	}
	
	public function __get($property)
	{
		return $this->{$property};
	}
	
	public function __isset($property)
	{
		return isset($this->{$property});
	}
	
	public function load(DOMElement $tr)
	{
		$fields = array(
			0 => 'date',
			2 => 'description',
			4 => 'in',
			6 => 'out'
		);

		foreach ($tr->childNodes as $td_key => $td) 
		{
			if ($td->nodeName == 'td' && array_key_exists($td_key, $fields))
			{
				switch ($fields[$td_key])
				{
					case 'date':
						$this->date = DateTime::createFromFormat('d/m/Y', trim($td->nodeValue));
						break;
					
					case 'description':
						$this->description = trim($td->nodeValue);
						break;
				
					case 'in':
						$val = preg_replace('/[^0-9\.]*/', '', $td->nodeValue);
						if ($val != '')
						{
							$this->change = $val;
						}
						break;

					case 'out':
						$val = preg_replace('/[^0-9\.]*/', '', $td->nodeValue);
						if ( ! isset($this->change) && $val != '')
						{
							$this->change = '-' . $val;
						}
						break;
					
					default:
						break;
				}
			}
		}
	}
}
?>