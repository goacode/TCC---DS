document.getElementById('registro').addEventListener('submit', function (event) {

    var senha = document.getElementById('senha').value;

    var confSenha = document.getElementById('ConfSenha').value;

    if (senha !== confSenha) {

        alert('As senhas não coincidem. Por favor, verifique.');

        event.preventDefault();

    }
});


function togglePassword(inputId, iconElement) {

    var passwordInput = document.getElementById(inputId);

    var eyeIcon = iconElement.querySelector("img");

    if (passwordInput.type === "password") {

        passwordInput.type = "text";

        eyeIcon.src = "img/cego.png"
    } else {

        passwordInput.type = "password";
        
        eyeIcon.src = "img/olho.png"
    }
}





// Função para buscar o CEP
function buscarCep() 

{

    //Pega o cep
  const cep = document.getElementById('cep').value;

  //Transforma a mascara 00000-000 -> 00000000, Via Cep busca apenas nesse formato

  const cepSemMascara = cep.replace(/\D/g, '');



  if (cepSemMascara.length === 8) {

      fetch(`https://viacep.com.br/ws/${cepSemMascara}/json/`)

          .then(response => response.json())

          .then(data => {

              if (data.erro) {

                  document.getElementById('logradouro').value = '';
                  document.getElementById('bairro').value = '';
                  document.getElementById('localidade').value = '';
                  document.getElementById('UF').value = '';

              } else {

                  document.getElementById('logradouro').value = data.logradouro;
                  document.getElementById('bairro').value = data.bairro;
                  document.getElementById('localidade').value = data.localidade;
                  document.getElementById('UF').value = data.uf;
              }

          })

          .catch(error => {

              console.error(error);

              alert('Erro ao buscar CEP!');

          });

  } else {

      document.getElementById('logradouro').value = '';
      document.getElementById('bairro').value = '';
      document.getElementById('localidade').value = '';
      document.getElementById('UF').value = '';
  }

}

let debounceTimeout;

function debounceBuscarCep() {

  clearTimeout(debounceTimeout);

  debounceTimeout = setTimeout(buscarCep, 200); 
}

//input

document.getElementById('cep').addEventListener('input', debounceBuscarCep);
