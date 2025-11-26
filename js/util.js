function validarPasswords(){
  var pass = document.getElementById("password").value;
  var repass = document.getElementById("password2").value;

    if (pass!=repass) 
    {        alert("Las Contraseñas no Coinciden");
    }    else
    {
        document.getElementById("frm").submit();
    }
}

