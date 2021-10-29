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
                        if(action == "readEmployee"){
                            if(result){
                                $("#readEmployee").html("<table id='tableEmp'>"+
                                "<thead><th>Código</th><th>Nome</th><th>Usuário</th><th>CPF</th><th>Data de Nascimento</th><th>Gênero</th>"+
                                "<th>Bairro</th><th>Cidade</th><th>Atualizar</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableEmp').append("<tr>"+
                                    "<td>"+result[i]['FuncionarioID']+"</td>"+                            
                                    "<td>"+result[i]['FuncionarioNome']+"</td>"+
                                    "<td>"+result[i]['FuncionarioUsuario']+"</td>"+                            
                                    "<td>"+result[i]['FuncionarioCPF']+"</td>"+
                                    "<td>"+result[i]['FuncionarioDataNasc']+"</td>"+
                                    "<td>"+result[i]['FuncionarioSexo']+"</td>"+
                                    "<td>"+result[i]['BairroNome']+"</td>"+
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td><form class='empFormUp' action='forms/updates.php' method='POST'><input type='hidden' name='id' value='"+result[i]['FuncionarioID']+"'>"+
                                    "<input type='hidden' name='action' value='updateEmployee'><button type='submit' class='updateBtn'><span class='fas fa-pen'></span></button></form></td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['FuncionarioID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readEmployee").html("<p>Nenhum funcionário encontrado!</p>");
                            }
                        }else if(action == "readClient"){
                            if(result){
                                $("#readClient").html("<table id='tableCli'>"+
                                "<thead><th>Código</th><th>Nome</th><th>CPF</th><th>Data de Nascimento</th><th>Gênero</th>"+
                                "<th>Bairro</th><th>Cidade</th><th>Atualizar</th><th>Excluir</th>"+
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
                                    "<td><form class='CliFormUp' action='forms/updates.php' method='POST'><input type='hidden' name='id' value='"+result[i]['ClienteID']+"'>"+
                                    "<input type='hidden' name='action' value='updateClient'><button type='submit' class='updateBtn'><span class='fas fa-pen'></span></button></form></td>"+
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
                                "<thead><th>Código</th><th>Nome</th><th>Cidade</th><th>Atualizar</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableDis').append("<tr>"+
                                    "<td>"+result[i]['BairroID']+"</td>"+                            
                                    "<td>"+result[i]['BairroNome']+"</td>"+
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td><form class='disFormUp' action='forms/updates.php' method='POST'><input type='hidden' name='id' value='"+result[i]['BairroID']+"'>"+
                                    "<input type='hidden' name='action' value='updateDistrict'><button type='submit' class='updateBtn'><span class='fas fa-pen'></span></button></form></td>"+
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
                                "<thead><th>Código</th><th>Nome</th><th>Estado</th><th>Atualizar</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableCit').append("<tr>"+
                                    "<td>"+result[i]['CidadeID']+"</td>"+                            
                                    "<td>"+result[i]['CidadeNome']+"</td>"+
                                    "<td>"+result[i]['CidadeUF']+"</td>"+
                                    "<td><form class='citFormUp' action='forms/updates.php' method='POST'><input type='hidden' name='id' value='"+result[i]['CidadeID']+"'>"+
                                    "<input type='hidden' name='action' value='updateCity'><button type='submit' class='updateBtn'><span class='fas fa-pen'></span></button></form></td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['CidadeID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readCity").html("<p>Nenhuma cidade encontrada!</p>");
                            }
                        }else if(action == "readModule"){
                            if(result){
                                $("#readModule").html("<table id='tableMod'>"+
                                "<thead><th>Código</th><th>Nome</th><th>Atualizar</th><th>Excluir</th>"+
                                "<tbody>"+              
                                "</tbody></table>");
                                for (var i = 0; i < result.length; i++) {                            
                                    $('#tableMod').append("<tr>"+
                                    "<td>"+result[i]['ModuloID']+"</td>"+                            
                                    "<td>"+result[i]['ModuloNome']+"</td>"+
                                    "<td><form class='modFormUp' action='forms/updates.php' method='POST'><input type='hidden' name='id' value='"+result[i]['ModuloID']+"'>"+
                                    "<input type='hidden' name='action' value='updateModule'><button type='submit' class='updateBtn'><span class='fas fa-pen'></span></button></form></td>"+
                                    "<td><a href='#' class='deleteBtn' id='"+result[i]['ModuloID']+"'><span class='fas fa-trash'></span></a></td>"+
                                    "</tr>"
                                    );                        
                                }
                            }else{
                                $("#readModule").html("<p>Nenhum módulo encontrado!</p>");
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
            url: "php/control.php",
            method: "POST",
            data: data + "&action="+action,
            dataType: "json",
            success: function(result){
                Swal.fire(
                    'Delteado!',
                    result['message'],
                    'success'
                  )
                if(result['logout']){
                    window.location.href = 'php/logout.php';
                }
            },
            error: function(e){
                console.log(e.status);
            }
        });
    }



    var btnEmp = $(".btnSearchEmp");
    btnEmp.click(function(){
        var dataEmp = $(".employeeForm").serialize();        
        readGeneric("readEmployee", dataEmp, "table");
        
        return false;
    });

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

    var btnMod = $(".btnSearchMod");
    btnMod.click(function(){
        var dataMod = $(".moduleForm").serialize();
        readGeneric("readModule", dataMod, "table");

        return false;
    });



    $('#readEmployee').on('click', '.deleteBtn', function(){
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
          }).then((result) => {
            if (result.isConfirmed) {
                deleteGeneric('deleteEmployee', 'id='+id);
                readGeneric("readEmployee", "employee=", "table");
            }
          })

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
          }).then((result) => {
            if (result.isConfirmed) {
                deleteGeneric('deleteClient', 'id='+id);
                readGeneric("readClient", "client=", "table");
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
          }).then((result) => {
            if (result.isConfirmed) {
                deleteGeneric('deleteDistrict', 'id='+id);
                readGeneric("readDistrict", "district=", "table");
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
          }).then((result) => {
            if (result.isConfirmed) {
                deleteGeneric('deleteCity', 'id='+id);
                readGeneric("readCity", "city=", "table");
            }
          })        
        return false;
    });

    $('#readModule').on('click', '.deleteBtn', function(){
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
          }).then((result) => {
            if (result.isConfirmed) {
                deleteGeneric('deleteModule', 'id='+id);
                readGeneric("readModule", "city=", "table");
            }
          })        
        return false;
    });
    
    readGeneric("readEmployee", $(".employeeForm").serialize(), "table");
    readGeneric("readClient", $(".clientForm").serialize(), "table");
    readGeneric("readDistrict", $(".districtForm").serialize(), "table");
    readGeneric("readCity", $(".cityForm").serialize(), "table");
    readGeneric("readModule", $(".moduleForm").serialize(), "table");
});