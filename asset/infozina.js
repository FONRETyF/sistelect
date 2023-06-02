var tabla;

function init(){

}


$(document).ready(function () {
    $('#zina_data').dataTable({
        "aProcessing": true, //procesamiento del datatable
        "aServerSide": true, //paginacion y filtrado por el servidor
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
        dom: 'Bfrtip', //definicion de los elementos del control de la tabla
        buttons: [		          
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax":{
            url: 'controller/zinacantepec.php?op=listar',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "ordering": false,
        'rowsGroup': [0,1],
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 50,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {          
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    }).DataTable();
});

$(document).on("click","#Reporte", function (e) {
    if (document.getElementById("RadBtnTurno1").checked) {
        location.href = "fileReporteZ.php"+"?turno="+1;
    }else if (document.getElementById("RadBtnTurno2").checked) {
        location.href = "fileReporteZ.php"+"?turno="+2;
    } else if (document.getElementById("RadBtnTurno3").checked) {
        location.href = "fileReporteZ.php"+"?turno="+3;
    } else if (document.getElementById("RadBtnTurno4").checked) {
        location.href = "fileReporteZ.php"+"?turno="+4;
    }  
});

function updateT1(idP) {
    $.post("controller/zinacantepec.php?op=actualizarVoto",{idPersona:idP,turno:"1"},function(data){       
             
    });
    tabla = $('#zina_data').DataTable();
    tabla.ajax.reload();
}

function updateT2(idP) {
    $.post("controller/zinacantepec.php?op=actualizarVoto",{idPersona:idP,turno:"2"},function(data){       
             
    });
    tabla = $('#zina_data').DataTable();
    tabla.ajax.reload();
}

function updateT3(idP) {
    $.post("controller/zinacantepec.php?op=actualizarVoto",{idPersona:idP,turno:"3"},function(data){       
                
    });
    tabla = $('#zina_data').DataTable();
    tabla.ajax.reload();
}

function updateT4(idP) {
    $.post("controller/zinacantepec.php?op=actualizarVoto",{idPersona:idP,turno:"4"},function(data){       
               
    });
    tabla = $('#zina_data').DataTable();
    tabla.ajax.reload();
}

function updateDelete(idP){
    $.post("controller/zinacantepec.php?op=corregirVoto",{idPersona:idP},function(data){       
               
    });
    tabla = $('#zina_data').DataTable();
    tabla.ajax.reload();
}

init();
