function adicionarAoCarrinho(id_produto, prod_nome, prod_img, preco, quantidade) {

    const dados = new FormData();

    dados.append('id_produto', id_produto);

    dados.append('prod_nome', prod_nome);

    dados.append('prod_img', prod_img);

    dados.append('preco', preco);

    dados.append('quantidade', quantidade);


    fetch('adicionar_carrinho2.php', {

        method: 'POST',

        body: dados

    })
    .then(response => response.text())

    .then(html => {

        document.getElementById('cartItemsList').innerHTML = html;


        const totalElement = document.getElementById('orcamento');

        const total = parseFloat(totalElement.getAttribute('data-orcamento')) - (preco * quantidade);

        
        totalElement.setAttribute('data-orcamento', total);

        totalElement.innerHTML = 'Orçamento: R$ ' + total.toFixed(2).replace('.', ',');

        
        if (total < 0) {

            totalElement.style.color = 'red';

        } else {

            totalElement.style.color = 'black';

        }

    })

    .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
    
}
