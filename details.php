<!--PHP-->
<?php 
require "config/config.php";
require "config/database.php";
$db = new Database();
$con = $db->conectar();

$id = isset($_GET["id"]) ? $_GET["id"] : "";
$token = isset($_GET["token"]) ? $_GET["token"] : "";
if($id == "" || $token == ""){
    echo "Error al procesar la petición";
    exit;
}else{
    $token_tmp = hash_hmac("sha1", $id, KEY_TOKEN);
    if($token == $token_tmp){

        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql-> execute([$id]);
        if($sql->fetchColumn() >0){
            $sql = $con->prepare("SELECT nombre, descripcion, precio FROM productos WHERE id=? AND activo=1 LIMIT 1 ");
            $sql-> execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio = $row["nombre"];
            $descripcion = $row["descripcion"];
            $precio = $row["precio"];
            $dir_imagenes = "imagenes/imagenesFV/" . $id. "/";
            $rutaimagenes = $dir_imagenes . "principal.png";
            if (!file_exists($rutaimagenes)){
                $rutaimagenes = "imagenes/imagenesFV/no-photo.jpg";
            }
            $imagenes = array();
            $dir = dir($dir_imagenes);
            while(($archivo = $dir->read()) != false){
                if($archivo != "principal.png" && (strpos($archivo, "png") || strpos($archivo, "jpg")|| strpos($archivo, "jpeg"))) {
                    $imagenes[]= $dir_imagenes . $archivo;
                }
            }

            $dir->close();
        }



    } else {
        echo "Error al procesar la petición";
        exit;
    }
}


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
    <link href="css/cardsize.css" rel="stylesheet">

</head>
<body>
      
<section>
    
<!--galeria de productos-->
    <!--bootstrap-->
    <div class="horizontal-padding vertical-padding">
      
          <div>
              <br>
              <br>
              
          
               <!--Productos-->
                  <div class="row py-5">
                  <div class="border-bottom">
                  </div>
             </div>

            <!--cards-->     
              <!--Productos-->
              <main>
                <div class="container">
                    <div class="row">

                        <div class="d-flex col-md-6 col-sm-6 col-lg-4 order-md-1 justify-content-center">


            <!--Carousel-->
                            <div id="carouselimages" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="<?php echo $rutaimagenes; ?>" class="d-block w-100 img-fluid">
                    </div>

                    <?php foreach($imagenes as $img){ ?>
                    <div class="carousel-item">
                    <img src="<?php echo $img; ?>" class="d-block w-100 img-fluid">
                    </div>
                    <?php } ?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselimages" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselimages" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>

                <!--Carousel-->

                         
                        </div>
                        
                        <div class="card-tittle text-center col-md-6 order-md-2 mx-auto">  
                        <h1><?php echo $row["nombre"]; ?></h1>
                           <!-- <h2><?php   echo $nombre; ?></h2>-->

                            <p class="lead">
                                <?php echo $descripcion; ?>
                            </p>

                            <h3><?php echo MONEDA  . number_format($precio, 2, ".", "."); ?></h3>
                        
                            <!-- botones-->
                            <div class="d-grid gap-3 col-10 mx-auto">

                            
                                <button class="btn mi-color1" type="button">Comprar

                                </button>

                                <button class="btn mi-color2" type="button">Agregar

                                </button>
                            <!-- botones-->

                            </div>

                    </div>
                </div> 
              </main>


            <!--cards-->    
           </div>

    </div>

</section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--galeria de productos-->
  </body>
</html>




