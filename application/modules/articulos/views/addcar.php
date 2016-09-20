<section class="addcar">
    <section class="row" id="cartMenu">
        <?php foreach($art_ as $k => $v): ?>
        <div class="s_nav">
            <div class="cartData">
                <div class="col-md-6 thumb_">
                    <a href="javascript:void(0);">
                        <img class="img-responsive" src="<?php echo $v['name'] ?>">
                    </a>
                </div>
                <div class="info_sale">
                    <a href="http://mireino.com">
                        <strong><?php echo $v['title'] ?></strong>
                    </a>
                    <div class="subtotal">
                        <div class="i_1">
                            <strong>&nbsp;</strong>
                        </div>
                        <div class="i_2">
                            <span><a href="javascript:void(0)"><i class="fa fa-minus"></i></a></span>
                            <span><a href="javascript:void(0)"><i class="fa fa-plus"></i></a></span>
                        </div>                
                    </div>                    
                     <div class="subtotal">
                        <div class="i_1">
                            <strong>Cantidad</strong>
                        </div>
                        <div class="i_2">
                            <span><?php echo $v['quantity'] ?></a></span>
                        </div>                
                    </div>
                    <div class="subtotal">
                        <div class="i_1">
                            <strong>Precio</strong>
                        </div>
                        <div class="i_2">
                            <span>$ <?php echo number_format($v['price'],2,",","."); ?></span>
                        </div>
                    </div>
                    <div class="subtotal">
                        <div class="i_1">
                            <strong>Total</strong>
                        </div>
                        <div class="i_2">
                            <span>$ <?php echo number_format($v['total'],2,",","."); ?></span>
                        </div>                
                    </div>
                    <span class="clear s_mb_15"></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</section>
<section class="total_">
    <div class="subtotal">
    <div class="form-control">
        <div class="i_1">
            <strong>Total a pagar</strong>
        </div>
        <div class="i_2">
            <span><?php echo "$ ".number_format($total_pay,2,",","."); ?></span>
        </div>    
    </div>
        
    </div>
    <div class="pay">
        <div>&nbsp;</div>    
        <div class="pay_total">
            <div class="btn btn-success" data-bind="click: _pyb">Comprar</div>
        </div>
    </div>    
</section>

<div class="modal fade" id="msg-pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="false">Cerrar</button>
        <h4 class="modal-title" id="myModalLabel">Gracias por su compra!</h4>
      </div>
      <div class="modal-body">
          Se enviara un correo al administrador de la pagina <strong><?php echo $company; ?></strong> para confirmar su compra.
      </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">CERRAR</button>
        <button class="btn btn-orange" data-bind="click: _py1">CONFIRMAR</button>
    </div>               
    </div>

  </div>
</div>
