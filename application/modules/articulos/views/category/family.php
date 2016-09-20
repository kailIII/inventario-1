
<section id="category">
  <div class="col-md-13">
    <form name="formFamily" id="formFamily">
      <div class="row">
        <div class="col-md-13">
          <div class="col-md-4 col-md-offset-6 form-group">
            <input type="text" class="form-control" name="name" id="familyval" placeholder="Familia">
          </div>
          <div class="col-md-offset-8 form-group">
            <div class="btn btn-brown" data-bind="click: family">Agregar</div>
          </div>
        </div>
      </div>
    </form>
  </div>

<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-brown">
            <div class="panel-heading"><h4>Familia de articulos</h4></div>
        <div class="panel-body">
            <table class="table table-hover">
               <thead>
                    <tr>
                        <th style="width:1%"></th>
                        <th style="width:1%">#</th> 
                        <th style="width:30%">Nombre</th>
                        <th style="width:45%">Descripcion</th>
                    </tr>
                </thead>
                <tbody >
				<?php foreach($familyList as $k => $v): ?>
                   <tr >                    
                        <td><a href="#"><i class="fa fa-pencil fa-lg"></i></a></td>
                        <td><span></span></td> 
                        <td>
                         <?php echo $v["name"]; ?>
                        </td>
                        <td>---</td>
                    </tr>                
					<?php endforeach; ?>
                </tbody>
            </table>                
        </div>
    </div>
  </div>
</div>

</section>