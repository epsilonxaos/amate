<div class="modal" tabindex="-1" role="dialog" id="mdSuscripcion">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pt-4 pl-md-4 pr-md-4">
                <img src="{{asset('img/icons/icon-closed.png')}}" alt="cerrar" class="cerrar" data-dismiss="modal">
                <div class="w-100 text-center">
                    <img src="{{asset('img/menu/logo.svg')}}" alt="e-stom" class="m-max-100 m30">
                    <h3 class="m20">¿Quieres consultar tu folio de compra?</h3>

                    <div class="input-group input-group-suscripcion">
                        <input type="number" name="modal_folio" id="modal_folio" class="form-control" placeholder="Ingresar el folio" aria-label="E-mail" aria-describedby="">
                        <div class="input-group-append">
                            <button class="btn btn-blanco-negro text-uppercase" id="enviar-suscripcion-footer">Consultar</button>
                        </div>
                    </div>
                    <p class="d-none" id="modal-error-folio">El campo folio está vacío</p>
                </div>
            </div>
        </div>
    </div>
</div>