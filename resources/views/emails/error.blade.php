<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>error</title>
</head>
<body>
	<div>
		<h3>Új error keletkezett:</h3>

		<p>{{ $msg }}</p>
		<p><strong>User id:</strong> {{ $error->user_id }}</p>
		<p><strong>Controller:</strong> {{ $error->controller }}</p>
		<p><strong>Action:</strong> {{ $error->action }}</p>
		<p><strong>Ex msg:</strong> {{ $error->exception_message }}</p>
		<p><strong>Message:</strong> {{ $error->message }}</p>
		<p><strong>Reference:</strong> {{ $error->reference_d }}</p>
		<p><strong>Ref data:</strong> {{ $error->reference_v }}</p>
		<p><strong>Created at:</strong> {{ $error->created_at }}</p>
		<p><strong>ID:</strong> {{ $error->id }}</p>

	</div>
</body>
</html>