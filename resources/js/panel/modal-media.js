import axios from 'axios';

 if(document.getElementById('modal-media')){
     $("#modal-media").on('show.bs.modal', function(){
         axios.get(document.getElementById('modal-media').dataset.route)
         .then(response => {
             console.log(response);
             if(response.data.success){
                 document.querySelector('.row.modal-media').innerHTML = response.data.files.map((file, i) => {
                     return `
                     <div class="col-sm-3">
                         <a href="javascript:;" class="select-uploaded" data-name="${file.name}" data-type="${file.type}" data-size="${file.size}" data-target="${i}-media">
                             <div class="card clickble">
                                 <img id="${i}-media" class="card-img" src="${file.url}" alt="Card image">
                             </div>
                         </a>
                     </div>`;
                 }).join("");
             }
         })
         .catch(err => {
             console.log(err);
         });
     });
 }
