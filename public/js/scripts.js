function limpa_formulario_cep()
{
    // Limpa valores do formulário de cep.
    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() 
{
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") 
    {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) 
        {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#endereco").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) 
            {
                if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#endereco").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#uf").val(dados.uf);

                } //end if.
                else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulario_cep();
                    alert("CEP não encontrado.");
                }
            });
        }
        else 
        {
            //cep é inválido.
            limpa_formulario_cep();
            alert("Formato de CEP inválido.");
        }
    }
    else 
    {
        //cep sem valor, limpa formulário.
        limpa_formulario_cep();
    }
});

$("#idForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
        });
});

function confirmaExclusao() {
    $('table tr td a.btn_destroy_in_table').off().on('click', function (e) {
        var route_destroy = $(this).attr('route');            
        var message = $(this).attr('message');
        // clear message modal
        $('#confirm-destroy div.modal-body').html('');
        //var form = $(this).closest('form');
        e.preventDefault();
        jQuery.noConflict();
                    
        if (typeof route_destroy === typeof undefined || route_destroy === false) {
            alert('Não há rota definida'); 
            return false;
        }
        // id do modal confirm
        $('#confirm-destroy div.modal-body').html(message);            
        $('#confirm-destroy').modal({backdrop: 'static', keyboard: false})
            .on('click', '#delete', function (e) {   
                var form = $('<form>', {action: route_destroy, method: 'put'});
                //$('<input>').attr({type: "hidden", name: '_token', value: '{{ csrf_token() }}'}).appendTo(form);
                //$('<input>').attr({type: "hidden", name: '_token', value: '{{ csrf_field() }}'}).appendTo(form);
                $('.modal-waiting-system').modal({backdrop: 'static', keyboard: false});
                form.appendTo('body').submit();                            
            });
    });
}

$("document").ready(function() {
    if (document.getElementById('alerta_sucesso') ) {
        setTimeout(function() {
            document.getElementById('alerta_sucesso').remove();
        }, 5000 ); // 5 secs
    }
    confirmaExclusao();
});