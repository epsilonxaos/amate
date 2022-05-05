// initialize a new FileUploadWithPreview object
import FileUploadWithPreview from 'file-upload-with-preview';
require('file-upload-with-preview/src/file-upload-with-preview.scss');

export default (function(){
    window.addEventListener('load', () => {
        let elems = document.querySelectorAll('.fileWithPreview-elms');
        Array.from(elems).forEach(el => {
            new FileUploadWithPreview(el.getAttribute('id'), {
                text: {
                    chooseFile: 'Escoger archivo',
                    browse: 'Buscar',
                },
                presetFiles: ((document.getElementById(el.getAttribute('id')+'-preset_file')) ? [document.getElementById(el.getAttribute('id')+'-preset_file').value] : [])
            });
        });
    });
})();
