<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Kennwort Zurücksetzen</h2>

		<div>
			Um das Kennwort zurückzusetzen bitte folgendes Formular ausfüllen: {{ URL::to('password/reset', array($token)) }}.<br/>
			Dieser Link ist {{ Config::get('auth.reminder.expire', 60) }} Minuten gültig.
		</div>
	</body>
</html>
