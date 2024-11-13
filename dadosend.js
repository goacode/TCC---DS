function exibirFormularioEndereco() {
    
    document.getElementById('formularioNovoEndereco').style.display = 'block';
}

function deletarEndereco() {

    const select = document.getElementById('enderecosSelect');

    const enderecoId = select.value;

    if (enderecoId) {

        if (confirm('Tem certeza que deseja deletar este endereço?')) {

            window.location.href = `deletarendereco.php?id=${enderecoId}`;

        }

    } else {

        alert('Selecione um endereço para deletar.');

    }

}







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





function exibirFormularioTelefone() {
    
    document.getElementById('formularioNovoTelefone').style.display = 'block';
};







function deletarTelefone() {

    const select = document.getElementById('telefoneSelect');

    const telefoneId = select.value;

    if (telefoneId) {

        if (confirm('Tem certeza que deseja deletar este telefone?')) {

            window.location.href = `deletartelefone.php?id=${telefoneId}`;

        }

    } else {

        alert('Selecione um telefone para deletar.');

    }

}