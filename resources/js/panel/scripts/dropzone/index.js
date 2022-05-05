import axios from 'axios';
import Dropzone from 'dropzone';
require('dropzone/dist/min/dropzone.min.css');
export default (function(){
    Dropzone.autoDiscover = false;
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Suelta tu(s) archivo(s) aquí";
    Dropzone.prototype.defaultOptions.dictFallbackMessage = "Su navegador no soporta arrastar y soltar archivos.";
    Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande ({{filesize}}MiB). Max tamaño de archivo: {{maxFilesize}}MiB.";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puede subir archivo de ese tipo.";
    Dropzone.prototype.defaultOptions.dictResponseError = "El servidor respondió con un status {{statusCode}} de código.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar subida";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Está seguro de cancelar está subida?";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover archivo";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puedes subir más archivos.";
    if(document.querySelector('.dropzone')){
        let dropzones = document.querySelectorAll('.dropzone');
        Array.from(dropzones).forEach((dr) => {
            //Creamos una instancia unica para dropzone instanciado en la vista
            let uuid = dr.getAttribute('id');
            var myDropzone = new Dropzone('#'+uuid, {
                url: dr.dataset.route,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                uploadMultiple: false,
                hiddenInputContainer: "div#"+uuid,
                maxFiles: 1,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                init: function() {
                    var curr = this;
                    if(document.getElementById('modal-media')){
                        $("#modal-media").on('show.bs.modal', function(){
                            axios.get(document.getElementById('modal-media').dataset.route)
                                .then(response => {
                                    if(response.data.success){
                                        document.querySelector('.row.modal-media').innerHTML = response.data.files.map((file, i) => {
                                            return `
                                        <div class="col-sm-3">
                                            <a href="javascript:;" class="select-uploaded" data-path="${file.path}" data-name="${file.name}" data-type="${file.type}" data-size="${file.size}" data-target="${i}-media">
                                                <div class="card clickble">
                                                    <img id="${i}-media" class="card-img" src="${file.url}" alt="Card image">
                                                </div>
                                            </a>
                                        </div>`;
                                        }).join("");
                                    }
                                    let uploads = document.querySelectorAll('.select-uploaded');
                                    console.log(uploads);
                                    Array.from(uploads).forEach(up => {
                                        up.addEventListener('click', e => {
                                            console.log('entra');
                                            $('#'+uuid+' div.dz-preview').remove();
                                            let mock = {name: up.dataset.name, size: up.dataset.size, type: up.dataset.type};
                                            curr.displayExistingFile(mock, document.getElementById(up.dataset.target).getAttribute('src'));
                                            $('#modal-media').modal('hide');
                                            document.querySelector(dr.dataset.target).value = up.dataset.path;
                                        });
                                    });
                                })
                                .catch(err => {
                                    console.log(err);
                                });
                        });
                    }
                    // if(document.querySelector('.select-uploaded')){
                    // }
                    if(document.querySelector(dr.dataset.target).value){
                        let mock = {name: document.querySelector(dr.dataset.target).value, type: 'image/*'};
                        // this.addFile.call(this, mock);
                        this.displayExistingFile(mock, document.querySelector(dr.dataset.target).dataset.asset+document.querySelector(dr.dataset.target).value);
                        // this.options.thumbnail.call(this, mock, document.querySelector(dr.dataset.target).dataset.asset+document.querySelector(dr.dataset.target).value);
                    }
                    this.on("success", (file, response) => {
                        $('#'+uuid+' div.dz-preview').remove();
                        this.removeAllFiles();
                        console.log(response);
                        let mock = {name: response.file_name, size: response.size, type: response.type};
                        console.log(mock);
                        // this.addFile.call(this, mock);
                        this.displayExistingFile(mock, response.url);
                        document.querySelector(dr.dataset.target).value = response.file_name;
                    });
                    this.on("removedfile", (file) => {
                        document.querySelector(dr.dataset.target).value = '';
                    });
                    // this.on("canceled", (f) => {
                    //     console.log('entra canceled');
                    // });
                }
            });
        })
    }
    if(document.querySelector('.dropzone-multiple')){
        var myDropzone = new Dropzone(".dropzone-multiple", {
            url: 'upload.php',
            autoProcessQueue: false,
            uploadMultiple: false,
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            init: function() {
                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
                this.on("addedfile", (file) => {
                    file.previewElement.classList.add("dz-success");
                });
            }
        });
    }
})();
