async function cadastrar(){

    var form = document.getElementById("form-cadastro");
    var form_data = new FormData(form);

    var retorno = await fetch("/TechDex/app/controllers/CadastroController.php", {
        method: "POST",
        body: form_data
    });

    var data_retorno = await retorno.json();

    var campo_retorno = document.getElementById("campo_retorno");

    if (dados.status === "Entrou") {
        window.location.href = "../principal/index.html";
    } else {
        campo_retorno.textContent = dados.mensagem;
    }
}