//validate name start------------------------------
function validName(){

    var fullname= document.getElementById('fname').value;
    var error_fullName=document.getElementById('error-fullname');

    if(fullname.length==0){
      error_fullName.innerHTML="Pleae enter full Name";
      return false;
      }
    
    if(!fullname.match(/^[a-zA-Z\s]*$/)){
        error_fullName.innerHTML="*Please Enter Correct Full Name";
        return false;
      }
      error_fullName.innerHTML="";
      return true;
    }
    //validate name stopped---------------------------
    //validate username start------------------------
    function Validusern(){
        var username=document.getElementById("username").value;
        var error_userName=document.getElementById('error-username');

        if(username.length==0){
            error_userName.innerHTML="*Please Enter Username";
            return false;
        }

        if(!username.match(/^\S*$/)){
            error_userName.innerHTML="*Please enter correct username(*No space)";
          return false;
        }
        error_userName.innerHTML="";
        return true;
    }
     //validate username stoped------------------------

    function validPass(){
     
      var pass=document.getElementById("pass").value;
      var error_password=document.getElementById('error-pass');
      if(pass.length==0){
        error_password.innerHTML="Please Enter Password";
        return false;
      }

      if(pass.length<5|| pass.length>20){
        error_password.innerHTML="*Pleae enter valid Password(password must be 5 charactor)";
        return false;
      }
      error_password.innerHTML="";
        return true;
    }

    

    function validForm(){
      
      if(!validName() || !Validusern() || !validPass()){

        var error=document.getElementById('showallerror');
        error.style.display='block';
        error.innerHTML="Please Correct All Details";
        setTimeout(function(){error.style.display='none';},3000);
        return false;
        
      }
      error.innerHTML="";
      return true;
  }
      