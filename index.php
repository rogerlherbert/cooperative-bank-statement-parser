<?php

if ( ! empty($_POST['type']) && ! empty($_POST['html'])) 
{ 
	include 'class.statement.php';

	include 'class.transaction.php';

	$statement = new Statement();

	$statement->load($_POST['type'], $_POST['html']);

	$statement->toCSV($_POST['service']);
} 
else 
{
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Co-op Bank Statement Parser</title>
		
		<style type="text/css" media="screen">
		* { margin: 0; padding: 0; }
		body { font-family: sans-serif; }
		h1 { font-size: 150%; margin-bottom: 1em;}
		form { width: 30em; margin: 5em auto;}
		fieldset { border: none; margin: 1em 0;}
		legend { font-weight: bold;}
		label { display: block;}
		textarea { width: 100%; height: 10em; }
		</style>
	</head>

	<body>
		<form action="/" method="post" accept-charset="utf-8">
			<h1>Co-operative Bank Statement Parser</h1>

			<fieldset id="account_type">
				<legend>Account Type</legend>
				<label for="type"><input type="radio" name="type" value="current" checked> Current or Savings Account</label>
				<label for="type"><input type="radio" name="type" value="credit"> Credit Card Account</label>
			</fieldset>

			<label for="html">HTML Source
				<textarea name="html" rows="8" cols="40" placeholder="paste the source HTML of your bank statement here&hellip;" required></textarea>
			</label>
		
			<fieldset id="csv_format">
				<legend>CSV Format</legend>
				<label for="service"><input type="radio" name="service" value="ynab" checked> YNAB</label>
				<label for="service"><input type="radio" name="service" value="freeagent"> Freeagent</label>
			</fieldset>

			<p><input type="submit" value="Give me a CSV of this"></p>
		</form>
	</body>
</html>
<?php } ?>