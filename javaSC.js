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
function buscarCep() {

    const cep = document.getElementById('cep').value;

    const cepSemMascara = cep.replace(/\D/g, '');


    const fields = ['logradouro', 'bairro', 'localidade', 'UF'];

    if (cepSemMascara.length === 8) {

        fetch(`https://viacep.com.br/ws/${cepSemMascara}/json/`)

            .then(response => response.json())

            .then(data => {

                if (data.erro) {

                    fields.forEach(id => document.getElementById(id).value = '');

                    document.getElementById('UF').value = '';

                } else {

                    document.getElementById('logradouro').value = data.logradouro;

                    document.getElementById('bairro').value = data.bairro;

                    document.getElementById('localidade').value = data.localidade;

                    document.getElementById('UF').value = data.uf;

                }

                // Remove disabled 

                fields.forEach(id => document.getElementById(id).removeAttribute('disabled'));

            })

            .catch(error => {

                console.error(error);

                alert('Erro ao buscar CEP!');

            });

    } else {

        fields.forEach(id => document.getElementById(id).value = '');

        document.getElementById('UF').value = '';

        fields.forEach(id => document.getElementById(id).setAttribute('disabled', 'true'));
    }

}

let debounceTimeout;

function debounceBuscarCep() {

    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(buscarCep, 200);   
    
}

document.getElementById('cep').addEventListener('input', debounceBuscarCep);

//CPF E CNPJ

document.getElementById('pessoa').addEventListener('change', function() {

    const inputContainer = document.getElementById('inputContainer');

    const selectedValue = this.value;



    if (selectedValue === 'Jurídica') {

        inputContainer.innerHTML = '<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" required>';

    } else {

        inputContainer.innerHTML = '<input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" required>';
    }

    setTimeout(() => {

        if (selectedValue === 'Jurídica') {

            $('#cnpj').mask('00.000.000/0000-00');

        } else {

            $('#cpf').mask('000.000.000-00');

        }

    }, 0);

});