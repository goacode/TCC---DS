function openCart() {
    document.getElementById("menudocarro").style.display = "block";
}

function closeCart() {
    document.getElementById("menudocarro").style.display = "none";
}


function showInfo(section) {

    const aboutContent = document.getElementById("aboutContent");


    let content = "";

    switch (section) {

        case 'missao':

            content = "<h4>Missão</h4><p>Fornecer produtos de alta qualidade relacionados a churrasco, ajudando nossos clientes a organizar eventos com praticidade.</p> ";
            break;

        case 'visao':

            content = "<h4>Visão</h4><p>Ser uma nova referência em produtos e serviços de churrasco, inovando e adaptando-se às necessidades dos nossos clientes com a montagem de kits de churrasco.</p>";
            break;
        case 'valores':

            content = "<h4>Valores</h4><p>Qualidade, compromisso com o cliente, inovação, praticidade, transparência.</p>";
            break;
    }

    aboutContent.innerHTML = content;
    
    aboutContent.classList.add("fadeIn");
}