$(document).ready(function(){
    var result = $(".result");

    function success(message) {
        result.html("<p class='success'>"+ message + "</p>").fadeIn("fast");
    }
    function errorSend() {
        result.html("<p class='error'><strong>Erro: Por favor, entre em contanto com o suporte</strong></p>").fadeIn("fast");
    }
    function errorData(message) {
        result.html("<p class='error'>"+ message + "</p>").fadeIn("fast");
    }

    function signupGeneric(action, data){
        $.ajax({
            url: "../php/control.php",
            method: "POST",
            data: data + "&action="+action,
            dataType: "json",
            success: function(result){
                result['code'] != 0 ? success(result['message']) : errorData(result['message']);
            },
            error: function(e){
                console.log(e.status);                    
                if(e.status == 404){
                    errorSend();
                }
            }
        });
    }

    function signupGenericForm(form, action){
        $(form).ajaxSubmit({
            url: "../php/control.php",
            method: "POST",
            clearForm: true,
            data: {action: action},
            dataType: "json",
            success: function(result){
                result["code"] == "0" ? errorData(result["message"]) : success(result["message"]);
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
        var dataLogin = $(".loginForm").serialize();
        var dataDis = $(".districtForm").serialize();
        var dataCit = $(".cityForm").serialize();
        var dataEmpUp = $(".employeeFormUp").serialize();
        var dataCliUp = $(".clientFormUp").serialize();
        var dataDisUp = $(".districtFormUp").serialize();
        var dataCitUp = $(".cityFormUp").serialize();
        
        if(dataDis != ""){
            signupGeneric("insertDistrict", dataDis);
        }else if(dataCit != ""){
            signupGeneric("insertCity", dataCit);
        }else if(dataEmpUp != ""){
            signupGeneric("updateEmployee", dataEmpUp);
        }else if(dataCliUp != ""){
            signupGeneric("updateClient", dataCliUp);
        }else if(dataDisUp != ""){
            signupGeneric("updateDistrict", dataDisUp);        }
        else if(dataCitUp != ""){
            signupGeneric("updateCity", dataCitUp);
        }else if(dataLogin != ""){
            $.ajax({
                url: "../php/control.php",
                method: "POST",
                data: dataLogin + "&action=login",
                dataType: "json",
                success: function(result){
                    if(result['code']==1){
                        window.location.href = '../index.php';
                    }
                    result['code'] != 0 ? success(result['message']) : errorData(result['message']);
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
        signupGenericForm(cliForm, "insertClient");
        return false;
    });

    var empForm = $("form[name='employeeForm']");
    empForm.submit(function(){
        signupGenericForm(empForm, "insertEmployee");
        return false;
    });

});