let select = document.getElementById("Produnidade");

let input = document.getElementById("Prodvalpeso");

let inputQuant = document.getElementById("Prodquantidade");


select.addEventListener("change", changeDOC);

function changeDOC() {

    switch (this.value) {

        case "kg":

            input.placeholder = "Peso pelo valor (Kg)";

            inputQuant.placeholder = "Quantidade Disponível (Kg)";

            break;

        case "g":

            input.placeholder = "Peso pelo valor (g)";

            inputQuant.placeholder = "Quantidade Disponível (g)";

            break;

        case "unidade":

            input.placeholder = "Peso pelo valor (Unidade)";

            inputQuant.placeholder = "Quantidade Disponível (Unidade)";

            break;

        default:

            input.placeholder = "Peso pelo valor (Kg)"; 

            inputQuant.placeholder = "Quantidade Disponível (Kg)";

    }
}

changeDOC();
