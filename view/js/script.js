function applyMask(){
    $('#inputCpf').mask('000.000.000-00', {reverse: true});
    $(".input-data").mask("99/99/9999");
    $('#inputCep').mask('00000-000');
    $('#inputTelefone').mask('(00) 0000-0000');
    $('#inputCelular').mask('(00) 0 0000-0000');
    $('.input-dinheiro').mask('000.000.000.000.000,00', {reverse: true});
} 