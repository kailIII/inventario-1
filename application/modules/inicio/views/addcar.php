<section class="row" id="cartMenu">
<?php if($art): ?>
<?php foreach($art as $K=>$v): ?>
    <div class="s_nav">
        <div class="pricePrime">
            <a href="javascript:void(0)">
                <span class="fa fa-check-circle fa-2x"></span>
            </a>
            <a href="javascript:void(0);">
                <strong><span>$<?php echo $v["price"]; ?></span></strong>
            </a>
        </div>    
        <div class="cartData">
            <div class="col-md-6 thumb_">
                <a class="thumbnail" href="http://mireino.com">
                    <img src="<?=$v['name'];?>" alt="iPhone" title="iPhone">
                </a>
            </div>
            <div class="info_sale">
                <a href="http://mireino.com">
                    <strong><?php echo $v["title"]; ?></strong>
                </a>
                 <div class="subtotal">
                    <div class="i_1">
                        <strong>Cantidad</strong>
                    </div>
                    <div class="i_2">
                        <span>1</span>
                    </div>                
                </div>
                <div class="subtotal">
                    <div class="i_1">
                        <strong>Precio</strong>
                    </div>
                    <div class="i_2">
                        <span>$<?php echo number_format($v["price"],2,".",","); ?></span>
                    </div>
                </div>
                <div class="subtotal">
                    <div class="i_1">
                        <strong>Total</strong>
                    </div>
                    <div class="i_2">
                        <span>$<?php echo number_format($v["price"],2,".",","); ?></span>
                    </div>                
                </div>
                <span class="clear s_mb_15"></span>
            </div>
        </div>
    </div>     
<?php endforeach; ?>
<?php endif; ?>
</section>