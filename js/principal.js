$(document).ready(function(){
    var result = $(".result");

    function success(message) {
        result.html("<p class='success'>"+ message + "</p>").fadeIn("fast").delay(2000).hide(1000);
    }
    function errorSend() {
        result.html("<p class='error'><strong>Erro: Por favor, entre em contanto com o suporte</strong></p>").fadeIn("fast").delay(2000).hide(1000);
    }
    function errorData(message) {
        result.html("<p class='error'>"+ message + "</p>").fadeIn("fast").delay(2000).hide(1000);
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
            clearForm: false,
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
        var dataMod = $(".moduleForm").serialize();
        var dataEmpUp = $(".employeeFormUp").serialize();
        var dataCliUp = $(".clientFormUp").serialize();
        var dataDisUp = $(".districtFormUp").serialize();
        var dataCitUp = $(".cityFormUp").serialize();
        var dataModUp = $(".moduleFormUp").serialize();
        
        if(dataDis != ""){
            signupGeneric("insertDistrict", dataDis);
        }else if(dataCit != ""){
            signupGeneric("insertCity", dataCit);
        }else if(dataMod != ""){
            signupGeneric("insertModule", dataMod);
        }else if(dataEmpUp != ""){
            signupGeneric("updateEmployee", dataEmpUp);
        }else if(dataCliUp != ""){
            signupGeneric("updateClient", dataCliUp);
        }else if(dataDisUp != ""){
            signupGeneric("updateDistrict", dataDisUp);        
        }else if(dataCitUp != ""){
            signupGeneric("updateCity", dataCitUp);
        }else if(dataModUp != ""){
            signupGeneric("updateModule", dataModUp);
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

    var addModule = $(".addModule");
    var limit = -2;
    var j=2;
    addModule.click(function(){     
        $.ajax({
            url: "../php/control.php",
            method: "POST",
            data: "module=&action=readModule",
            dataType: "json",
            success: function(result){                                         
                if(limit == -2){
                    limit = result.length;
                }
                if(limit > 1){
                    $("#modules").append(
                        '<div class="module'+j+'">'+
                        '<select name="module'+j+'" class="moduleOptions'+j+'">'+                                         
                        '</selet>'+
                        '</div>'
                    );
                    $(".moduleOptions").empty();
                    for (let i = 0; i < result.length; i++) {                        
                        $(".moduleOptions"+j).append(
                            '<option value="'+result[i]["ModuloID"]+'">'+result[i]["ModuloNome"]+'</option>'
                        );
                    }
                    limit--;
                    j++;
                }          
            },
            error: function(e){
                console.log(e.status);                    
                if(e.status == 404){
                    errorSend();
                }
            }
        });
    });

    var remModule = $(".remModule");
    remModule.click(function(){
        j--;
        limit++;
        console.log(".module"+j);
        $(".module"+j).empty();
    });

});