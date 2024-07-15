function validFullname(){
    var fname= document.getElementById('fname').value;
    var error_fullname= document.getElementById('error_fullname');

    if(fname.length==0){
        error_fullname.innerHTML="**Please Enter Fullname";
        return false;
    }
    error_fullname.innerHTML="";
        return true;
}

function validateAddress(){
    var address= document.getElementById('address').value;
    var error_address= document.getElementById('error_address');

    if(address.length==0){
        error_address.innerHTML="**Please Enter Address";
        return false;
    }
    error_address.innerHTML="";
        return true;
}


function validateContact(){
    var contact_number= document.getElementById('contact_number').value;
    var error_contact= document.getElementById('error_contact');

    if(contact_number.length==0){
        error_contact.innerHTML="**Please Enter Mobile Number";
        return false;
    }
    var vcn=/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    if(!contact_number.match(vcn)){
        error_contact.innerHTML="**Please Enter valid Mobile Number";
        return false;
    }
    error_contact.innerHTML="";
        return true;
}


function validEmail(){
    var email=document.getElementById('emai').value;
    var error_email= document.getElementById('error_email');

    if(email.length==0){
        error_email.innerHTML=" **Please Enter Email";
        return false;

    }
    var vemail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(!(email.match(vemail))){
        error_email.innerHTML="**Please Enter valid Email";
        return false;
    }
    error_email.innerHTML="";
    return true;

}


function validUserName(){
    var username=document.getElementById('uname').value;
    var err_uname= document.getElementById('error_userName');

    if(username.length==0){
        err_uname.innerHTML=" **Please Enter Username";
        return false;

    }
    err_uname.innerHTML="";
    return true;

}

function validPassword(){
    var password= document.getElementById('pass').value;
    var err_pass= document.getElementById('err_pass');

    if(password.length==0){
        err_pass.innerHTML=" **Please Enter Password";
        return false;

    }

    if(password.length<5){
        err_pass.innerHTML=" **Please Enter Valid Password(Need more than 5 charactors)";
        return false;

    }
    err_pass.innerHTML="";
    return true;

}

function validSubmit(){
    var err_sub=document.getElementById('err_sub');
    if(!validFullname()||!validateAddress()||!validateContact()||!validEmail()||!validUserName()||!validPassword){
        err_sub.style.display='block';
        err_sub.innerHTML="*Please Enter Valid Details";
        setTimeout(function(){err_sub.style.display='none';},3000);
        return false;
    }
    err_sub.innerHTML="";
    return true;
}