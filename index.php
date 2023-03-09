<!--PHP-->
<?php 
require "config/database.php";
$db = new Database();
$con = $db->conectar();
$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql-> execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!--PHP-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--bootstrap-->

    <link href="css/estilos.css" rel="stylesheet"> 

</head>
<body>
      
<section>
    
<!--galeria de productos-->
    <!--bootstrap-->
    <div class="horizontal-padding vertical-padding">
      <section class="container" id="clearproducts">
          <div>
              <br>
              <br>
              <h2 class="list-tittle">productos clare</h2>
          
               <!--Productos-->
                  <div class="row py-5">
                  <div class="border-bottom">
                  </div>
             </div>

            <!--cards-->     
              <!--Productos-->
              <main>
              <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                  <?php foreach ($resultado as $row) { ?>
                      <div class="col"> <!---12 col-sm-6 col-lg-4 mt-3 mb-5 text-center -->
                        <div class="card shadow-sm">

                          <!--PHP-->
                          <?php 
                          
                          $id = $row['id'];
                          $imagen = "imagenes/imagenesFV/" . $id. "/principal.png";

                          if(!file_exists($imagen)){
                            $imagen = "imagenes/imagenesFV/no-photo.jpg";
                          }
                          
                          
                          ?>
                          <!--PHP-->

                          <!--PHP-->
                          <img src="<?php echo $imagen; ?>">
                          <!--PHP-->


                         

                          <div class="card-body">
                            <h5 class="card-tittle"><?php echo $row["nombre"]; ?></h5>


                            <p class="card-text">$ <?php echo $row["precio"]; ?></p>


                          <!-- <p class="card-text">AQUI VA LA DESCRIPCION</p>-->

                          <!--Botones-->
                            <div class="d-flex justify-content-between align-items-center">

                              <div class="btn-group">
                                <a href="" class="btn btn-primary">Detalles</a>
                              </div>
                              <a href="" class="btn btn-success">Agregar</a>
                          <!--Botones-->
                          
                            </div>
                          </div>
                        </div>
                      </div>

                  <?php } ?>

                </div>
              </div>  

              </main>


            <!--cards-->    
           </div>
       </section>
    </div>

</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--galeria de productos-->
  </body>
</html>




