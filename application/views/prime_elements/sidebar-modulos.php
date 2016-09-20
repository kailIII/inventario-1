<aside>
    <div class="asideContent">
        <section class="row" id="cartMenu">
            <div class="s_nav">
                <div class="cartData">
                    <div class="col-md-6 thumb_">
                    <a class='thumbnail fancybox-buttons' href="<?php echo $logo__; ?>">
                            <img class="img-responsive" src="<?php echo $logo__; ?>" >
                        </a>
                    </div>
                    <div class="info_sale">
                        <a href="<?php echo site_url(); ?>">
                            <strong> Sistema Deluxer, <em>un sitio para compartir</em>.</strong>
                        </a>
                        <h6><b>Lo estamos construyendo para su mejor funcionalidad</b></h6>
                        <small>¡Disculpe las molestias!</small>
                        <span class="clear s_mb_15"></span>
                    </div>
                </div>
            </div>    
        </section>
        <section id="slider">
            <ul class="bjqs">
                <?php foreach($postSidebar as $k => $v): ?>
                    <li>
                        <?php if(is_array($v["name"])): ?>
                    <img src="<?php echo $v['name'] ?>">
                        <?php else: ?>
                    <img src="<?php echo $v['name'] ?>">
                        <?php endif; ?>
                        <a class="_dir" href="<?=site_url("$domSidebar/")."/$v[category]/$v[id]/".urls_amigables($v['title'])?>" ><i class="fa fa-eye fa-2x"></i></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
         <section class="page-social">
            <div class="fb-page" data-href="https://www.facebook.com/<?php echo $socialNetwork['facebook']; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/<?php echo $socialNetwork['facebook']; ?>">
                        <a href="https://www.facebook.com/<?php echo $socialNetwork['facebook']; ?>"></a>
                    </blockquote>
                </div>
            </div>
        </section>
        <section class="items">
            <div class="_rmore">
                <div>Mas vistos</div>
            </div>    
            <?php foreach($postSidebar as $k => $v): ?>
            <?php if($v["price"]): ?>
            <article>
                <div class="itemThumb">
                    <a href="javascript:;">
                    <img src="<?php echo $v['name'] ?>">
                    </a>
                </div>
                <div class="itemData">
                    <hgroup><h3><a href="<?=site_url("$domSidebar/")."/$v[category]/$v[id]/".urls_amigables($v['title'])?>" ><?php echo $v["title"]; ?></a></h3></hgroup>
                    <div class="itemPrice">
                        <?php if($v["oldprice"]): ?>
                        <p class="price promoPrice"><span class="oldPrice"><span class="currency before">$</span><?php echo $v["price"]; ?></span><span class="s_currency s_before">$</span><?php echo $v["oldprice"]; ?></p>
                        <?php else: ?>
                        <p class="price"><span class="currency before">$</span><?php echo $v["price"]; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="itemAction">
                        <a class="addCar" href="javascript:;" onclick="addToCart('40');">
                            <span class="iconCar fa fa-shopping-cart"><span class="iconText"></span>Agregar al carrito</span>
                        </a>
                    </div>
                </div>
            </article>
            <?php else: ?>
            <article>
                <hgroup><h2><a href="<?=site_url("$domSidebar/")."/$v[category]/$v[id]/".urls_amigables($v['title'])?>" ><?php echo $v["title"]; ?></a></h2></hgroup>
                <div class="date"><?php echo substr($v["registred_on"],0,16); ?> <a href="<?php echo site_url("$domSidebar/$v[category]"); ?>"><?php echo $v["category"] ?></a></div>
                <div class="thumb">
                    <?php if($v["name"]): ?>
                    <img src="<?php echo $v['name']; ?>">
                    <?php elseif($v["video"]): ?>
                    <div class="video">
                    <?php echo html_entity_decode($v["video"]); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="extract">
                <?php if(!$v["name"] and !$v["video"]): ?>
                    <?php echo substr($v["description"],0,270).((strlen($v["description"])>270?"...":"")); ?>
                <?php else: ?>
                        <?php echo substr(strip_tags(html_entity_decode($v["description"])),0,150).(strlen(strip_tags(html_entity_decode($v["description"])))>150?"....":""); ?>
                <?php endif; ?>
            </article>
            <?php endif; ?>        
            <?php endforeach; ?>
        </section>
    </div>
</aside>
