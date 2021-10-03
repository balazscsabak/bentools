<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Rendelés szállítás alatt</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet">
	<style>
    	* {
        	box-sizing: border-box;
        }
		.container {
			max-width: 600px;
			margin-left: auto;
			margin-right: auto;
            background-color: #f5f5f5;
		}
        .header{
        	background-color: #1e58a5;
            padding: 20px 10px;
        }
        .header img {
        	width: 200px;
            display: block;
            heigth: auto;
            margin: auto;
        }
        .body {
        	padding: 20px;
			font-size: 17px;
        }
        .footer {
        	padding: 20px;
        	text-align: center;
            background-color: #e1e1e1;
            font-size: 14px;
        }
        .footer img {
        	width: 120px;
            display: block;
            heigth: auto;
            margin: auto;
        }
        
	</style>
</head>
<body style="font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;">
	<div class="container">
		<div class="header">
        	<img src="{{ asset('/images/KIMATools_RGB.png') }}">
        </div>
        <div class="body">
        	<h1 style="text-align: center;">
            	Tájékoztató
            </h1>
            <p style="text-align: center;">
            	A rendelés státusza a következőre változott: <b>Szállítás alatt</b>
            </p>
            <p style="text-align: center;">
            	Rendelési azonozító: <b>#{{ $order->unique_id }}</b>
            </p>
        </div>
        <div class="footer">
        	<img src="{{ asset('/images/KIMATools_RGB.png') }}">
          <p>
            <strong>Mihalkó Bence Béla</strong>
          </p>
          <p>
            <strong>3070 Bátonyterenye, Kossuth Lajos út 13</strong>
          </p>
          <p>
            <strong>Számlaszám: 11741055-21444405</strong>
          </p>
        </div>
	</div>
</body>
</html>