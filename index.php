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
	</head>

	<body>
		<form action="/" method="post" accept-charset="utf-8">
			<fieldset id="account_type">
				<legend>Account Type</legend>
				<label for="type"><input type="radio" name="type" value="current" checked> Current or Savings Account</label><br/>
				<label for="type"><input type="radio" name="type" value="credit"> Credit Card Account</label>
			</fieldset>

			<label for="html">HTML Source</label><br/>
			<textarea name="html" rows="8" cols="40" placeholder="paste the source HTML of your bank statement here&hellip;" required></textarea>
		
			<fieldset id="csv_format">
				<legend>CSV Format</legend>
				<label for="service"><input type="radio" name="service" value="ynab" checked> YNAB</label><br/>
				<label for="service"><input type="radio" name="service" value="freeagent"> Freeagent</label>
				<p><input type="submit" value="Give me a CSV of this"></p>
			</fieldset>
		</form>
	</body>
</html>
<?php } ?>