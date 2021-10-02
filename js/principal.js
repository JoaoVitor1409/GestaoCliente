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

    function signupGeneric(action, data){
        $.ajax({
            url: "../php/control.php",
            method: "POST",
            data: data + "&action="+action,
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


    var btn = $(".btnSubmit");
    btn.click(function(){
        var dataDis = $(".districtForm").serialize();
        var dataCit = $(".cityForm").serialize();
        var dataCliRem = $(".clientFormDel").serialize();
        var dataCliUp = $(".clientFormUp").serialize();
        var dataDisUp = $(".districtFormUp").serialize();
        var dataCitUp = $(".cityFormUp").serialize();
        
        if(dataDis != ""){
            signupGeneric("insertDistrict", dataDis);

        }else if(dataCit != ""){
            signupGeneric("insertCity", dataCit);

        }else if(dataCliRem != ""){
            signupGeneric("deleteClient", dataCliRem);

        }else if(dataCliUp != ""){
            signupGeneric("updateClient", dataCliUp);
        }else if(dataDisUp != ""){
            signupGeneric("updateDistrict", dataDisUp);
        }
        else if(dataCitUp != ""){
            signupGeneric("updateCity", dataCitUp);
        }

        return false;
    })
   
    var cliForm = $("form[name='clientForm']");
    cliForm.submit(function() {
        $(this).ajaxSubmit({
            url: "../php/control.php",
            method: "POST",
            clearForm: true,
            data: {action: 'insertClient'},
            //resetForm: true,
            dataType: "json", //desculpa kkkk 
            success: function(result){
                console.log(result);
                result["code"] == "0" ? errorData(result["message"]) : success(result["message"]);
                //console.log(result);
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