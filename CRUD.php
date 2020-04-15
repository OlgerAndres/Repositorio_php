
<?php

require_once 'Boostrap.php';

$articulos = new Articulos($_GET);


if(!empty($_GET['nombre']) && !empty($_GET['breve_descripcion']) &&  !empty($_GET['description']) && !isset($_GET['id'])) {
$id = $articulos->create();
} elseif (!empty($_GET['id'])) {
$updated = $articulos->updateItem();
$item = $articulos->findById();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Articulos</title>
</head>
<body >

<?php if(isset($id)): ?>
    <h3>New item created: <?php echo $id; ?></h3>
<?php endif; ?>

<?php if(!empty($updated)): ?>
    <h3>Item saved!</h3>
<?php endif; ?>


    <h1>Articulos</h1>
<br/>

<form action="CRUD.php" method="get">

<?php if(isset($item)): ?>
        <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <?php endif; ?>

  <div class="form-group col-md-6">
    <label for="InputArticulo">Articulo</label>
    <input type="articulo" class="form-control" id="InputArticulo11" value="<?php echo isset($item) ? $item->nombre : null ?>">
  </div>

  <div class="form-group col-md-6">
    <label for="breveDescripcionInput">Breve descripcion</label>
    <input type="breve descripcion" class="form-control" id="breveDescripcionInput1" value="<?php echo isset($item) ? $item->breve_descripcion : null ?>">
  </div>

  <div class="form-group col-md-6">
    <label for="DescripcionInput">Descripcion</label>
    <input type="descripcion" class="form-control" id="DescripcionInput1" value="<?php echo isset($item) ? $item->descripcion : null ?>">
</div>

  <button type="submit" class="btn btn-primary">Crear</button>

</form>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>