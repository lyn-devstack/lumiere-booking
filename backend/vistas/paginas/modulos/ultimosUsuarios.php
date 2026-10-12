<?php 

$usuarios = ControladorUsuarios::ctrMostrarusuarios(null,null);

function limit($iterable, $limit) {
    foreach ($iterable as $key => $value) {
        if (!$limit--) break;
        yield $key => $value;
    }
}


?>


<div class="card card-dark card-outline">

  <div class="card-header">

    <h3 class="card-title">Últimos usuarios registrados</h3>

  </div>
  <!-- /.card-header -->

  <div class="card-body p-0">

    <ul class="products-list product-list-in-card pl-2 pr-2">

      <?php foreach (limit($usuarios, 3) as $key => $value): ?>

        <?php if ($value["foto"] != ""){

          $foto = $value["foto"];

        }else{

          $foto = "vistas/img/usuarios/default/default.png";

        }
          
        ?>

        <li class="item">
          <div class="product-img">
            <img src="<?php echo e($foto); ?>" alt="Product Image" class="img-size-50 rounded-circle">
          </div>
          <div class="product-info">
            <h6 class="product-title"><?php echo e($value["nombre"]); ?></h6>
              <span class="product-description">
                Ingreso <?php echo e($value["modo"]); ?>
              </span>
            </div>
        </li>
        
      <?php endforeach ?>

      </ul>
  </div>
      <!-- /.card-body -->
  <div class="card-footer text-right">
    <a href="usuarios" class="btn text-white mt-3" style="background-color:#a8813f">Ver usuarios</a>
  </div>
      <!-- /.card-footer -->
</div>