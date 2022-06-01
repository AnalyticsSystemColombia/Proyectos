
var tableConductor;

document.addEventListener('DOMContentLoaded', function(){

	tableConductor = $('#tableConductor').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Conductores/getConductores",
            "dataSrc":""
        },
        "columns":[
            {"data":"cedula"},
            {"data":"Nombres"},
            {"data":"direccion"},
            {"data":"telefono"},
            {"data":"ciudad"},
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

    //nuevo conductor
    var formConductor = document.querySelector("#formConductor");
    formConductor.onsubmit = function(e) {
        e.preventDefault();

        var  id = document.querySelector('#id').value;
        var intCedula = document.querySelector('#txtcedula').value;
        var strNombres = document.querySelector('#txtnombres').value;
        var strApellidos = document.querySelector('#txtapellido').value; 
        var strDireccion = document.querySelector('#txtdireccion').value;
        var intTelefono = document.querySelector('#txttelefono').value;
        var strCiudad = document.querySelector('#txtciudad').value;
        var strStatus = document.querySelector('#listStatus').value;
        if(intCedula == '' || strNombres == '' || strApellidos == ''|| strDireccion == '' ||intTelefono == '' || strCiudad == ''|| strStatus == '')
        {
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
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Conductores/setConductores'; 
        var formData = new FormData(formConductor);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormConductor').modal("hide");
                    formConductor.reset();
                    swal("Conductores", objData.msg ,"success");
                    tableConductor.api().ajax.reload(function(){ 
                        fntEditConductor();
                    });
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
        }

        
    }

});

$('#tableConductor').DataTable();

function openModal(){

    document.querySelector('#id').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Conductor";
    document.querySelector("#formConductor").reset();
	$('#modalFormConductor').modal('show');
}

window.addEventListener('load', function() {
    fntEditConductor();
    fntDelConductor();
}, false);

function fntEditConductor(){
    var btnEditConductor = document.querySelectorAll(".btnEditConductor");
    btnEditConductor.forEach(function(btnEditConductor) {
        btnEditConductor.addEventListener('click', function(){

            document.querySelector('#titleModal').innerHTML ="Actualizar conductor";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            var id = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl  = base_url+'/Conductores/getConductor/'+id;
            request.open("GET",ajaxUrl ,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        document.querySelector('#id').value = objData.data.id;
                        document.querySelector('#txtcedula').value = objData.data.cedula;
                        document.querySelector('#txtnombres').value = objData.data.nombres;
                        document.querySelector('#txtapellido').value= objData.data.apellidos; 
                        document.querySelector('#txtdireccion').value= objData.data.direccion;
                        document.querySelector('#txttelefono').value= objData.data.telefono;
                        document.querySelector('#txtciudad').value= objData.data.ciudad;
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
                        $('#modalFormConductor').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
            
        });
    });
}

function fntDelConductor(){
    var btnDelConductor = document.querySelectorAll(".btnDelConductor");
    btnDelConductor.forEach(function(btnDelConductor) {
        btnDelConductor.addEventListener('click', function(){
            var id = this.getAttribute("rl");
            swal({
                title: "Eliminar Conductor",
                text: "¿Realmente quiere eliminar el Conductor?",
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
                    var ajaxUrl = base_url+'/conductores/delConductor/';
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



