function validateNpass(){
    //window.alert("xxxx");
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
    
    if(!validateNpass() || !validCpass()){
        
        var error=document.getElementById('form_error');
        error.style.display='block';
        error.innerHTML="*Please Enter All Details";
        setTimeout(function(){error.style.display='none';},3000);
        return false;
    }
    document.getElementById('form_error').innerHTML="";
    return true;
}