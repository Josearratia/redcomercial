<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCehBWmHR7ucA1vmD8xhTi4o0LWVSVz2gY&callback=initMap&libraries=&v=weekly" defer></script>

  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
  <meta name="description" content="Red Comercial">


  <title>Red Comercial</title>


  <!-- Main styles for this application -->
  <link href="css/plantilla.css" rel="stylesheet">

  <style type="text/css">
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

    #map {
      width: 100%;
      height: 580px;
      position: fixed;
      margin-top: 80px;
      box-shadow: 5px 5px 5px #888;
    }


    .h1 label{ 
      font-family: 'Fredoka One', cursive;
    }

    .navbar {
      background-color: #146AB6;
      position: fixed;
      top: 0px;
      width: 100%;
    }

    .navbarul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #1419B6;
    }

    .navbar li {
      float: left;
    }

    .navbar li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    .navbar li a:hover {
      background-color: #B61419;
      border-radius: 20px;
    }
  </style>
</head>

<body class="app flex-row align-items-center">

  <ul class="navbar justify-content-center">
    <!-- <li class="nav-item" style="list-style:none;">
    <a class="nav-link active" href="#" style="color:white;">Active link</a>
  </li> -->
    <li class="nav-item" style="list-style:none;">
      <a class="nav-link" href="/iniciar" style="color:white;">Iniciar Sesión</a>
    </li>
    <li class="nav-item" style="list-style:none;">
      <a class="nav-link" href="/registrar" style="color:white;">Regristro</a>
    </li>
  </ul>


  <div class="container">

    @yield('login')
    @yield('registrar')
    @yield('mapa')
  </div>



  <script src="js/plantilla.js"></script>



</body>

</html>