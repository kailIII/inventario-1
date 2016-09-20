<section id="article_list" class="itmpost">
    <div class="panel panel-orange">
        <div class="panel-heading">
            <h4>Todos los articulos</h4>
        </div>
        <div class="panel-body collapse in" style="display: block;">
            <div role="grid" class="dataTables_wrapper" id="example_wrapper">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="example_length" class="dataTables_length">
                            <select name="example_length" size="1" aria-controls="example" class="form-control">
                                <option value="10" selected="selected">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <label>N° por pagina</label>
                    </div>
                    <div class="col-xs-2">
                        <div class="dataTables_filter" id="example_filter">
                            <label>
                                <input type="text" aria-controls="example" class="form-control" data-bind="value: searchT, valueUpdate:'afterkeydown', event: { keyup: $root.order.search }" placeholder="Buscar...">
                            </label>
                        </div>
                    </div>
                </div>
                <table data-bind="with: articles.all_art" cellspacing="0" cellpadding="0" border="0" id="example" class="table table-striped table-bordered datatables dataTable" aria-describedby="example_info">

                    <thead>
                        <tr role="row">
                        	<th></th>
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Nº</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 266px;" aria-label="Browser: activate to sort column ascending" data-bind="click: $root.order.title">N° invntario</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 230px;" aria-label="Platform(s): activate to sort column ascending" data-bind="click: $root.order.cat">Nombre</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 107px;" aria-label="CSS grade: activate to sort column ascending" data-bind="click: $root.order.date">Descripcion</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 152px;" aria-label="Engine version: activate to sort column ascending" data-bind="click: $root.order.type">Status</th>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all" data-bind="foreach: $root.ar_view">
                        <tr class="gradeA odd">
		                    <td>
		                    	<span class="fa fa-file-text-o fa-lg" data-toggle="modal" data-target="#showarticles" data-bind="click: $root.articles.Detalles"></span>
		                    </td>                        
                            <td data-bind="text: id"></td>
                            <td><a href="javascript:void(0)" data-bind="">001</a></td>
                            <!-- <td><a href="<?//=site_url("$domain/")."/".urls_amigables($v['category'])."/$v[id]/".urls_amigables($v['title'])?>" data-bind="text: title"></a></td> -->
                            <td data-bind="text: title"></td>
                            <td data-bind="text: description"></td>
                            <td data-bind="text: status"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="dataTables_info" id="example_info">Pagina 1 de 1</div>
                    </div>
                    <div class="col-xs-6">
                        <div class="dataTables_paginate paging_bootstrap">
                            <ol class="pagination">
                                <li class="prev disabled"><a href="#"><i class="fa fa-long-arrow-left"></i> Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li class="next"><a href="#">Next <i class="fa fa-long-arrow-right"></i></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Model resultado -->
<div class="modal fade" id="showarticles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modal-product">
    <div class="modal-content">              
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="false">X</button>
        <h4 class="modal-title" id="myModalLabel">ARTICULOS ACTIVOS FIJOS</h4>        
      </div>
      <div class="modal-body" data-bind="with: $root.product_view">                           
          {paso1}                              
          {paso2} 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

</section>
