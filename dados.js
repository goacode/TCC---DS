function mostrarformulario(formId) {

    document.getElementById('formulario1').style.display = 'none';
    document.getElementById('formulario2').style.display = 'none';
    document.getElementById('formulario3').style.display = 'none';

    document.getElementById(formId).style.display = 'block';
}


