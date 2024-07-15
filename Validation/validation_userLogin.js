function validUserName(){
    var username=document.getElementById('uname').value;
    var err_uname= document.getElementById('err_uname');

    if(username.length==0){
        err_uname.innerHTML=" *Please Enter Username";
        return false;

    }
    err_uname.innerHTML="";
    return true;

}

function validPassword(){
    var password= document.getElementById('pass').value;
    var err_pass= document.getElementById('err_pass');

    if(password.length==0){
        err_pass.innerHTML=" *Please Enter Password";
        return false;

    }

    if(password.length<5){
        err_pass.innerHTML=" *Please Enter Valid Password(Need more than 5 charactors)";
        return false;

    }
    err_pass.innerHTML="";
    return true;

}

function validSubmit(){
    var err_sub=document.getElementById('err_sub');
    if(!validUserName()||!validPassword()){
        err_sub.style.display='block';
        err_sub.innerHTML="*Please Enter Valid Details";
        setTimeout(function(){err_sub.style.display='none';},3000);
        return false;
    }
    err_sub.innerHTML="";
    return true;
}

