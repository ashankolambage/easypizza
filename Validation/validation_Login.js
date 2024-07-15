
function validateName(){
    var username= document.getElementById('userName').value;
    var error_name= document.getElementById('error_name');

    if(username.length==0){
        error_name.innerHTML="*Please Enter User Name";
        return false;
    }

    if(!username.match(/^[a-zA-Z\s]*$/)){
        error_name.innerHTML="*Please Enter Valid Data";
        return false;
    }
    error_name.innerHTML="";
    return true;

}

function validatePass(){
    var password= document.getElementById('password').value;
    var error_pass= document.getElementById('error_pass');

    if(password.length==0){
        error_pass.innerHTML="*Please Enter Password";
        return false;
    }
    //*
    if(password.length<3||password.length>15){
        error_pass.innerHTML="*Please Enter Valid Password(Password length-5)";
        return false;
    }


    error_pass.innerHTML="";
    return true;

}

function validateForm(){
var form_err= document.getElementById('form_err');
    if(!validateName()|| !validatePass()){
        form_err.style.display='block';
        form_err.innerHTML="*Please Enter Valid Details";
        setTimeout(function(){form_err.style.display='none';},3000);
        return false;
    }

    form_err.innerHTML="";
    return true;
}
