function validName(){

    var fullname= document.getElementById('fname').value;
    var error_fullName=document.getElementById('error_fname');

    if(fullname.length==0){
      error_fullName.innerHTML="Pleae enter Full Name";
      return false;
      }
    
    if(!fullname.match(/^[a-zA-Z\s]*$/)){
        error_fullName.innerHTML="*Please Enter Correct Full Name";
        return false;
      }
      error_fullName.innerHTML="";
      return true;
    }

    //validate username start------------------------
    function validusern(){
        var username=document.getElementById("uname").value;
        var error_userName=document.getElementById('error_uname');

        if(username.length==0){
            error_userName.innerHTML="*Please Enter Username";
            return false;
        }

        if(!username.match(/^[A-Za-z]+$/)){
            error_userName.innerHTML="*Please enter correct username(*No space)";
          return false;
        }
        error_userName.innerHTML="";
        return true;
    }
     //validate username stoped------------------------

function validForm(){
    if(!validName()||!validusern()){
        var error=document.getElementById('showallerror');
        error.style.display='block';
        error.innerHTML="Please Correct All Details";
        setTimeout(function(){error.style.display='none';},3000);
        return false;
    }
    return true;
    error.innerHTML="";
}