let tableVehiculos;
let rowTable ="";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
    tableVehiculos = $('#tableVehiculos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/vehiculos/getVehiculos",
            "dataSrc":""
        },
        "columns":[
            {"data":"propietario"},
            {"data":"placa"},
            {"data":"marca"},
            {"data":"color"},
            {"data":"tipo"},
            {"data":"nombres"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });
//insertar
if(document.querySelector("#formVehiculo")){
    let formVehiculo = document.querySelector("#formVehiculo");
    formVehiculo.onsubmit = function(e){
            e.preventDefault();
            let strplaca = document.querySelector('#txtplaca').value;
            let intconduc = document.querySelector('#listCondu').value;
            let strmarca = document.querySelector('#txtmarca').value;
            let strcolor = document.querySelector('#txtcolor').value;
            let inttipo = document.querySelector('#listTipo').value;
            let strpropi = document.querySelector('#txtpropietario').value;
            let intStatus = document.querySelector('#listStatus').value;
        if(strplaca == '' || intconduc == '' || strmarca == '' || strcolor == '' || inttipo == '' || strpropi == ''){
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++){ 
            if(elementsValid[i].classList.contains('is-invalid')){ 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/vehiculos/setVehiculos'; 
        let formData = new FormData(formVehiculo);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    if(rowTable ==""){
                        tableVehiculos.api().ajax.reload();
                    }else{
                        htmlStatus = intStatus == 1 ?
                        '<span class="badge badge-succes">Activo</span>':
                        '<span class="badge badge-danger">Inactivo</span>';
                        htmlTipo = intStatus == 1 ?
                        '<span class="badge badge-succes">Publico</span>':
                        '<span class="badge badge-danger">Privado</span>';

                        rowTable.cells[1].textContent =strplaca;
                        rowTable.cells[2].textContent = document.querySelector("#listCondu").selectedOptions[0].text;
                        rowTable.cells[3].textContent =strmarca;
                        rowTable.cells[4].textContent =strcolor;
                        rowTable.cells[5].innerHTML = htmlTipo;
                        rowTable.cells[6].textContent = strpropi;
                        rowTable.cells[7].innerHTML = htmlStatus;
                    }
                    $('#modalVehiculos').modal("hide");
                    formVehiculo.reset();
                    swal("Vehiculos", objData.msg ,"success");
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
}
}, false);

window.addEventListener('load', function(){
    fntConductor();
    fntEditVehiculo();
    fntDelVehiculo();
}, false);

function fntConductor(){
    if(document.querySelector('#listCondu')){
        let ajaxUrl = base_url+'/conductores/getSelectConductores';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listCondu').innerHTML = request.responseText;
              
            }
        }
    }
}

function fntEditVehiculo(){
    var btnEditVehiculos = document.querySelectorAll(".btnEditVehiculos");
    btnEditVehiculos.forEach(function(btnEditVehiculos) {
        btnEditVehiculos.addEventListener('click', function(){

            document.querySelector('#titleModal').innerHTML ="Actualizar Vehiculo";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            var id_conductor = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl  = base_url+'/vehiculos/getVehiculo/'+id_conductor;
            request.open("GET",ajaxUrl ,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        document.querySelector('#id_conductor').value = objData.data.id_conductor;
                        document.querySelector('#txtplaca').value = objData.data.placa;
                        document.querySelector('#listCondu').value = objData.data.id_conductor;
                        document.querySelector('#txtmarca').value= objData.data.marca; 
                        document.querySelector('#txtcolor').value= objData.data.color;
                        document.querySelector('#listTipo').value= objData.data.tipo;
                        document.querySelector('#txtpropietario').value= objData.data.propietario;
                        document.querySelector('#listStatus').value = objData.data.status;

                        if(objData.data.status == 1)
                        {
                            var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                        }else{
                            var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                        }
                        var htmlSelect = `${optionSelect}
                                          <option value="1">Activo</option>
                                          <option value="2">Inactivo</option>
                                        `;
                        document.querySelector("#listStatus").innerHTML = htmlSelect;
                        $('#modalVehiculos').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
            
        });
    });
}
//eliminar
function fntDelVehiculo(){
    var btnDelVehiculo = document.querySelectorAll(".btnDelVehiculo");
    btnDelVehiculo.forEach(function(btnDelVehiculo) {
        btnDelVehiculo.addEventListener('click', function(){
            var id = this.getAttribute("rl");
            swal({
                title: "Eliminar Vehiculo",
                text: "¿Realmente quiere eliminar el Vehiculo?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/vehiculos/delVehiculo/';
                    var strData = "idrol="+idrol;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!", objData.msg , "success");
                                tableRoles.api().ajax.reload(function(){
                                    fntEditConductor();
                                    fntDelConductor();
                                });
                            }else{
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }

            });

        });
    });
}
//carga modal
function openModal(){
    rowTable ="";
    document.querySelector('#id_conductor').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Vehiculo";
    document.querySelector("#formVehiculo").reset();
    $('#modalVehiculos').modal('show');
}
