<?php

if ( ! empty($_POST['type']) && ! empty($_POST['html'])) 
{ 
	include 'class.statement.php';

	include 'class.transaction.php';

	$statement = new Statement();

	$statement->load($_POST['type'], $_POST['html']);

	$statement->toCSV();
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
				<label for="type"><input type="radio" name="type" value="current" id="type" checked> Current or Savings Account</label><br/>
				<label for="type"><input type="radio" name="type" value="credit" id="type"> Credit Card Account</label>
			</fieldset>

			<label for="html">HTML Source</label><br/>
			<textarea name="html" rows="8" cols="40" placeholder="paste the source HTML of your bank statement here&hellip;" required></textarea>
		
			<p><input type="submit" value="Give me a YNAB-friendly CSV of this"></p>
		</form>
	</body>
</html>
<?php } ?>