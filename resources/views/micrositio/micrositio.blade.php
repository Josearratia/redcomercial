<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Red Comercial">
    <meta name="keyword" content="Red Comercial">
    <link rel="shortcut icon" href="vendors/img/favicon.png">
    
    <title>Red Comercial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"><!--proteje de ataque-->
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>
<body>
    @php if(isset($_GET['id'])){ 			 
    $nombre = $_GET['id'];
    }
    @endphp

	<div id="app">
	 <prueba :userid={{ Auth::user()->id }} :empresa={{$nombre}}></prueba>
    </div>
             
    
  <!-- Contenido Principal -->
  @yield('contenido')  
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
    <script src="https://kit.fontawesome.com/722a629dae.js" crossorigin="anonymous"></script>

</body>
</html>