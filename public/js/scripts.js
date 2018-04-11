function limpa_formulario_cep()
{
    // Limpa valores do formul�rio de cep.
    $("#endereco").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

//Quando o campo cep perde o foco.
$("#cep").blur(function() 
{
    //Nova vari�vel "cep" somente com d�gitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") 
    {
        //Express�o regular para validar o CEP.
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
                    //CEP pesquisado n�o foi encontrado.
                    limpa_formulario_cep();
                    alert("CEP n�o encontrado.");
                }
            });
        }
        else 
        {
            //cep � inv�lido.
            limpa_formulario_cep();
            alert("Formato de CEP inv�lido.");
        }
    }
    else 
    {
        //cep sem valor, limpa formul�rio.
        limpa_formulario_cep();
    }
});