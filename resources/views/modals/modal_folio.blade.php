<div class="modal" tabindex="-1" role="dialog" id="mdSuscripcion">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pt-4 pl-md-4 pr-md-4" style="background-color: #153D3C">
                <img src="{{asset('img/close.png')}}" alt="cerrar" class="cerrar" data-dismiss="modal">
                <div class="w-100 text-center mb-4">
                    <img src="{{asset('img/logo-header.svg')}}" alt="Casa amate" class="m-max-100 m30">
                    <h3 class="m20" style="font-weight: 400">¿Quieres consultar tu folio de compra?</h3>

                    <div class="input-group input-group-suscripcion">
                        <input type="number" name="modal_folio" id="modal_folio" class="form-control" placeholder="Ingresar el folio" aria-label="E-mail" aria-describedby="">
                        <div class="input-group-append">
                            <button class="btn btn-blanco-negro text-uppercase" id="enviar-suscripcion-footer">Consultar</button>
                        </div>
                    </div>
                    <p class="d-none" id="modal-error-folio">El campo folio está vacío</p>
                    <p class="w-100 small mt-4">Si necesitas apoyo, tienes dudas o alguna aclaración puedes ponerte en contacto con nosotros mediante el correo electrónico helpcenter@casaamate.mx y con gusto te apoyaremos.</p>
                </div>
            </div>
        </div>
    </div>
</div>