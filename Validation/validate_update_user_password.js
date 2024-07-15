function validcurpass(){
    var curpassword= document.getElementById('curpass').value;
var error_curPassword=document.getElementById('error_curPassword');

if(curpassword.length==0){
    error_curPassword.innerHTML="*please Enter Current Password";
    return false;
}

if(curpassword.length<2 || curpassword.length>15 ){
    error_curPassword.innerHTML="*please Enter Valid Password";
    return false;
}

error_curPassword.innerHTML="";
    return true;
}




function validateNpass(){
    
var npassword= document.getElementById('npassword').value;
var error_nPassword=document.getElementById('error_nPassword');

if(npassword.length==0){
    error_nPassword.innerHTML="*please Enter New Password";
    return false;
}

if(npassword.length<5 || npassword.length>15 ){
    error_nPassword.innerHTML="*please Enter Valid Password";
    return false;
}

error_nPassword.innerHTML="";
    return true;

}

function validCpass(){
    var npassword= document.getElementById('npassword').value;
    var cpassword= document.getElementById('cpassword').value;
    var error_cPassword=document.getElementById('error_cPassword');

    if(npassword!=cpassword){
        error_cPassword.innerHTML="*Password is Not Match";
        return false;
    }
    error_cPassword.innerHTML="";
    return true;

}

function validUpdatePassSubmit(){
    
    if(!validcurpass()||!validateNpass() || !validCpass()){
        
        var error=document.getElementById('form_error');
        error.style.display='block';
        error.innerHTML="*Please Enter All Details";
        setTimeout(function(){error.style.display='none';},3000);
        return false;
    }
    document.getElementById('form_error').innerHTML="";
    return true;
}