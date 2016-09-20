<div class="mygallery">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group clearfix">
                    <select id="galleryfilter" class="form-control pull-left">
                        <option data-filter="all">Show All</option>
                        <option data-filter="industrial">Industrial</option>
                        <option data-filter="architecture">Architecture</option>
                        <option data-filter="nature">Nature</option>
                        <option data-filter="architecture industrial">Architecture &amp; Industrial</option>
                    </select>
                </div>
            </div>

            <div class="col-md-9">
                <div class="pull-right">
                    <div class="btn-toolbar form-group clearfix">
                        <button class="btn btn-default sort" data-sort="random"><i class="fa fa-random"></i><span class="hidden-xs"> Randomize</span></button>
                            <div class="btn-group">
                                <button class="btn btn-default sort" data-sort="default" data-order="desc">Default</button>
                                <button class="btn btn-default sort" data-sort="data-name" data-order="desc"><i class="fa fa-sort-alpha-asc"></i><span class="hidden-xs"> Name</span></button>
                                <button class="btn btn-default sort active" data-sort="data-name" data-order="asc"><i class="fa fa-sort-alpha-desc"></i><span class="hidden-xs"> Name</span></button>
                            </div>

                        <div class="btn-group">
                            <button class="btn btn-default active" id="GoGrid"><i class="fa fa-th"></i></button>
                            <button class="btn btn-default" id="GoList"><i class="fa fa-th-list"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="gallery list-unstyled" style="   ">
                <?php foreach($articles as $k => $v): ?>
                      <li class="mix nature mix_all" data-name="Woodstump" style=" display: inline-block; opacity: 1;">
                      <a href="<?=site_url('application/assets/application/img/galery/nature_woodstump.jpg')?>">
                        <img class="thumb" src="<?=site_url('application/assets/application/img/ui/aguila1.jpg')?>">
                        </a>
                        <h4><?php echo substr($v["post"],0,250); ?></h4>
                        <h6><?php echo substr($v["title"],0,30); ?></h6>
                    </li>                                                                             
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>