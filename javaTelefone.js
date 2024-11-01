
document.getElementById('teltipo').addEventListener('change', function() {

    const teleinput = document.getElementById('teleinput');

    const value = this.value;

    if (value === 'Celular') {

        teleinput.innerHTML = '<input type="text" class="form-control" name="telefone" id="telefonecel" placeholder="Telefone Celular" required>';

    } else {

        teleinput.innerHTML = '<input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone Fixo" required >';
    };  

    setTimeout(() => {

        if ( value === 'Celular') {

            $('#telefonecel').mask('(00)00000-0000');

        } else {

            $('#telefone').mask(' (00)0000-0000');
           
        }

    }, 0);

});
