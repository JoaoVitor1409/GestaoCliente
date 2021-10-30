$(document).ready(function(){
    var result = $(".result");

    function success(message) {
        result.html("<p class='success'>"+ message + "</p>").fadeIn("fast").delay(2000);
    }
    function errorSend() {
        result.html("<p class='error'><strong>Erro: Por favor, entre em contanto com o suporte</strong></p>").fadeIn("fast").delay(2000);
    }
    function errorData(message) {
        result.html("<p class='error'>"+ message + "</p>").fadeIn("fast").delay(2000);
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

    var bar = $('.loading');
    var pro = $('.progress');

    bar.css("display", "none");

    function signupGenericForm(form, action){
        $(form).ajaxSubmit({
            url: "../php/control.php",
            method: "POST",
            //clearForm: true,
            data: {action: action},
            dataType: "json",
            uploadProgress: function(event, position, total, totalpercentage) {
                bar.fadeIn("fast");
                var percentage = totalpercentage + "%";
                pro.width(percentage).text(percentage);
            },            
            success: function(result){
                result["code"] == "0" ? errorData(result["message"]) : success(result["message"]);
            },
            error: function(e){
                console.log(e.status);                    
                if(e.status == 404){
                    errorSend();
                }
            },
            complete: function() {
                window.setTimeout(function() {
                    bar.fadeOut("slow", function() {
                        pro.width('0%').text("0%");
                    })
                })
            }
        });
    }



    $("input[type=text],input[type=password]").click(function(){
        result.css("display", "none");
    });
    var m=0;
    var f=0;
    var o=0;
    $("#male").css("background-color", "#FFF");
    $("#male").css("color", "#000");
    $("#male").click(function(){        
        if(m==0){
            $("#male").css("background-color", "#FFF");
            $("#male").css("color", "#000");
            $("#female").css("background-color", "#34638a");
            $("#female").css("color", "#FFF");
            $("#other").css("background-color", "#34638a");
            $("#other").css("color", "#FFF");
            f=0;
            o=0;
            m++;
        }
    })

    $("#female").click(function(){
        if(f==0){
            $("#female").css("background-color", "#FFF");
            $("#female").css("color", "#000");
            $("#male").css("background-color", "#34638a");
            $("#male").css("color", "#FFF");
            $("#other").css("background-color", "#34638a");
            $("#other").css("color", "#FFF");
            m=0;
            o=0;
            f++;
        }
    })

    $("#other").click(function(){
        if(o==0){
            $("#other").css("background-color", "#FFF");
            $("#other").css("color", "#000");
            $("#female").css("background-color", "#34638a");
            $("#female").css("color", "#FFF");
            $("#male").css("background-color", "#34638a");
            $("#male").css("color", "#FFF");
            m=0;
            f=0;
            o++;
        }
    })



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
        $.scrollTo("body", 500);
        return false;
    });

    var empForm = $("form[name='employeeForm']");
    empForm.submit(function(){
        signupGenericForm(empForm, "insertEmployee");
        $.scrollTo("body", 500);
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
        $(".module"+j).empty();
    });



    var cpf = $("#cpf");
    cpf.mask('000.000.000-00');

});