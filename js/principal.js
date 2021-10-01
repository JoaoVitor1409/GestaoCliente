$(document).ready(function(){

    var result = $(".result");

    function success(message) {
        result.empty().html("<p class='success'>"+ message + "</p>").fadeIn("fast");
    }
    function errorSend() {
        result.empty().html("<p class='error'><strong>Erro: Por favor, entre em contanto com o suporte</strong></p>").fadeIn("fast");
    }
    function errorData(message) {
        result.empty().html("<p class='error'>"+ message + "</p>").fadeIn("fast");
    }

    var btn = $(".btnSubmit");
    btn.click(function(){

        var dataDis = $(".districtForm").serialize();
        var dataCit = $(".cityForm").serialize();
        var dataCliRem = $(".clientFormDel").serialize();
        var dataCliUp = $(".clientFormUp").serialize();
        var dataDisUp = $(".districtFormUp").serialize();
        var dataCitUp = $(".cityFormUp").serialize();
        
        if(dataDis != ""){
            $.ajax({
                url: "../php/insertDistrict.php",
                method: "POST",
                data: dataDis,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }else if(dataCit != ""){
            $.ajax({
                url: "../php/insertCity.php",
                method: "POST",
                data: dataCit,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }else if(dataCliRem != ""){
            $.ajax({
                url: "../php/deleteClient.php",
                method: "POST",
                data: dataCliRem,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }else if(dataCliUp != ""){
            $.ajax({
                url: "../php/updateClient.php",
                method: "POST",
                data: dataCliUp,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }else if(dataDisUp != ""){
            $.ajax({
                url: "../php/updateDistrict.php",
                method: "POST",
                data: dataDisUp,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }
        else if(dataCitUp != ""){
            $.ajax({
                url: "../php/updateCity.php",
                method: "POST",
                data: dataCitUp,
                dataType: "json",
                success: function(result){
                    result["code"] == 0 ? errorData(result["message"]) : success(result["message"]);
                },
                error: function(e){
                    console.log(e.status);                    
                    if(e.status == 404){
                        errorSend();
                    }
                }
            });
        }

        return false;
    })
   
    var cliForm = $("form[name='clientForm']");
    cliForm.submit(function() {
        $(this).ajaxSubmit({
            url: "../php/insertClient.php",
            method: "POST",
            data: {acao: "Cadastro", envia: "true"},
            //clearForm: true,
            //resetForm: true,
            dataType: "json",
            success: function(result){
                //result['code'] == 1 ? success(result['message']) : errorData(result['message']);
                console.log(result);
            },
            error: function(e){
                console.log(e.status);                    
                if(e.status == 404){
                    errorSend();
                }
            }
        });
        return false;
    });
});