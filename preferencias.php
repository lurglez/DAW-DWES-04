<?php
//Solicitamos autentificación sin tener preestablecidos valores para usuario y contraseña
  if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER']=="" ) {
    header('WWW-Authenticate: Basic Realm="Accede a tu cuenta"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Has cancelado el inicio de sesión.";
    exit;
  }else{
  //Si se han introducido datos, abrimos la sesión, asignamos los valores indicados por el usuario a la variable correspondiente para identificarlo
    session_start();
    $usuario=(isset($_SERVER['PHP_AUTH_USER']))?$_SERVER['PHP_AUTH_USER']:"No hay usuario";
    $pass=(isset($_SERVER['PHP_AUTH_PW']))?$_SERVER['PHP_AUTH_PW']:"No hay usuario";
 //Creamos una variable de sesión para indicar que no se han establecido aún preferencias y que usaremos tanto en está página como en mostrar.php
    $_SESSION["no"]="No hay preferencias establecidas";
 //Si el usuario ha seleccionado sus preferencias las recogemos y guardamos, sino, le asignamos nosotros el valor por defecto
    $_SESSION["seleccionHorario"]=(isset($_POST['horaria']))?$_POST['horaria']: $_SESSION["no"];
    $_SESSION["seleccionIdioma"]=(isset($_POST['idioma']))?$_POST['idioma']: $_SESSION["no"];
    $_SESSION["seleccionPublico"]=(isset($_POST['publico']))?$_POST['publico']: $_SESSION["no"];
}
?>
<!--Abrimos etiqueta html-->
<!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
     <!-- Introducimos el título de la página -->
    <title>Tarea 4 - Lourdes González</title>
     <!-- Links a la página de CSS y script de fontawesome -->
    <script src="https://kit.fontawesome.com/6be3821d5f.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="cambios.css" rel="stylesheet">
  </head>
  <body>
    <br>
    <br>
    <div class="formato">
    <!-- Abrimos el formulario -->
    <form action="preferencias.php" method="post">
    <!-- Damos título al formulario y añadimos también el nombre que el usuario ha establecido previamente -->
      <h2>Preferencias: <i class="fa-solid fa-user-astronaut"></i> <?php echo $usuario ?><br> </h2>
      <div class="linea"></div>
      <div class="aviso">
     <!-- Si el usuario ha guardado sus preferencias, mandamos un mensaje por pantalla indicándolo -->
       <?php
         if(isset($_POST['preferencias'])){ echo"¡Preferencias de usuario guardadas!";};
       ?>
     </div>
     <!-- Abrimos selección de idioma deseado -->
        Idioma: <br>
          <div class="icono">
          <!--Agregamos un icono-->
          <h4> <i class="fa-solid fa-language"></i></h4>
          </div>
          <!-- A la hora de mostrar el idioma vamos a comprobar si se ha hecho una selección con anterioridad para priorizarla.
              Si se ha seleccionado, aparecerá en primer lugar dicha selección -->
          <select name="idioma"> 
          <?php
         //Añadimos el valor seleccionado por el usuario a una variable
           $idioma=(isset($_POST['idioma']))?$_POST['idioma']:"";
           //Buscamos coincidencias
            if( $idioma=="Inglés"){ ?>
              <div class="idioma">
              <option value="Inglés">Inglés</option>
              <option value="Español">Español</option>
                <!-- Si no encontramos: -->
                <?php }else{?>
                  <option value="Español">Español</option>
                  <option value="Inglés">Inglés</option>
                <?php };?>
              </div>
    </select>
    <br>
       <!-- Abrimos selección sobre privacidad del perfil -->
        Perfil Público: <br>
          <div class="icono">
          <!--Agregamos un icono-->
          <h4> <i class="fa-solid fa-key"></i></h4>
          </div>
          <select name="publico">
          <!--Seguimos el mismo método que con la selección del idioma, si ha seleccionado un idioma, aparecerá en primera posición -->
          <?php
          //Añadimos el valor seleccionado por el usuario a una variable
            $publico=(isset($_POST['publico']))?$_POST['publico']:"";
           //Buscamos coincidencias
            if( $publico=="No"){ ?>
             <option value="No">No</option>
             <option value="Sí">Sí</option>
              <!-- Si no encontramos: -->
              <?php }else{?>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
              <?php };?>
    </select>
    <br>
        <!-- Abrimos selección de zona horaria -->
        Zona Horaria: <br>
          <div class="icono">
          <!--Agregamos un icono-->
          <h4> <i class="fa-solid fa-earth-americas"></i></h4>
          </div>
          <select name="horaria">
          <?php
            //Añadimos el valor seleccionado por el usuario a una variable
            $horaria=(isset($_POST['horaria']))?$_POST['horaria']:"GTM";
            //Abrimos un switch para abarcar todas las posibilidades horarias:
            switch($horaria){
              case "GTM": ?> 
               <option value="GTM">GTM</option>
               <option value="GTM-1">GTM-1</option>
               <option value="GTM-2">GTM-2</option>
               <option value="GTM+1">GTM+1</option>
               <option value="GTM+2">GTM+2</option>
          <?php break; 
              case "GTM-1": ?>   
                <option value="GTM-1">GTM-1</option>
                <option value="GTM">GTM</option>
                <option value="GTM-2">GTM-2</option>
                <option value="GTM+1">GTM+1</option>
                <option value="GTM+2">GTM+2</option> 
          <?php break; 
              case "GTM-2": ?>   
                <option value="GTM-2">GTM-2</option>  
                <option value="GTM">GTM</option>
                <option value="GTM-1">GTM-1</option>
                <option value="GTM+1">GTM+1</option>
                <option value="GTM+2">GTM+2</option>
          <?php break; 
              case "GTM+1": ?>   
                <option value="GTM+1">GTM+1</option>
                <option value="GTM">GTM</option>
                <option value="GTM-1">GTM-1</option>
                <option value="GTM-2">GTM-2</option>
                <option value="GTM+2">GTM+2</option>
          <?php break; 
              case "GTM+2": ?>   
                <option value="GTM+2">GTM+2</option>
                <option value="GTM">GTM</option>
                <option value="GTM-1">GTM-1</option>
                <option value="GTM-2">GTM-2</option>
                <option value="GTM+1">GTM+1</option>        
          <?php break; };?>
    </select>
   </div>
    <br>
   <!-- Añadimos los botones de guardar y ver las preferencias -->
   <!-- El botón de mostrar preferencias nos lleva a la página mostrar.php -->
    <a href="mostrar.php"> <input type="button" value="Mostrar Preferencias"></a>
    <input type="submit" name="preferencias" value="Establecer Preferencias"> 
     <!-- Finalizamos el formulario -->
    </form>
</body>
<!-- Cerramos etiqueta html -->
</html>
