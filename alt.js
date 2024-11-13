document.getElementById('btnAlterar').addEventListener('click', function() {

    document.getElementById('nomeusuario').removeAttribute('readonly');

    document.getElementById('emailusuario').removeAttribute('readonly');

    document.getElementById('cpf_cnpj').removeAttribute('readonly');

    document.getElementById('datanasc').removeAttribute('readonly');


    document.getElementById('btnSalvar').style.display = 'inline-block';

    this.style.display = 'none';

});



 const displayTime = 3000; 

 setTimeout(() => {

     const messageElement = document.getElementById('Msg');

     if (messageElement) {

         messageElement.style.display = 'none'; 

     }

 }, displayTime);
 