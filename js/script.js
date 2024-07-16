// index.php

// Create.php

document.addEventListener('DOMContentLoaded', function(){

    var hoje = new Date();
    var dia = hoje.getUTCDate();
    var dia = (dia < 10) ? '0' + dia : dia;
    var mes = hoje.getUTCMonth() +1;
    var mes = (mes < 10) ? '0' + mes : mes;
    var ano = hoje.getFullYear();

    var data = ano + '-' + mes + '-' + dia;
    
    // console.log(data);

    document.getElementById('inputDate').value = data;
    
    //
    
    document.getElementById('valor').addEventListener('input', function(){
        var precoF = parseFloat(this.value).toFixed(2);
        this.value = precoF;
    });
})
