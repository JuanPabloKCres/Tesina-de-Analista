<!DOCTYPE html>
<html>
<head>
	<title>La Auténtica</title>
</head>
<body>
<h2>Administración la página web de "La Auténtica".</h2>
<br>
<article>
	<h3> Para restablecer tu contraseña sigue el siguiente link:</h3> {{ url('password/reset/'.$token)}}
</article>
</body>
</html>





