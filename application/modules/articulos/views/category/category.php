
<section id="category">
<?php echo isset($categoryAdd)?$categoryAdd:""; ?>
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-brown">
            <div class="panel-heading"><h4>Categoria</h4></div>
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
				        <?php foreach($catList as $k => $v): ?>
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