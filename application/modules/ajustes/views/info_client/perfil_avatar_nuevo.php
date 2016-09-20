<div id="modal-nuevo-avatar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-nuevo-avatar-titulo" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cambiar logo</h3>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3" data-bind="with:avatarEditar">
                        <img class="img-responsive" data-bind="attr:{src:logo}">
                    </div>

                    <div class="col-md-9">
                        <p><small>Seleccione algún foto</small></p>
                        <div class="row" id="_iP" data-bind="foreach:avatares">
                            <div class="col-sm-6 col-md-3" id="_hob">
                                <span class="delete fa fa-times-circle fa-lg"><i data-bind="text:_Pimg"></i></span>
                                <a class="thumbnail" data-bind="click:$root.perfil.avatar_nuevo_default, attr:{href:logo}"><img data-bind="attr:{src:avatar}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                    <div class="col-md-6">
                        <form action="<?php echo site_url($domain.'/ajustes/api/datos/UploadFile/'); ?>"  accept-charset="utf-8" role="form" id="uploadImg" method="POST" enctype="multipart/form-data" >
                            <div class="col-md-1 col-md-offset-0">
                                    <span class="fa fa-camera fa-2x fileinput-button ">
                                        <?php if($this->CI->dx_auth->is_logged_in()): ?>
                                        <input type="file" name="file" value="" id="file" tabindex="1" class="ui-button-text" multiple="1">
                                        <?php endif; ?>
                                    </span>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                            </div>
                        </form>
                    </div>
                <button class="btn" data-dismiss="modal" aria-hidden="true">CERRAR</button>
            </div>
        </div>
    </div>
</div>