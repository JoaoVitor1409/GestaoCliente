$(document).ready(function(){

    function readGeneric(action, data, type){
        $.ajax({
            url: "php/control.php",
            method: "POST",
            data: data + "&action="+action,
            dataType: "json",
            success: function(result){
                switch (type) {
                    case "table":
                        if(action == "readClient"){
                            if(result){
                                $("#readClient").html("<table id='tableCli'>"+
                                "<thead><th>Código</th><th>Nome</th><th>CPF</th><th>Data de Nascimento</th><th>Gênero</th><th>Bairro</th><th>Cidade</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableCli').append("<tr>"+
                                    "<td>"+result[i]['ClienteID']+"</td>"+                            
                                    "<td>"+result[i]['ClienteNome']+"</td>"+
                                    "<td>"+result[i]['ClienteCPF']+"</td>"+
                                    "<td>"+result[i]['ClienteDataNasc']+"</td>"+
                                    "<td>"+result[i]['ClienteSexo']+"</td>"+
                                    "<td>"+result[i]['BairroNome']+"</td>"+
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['ClienteID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readClient").html("<p>Nenhum cliente encontrado!</p>");
                            }
                        }else if(action == "readDistrict"){
                            if(result){
                                $("#readDistrict").html("<table id='tableDis'>"+
                                "<thead><th>Código</th><th>Nome</th><th>Cidade</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableDis').append("<tr>"+
                                    "<td>"+result[i]['BairroID']+"</td>"+                            
                                    "<td>"+result[i]['BairroNome']+"</td>"+
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['BairroID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readDistrict").html("<p>Nenhum bairro encontrado!</p>");
                            }
                        }else if(action == "readCity"){
                            if(result){
                                $("#readCity").html("<table id='tableCit'>"+
                                "<thead><th>Código</th><th>Nome</th><th>Estado</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableCit').append("<tr>"+
                                    "<td>"+result[i]['CidadeID']+"</td>"+                            
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td>"+result[i]['CidadeUF']+"</td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['CidadeID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readDistrict").html("<p>Nenhuma cidade encontrada!</p>");
                            }
                        }
                    break;
                
                    case "list":
                        if(action == "readClient"){
                            $("#readClient").html("<ul id='listClient'></ul>");
                            for(var i=0; i< result.length; i++){
                                $("#listClient").append(
                                "<li>ID: "+result[i]['ClienteID']+"</li>" +
                                "<li>Nome: "+result[i]['ClienteNome']+"</li>" +
                                "<li>CPF: "+result[i]['ClienteCPF']+"</li>" +
                                "<li>Data de Nasc.: "+result[i]['ClienteDataNasc']+"</li>" +
                                "<li>Gênero: "+result[i]['ClienteSexo']+"</li>" +
                                "<li>Bairro: "+result[i]['BairroNome']+"</li>" +
                                "<li>Cidade: "+result[i]['CidadeNome']+"</li>" +
                                "<li><a href='#' class='deleteBtn' id='"+result[i]['ClienteID']+"'><span class='fas fa-trash'></span></a></li>" +
                                "<br>"
                                );
                            }
                        }else if(action == "readDistrict"){
                            $("#readDistrict").html("<ul id='listDistrict'></ul>");
                            for(var i=0; i< result.length; i++){
                                $("#listDistrict").append(
                                "<li>ID: "+result[i]['BairroID']+"</li>" +
                                "<li>Nome: "+result[i]['BairroNome']+"</li>" +
                                "<li>Cidade: "+result[i]['CidadeNome']+"</li>" +
                                "<li><a href='#' class='deleteBtn' id='"+result[i]['BairroID']+"'><span class='fas fa-trash'></span></a></li>" +
                                "<br>"
                                );
                            }
                        }else if(action == "readCity"){
                            $("#readCity").html("<ul id='listCity'></ul>");
                            for(var i=0; i< result.length; i++){
                                $("#listCity").append(
                                "<li>ID: "+result[i]['CidadeID']+"</li>" +
                                "<li>Nome: "+result[i]['CidadeNome']+"</li>" +
                                "<li>Cidade: "+result[i]['CidadeUF']+"</li>" +
                                "<li><a href='#' class='deleteBtn' id='"+result[i]['CidadeID']+"'><span class='fas fa-trash'></span></a></li>" +
                                "<br>"
                                );
                            }
                        }
                        break;

                }
            },
            error: function(e){
                console.log(e.status);                    
                if(e.status == 404){
                    errorSend();
                }
            }
        });
    }
    
    function deleteGeneric(action, data){
        $.ajax({
            url: "../GestaoCliente/php/control.php",
            method: "POST",
            data: data + "&action="+action,
            dataType: "json",
            success: function(result){
                
            },
            error: function(e){
                console.log(e.status);
            }
        });
    }

    var btnCli = $(".btnSearchCli");
    btnCli.click(function(){
        var dataCli = $(".clientForm").serialize();        
        readGeneric("readClient", dataCli, "table");
        
        return false;
    });

    var btnDis = $(".btnSearchDis");
    btnDis.click(function(){
        var dataDis = $(".districtForm").serialize();        
        readGeneric("readDistrict", dataDis, "table");
        
        return false;
    });

    var btnCit = $(".btnSearchCity");
    btnCit.click(function(){
        var dataCit = $(".cityForm").serialize();        
        readGeneric("readCity", dataCit, "table");
        
        return false;
    });

    $('#readClient').on('click', '.deleteBtn', function(){  
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Alerta!',
            text: "Você tem certeza que deseja excluir esse registro? Pode acontecer problemas dependendo do registro.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim'
          }).then((result2) => {
            if (result2.isConfirmed) {
                deleteGeneric('deleteClient', 'id='+id);
                readGeneric("readClient", "client=", "table");
                Swal.fire(
                    'Deletado!',
                    result['message'],
                    'success'
                )
            }
          })

        return false;
    });

    $('#readDistrict').on('click', '.deleteBtn', function(){
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Alerta!',
            text: "Você tem certeza que deseja excluir esse registro? Pode acontecer problemas dependendo do registro.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim'
          }).then((result2) => {
            if (result2.isConfirmed) {
                deleteGeneric('deleteDistrict', 'id='+id);
                readGeneric("readDistrict", "district=", "table");
                Swal.fire(
                    'Deletado!',
                    result['message'],
                    'success'
                )
            }
          })        

        return false;
    });

    $('#readCity').on('click', '.deleteBtn', function(){
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Alerta!',
            text: "Você tem certeza que deseja excluir esse registro? Pode acontecer problemas dependendo do registro.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim'
          }).then((result2) => {
            if (result2.isConfirmed) {
                deleteGeneric('deleteCity', 'id='+id);
                readGeneric("readCity", "city=", "table");
                Swal.fire(
                    'Deletado!',
                    result['message'],
                    'success'
                )
            }
          })        
        return false;
    });


    readGeneric("readClient", $(".clientForm").serialize(), "table");
    readGeneric("readDistrict", $(".districtForm").serialize(), "table");
    readGeneric("readCity", $(".cityForm").serialize(), "table");
});