<?php headerAdmin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Informe</div>
            <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <h3 class="tile-title">Relacion conductor vs propietarios</h3>
                <table class="table table-striped table-lg">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Placa</th>
                      <th>Marca</th>
                      <th>Nombre conductor</th>
                      <th>Nombre Propietario</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(count($data['informe']) > 0 ){
                          //var_dump($data['informe']);exit();
                          foreach ($data['informe'] as $info) {
                    ?>
                    <tr>
                      <td><?= $info['id'] ?></td>
                      <td><?= $info['placa'] ?></td>
                      <td><?= $info['marca'] ?></td>
                      <td><?= $info['Nombres'] ?></td>
                      <td><?= $info['propietario'] ?></td>
                    </tr>
                    <?php } 
                      } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </main>
<?php footerAdmin($data); ?>
    