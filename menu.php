<!DOCTYPE html>
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="/path/to/bootstrap.css" rel="stylesheet" type="text/css" />
   <link href="/path/to/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>
   <!-- bootstrap responsive multi-level dropdown menu -->
   <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
         <!-- header -->
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#multi-level-dropdown">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">MyHOME</a>
         </div>
         <!-- menus -->
         <div class="collapse navbar-collapse" id="multi-level-dropdown">
            <ul class="nav navbar-nav">
            <li><a href="#">Kitchen Accessories</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">Interiors<b class="caret"></b></a>
               <ul class="dropdown-menu">
               <li><a href="#">Furnitures</a></li>
               <li><a href="#">Fans</a></li>
               <li class="dropdown-submenu">
                  <a href="#" tabindex="-1">Lamps</a>
                  <ul class="dropdown-menu">
                  <li><a href="#">Ceiling Lamps</a></li>
                  <li><a href="#">Table Lamps</a></li>
                  <li class="dropdown-submenu">
                     <a href="#" tabindex="-1">Floor Lamps</a>
                     <ul class="dropdown-menu">
                     <li><a href="#">Living Room</a></li>
                     <li><a href="#">Bed Room</a></li>
                     <li><a href="#">Garden Lamps</a></li>
                     </ul>
                  </li>
                  </ul>
               </li>
               </ul>
            </li>
            <li><a href="#">Bath Fittings</a></li>
            </ul>
         </div>
      </div>
   </nav>
   <script src="/path/to/jquery-1.10.2.js" type="text/javascript"></script>
   <script src="/path/to/bootstrap.js" type="text/javascript"></script>
</body>
</html>