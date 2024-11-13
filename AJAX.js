function adicionarAoCarrinho(id_produto, prod_nome, prod_img, preco, quantidade) {

    const formData = new FormData();

    formData.append('id_produto', id_produto);

    formData.append('prod_nome', prod_nome);

    formData.append('prod_img', prod_img);

    formData.append('preco', preco);

    formData.append('quantidade', quantidade);


    fetch('adicionar_carrinho2.php', {

        method: 'POST',

        body: formData

    })
    
    .then(response => response.json())

    .then(data => {

        if (data.status === 'success') {

            alert("Produto adicionado ao carrinho com sucesso!");

        } else {

            alert("Erro ao adicionar ao carrinho.");

        }

    })

    .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
}