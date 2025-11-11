async function cadastrar() {
    const form = document.getElementById("form-cadastro");
    const form_data = new FormData(form);

    const resposta = await fetch("/TechDex/app/controllers/CadastroController.php", {
        method: "POST",
        body: form_data
    });

    const dados = await resposta.json();
    const campo_retorno = document.getElementById("cadastro_retorno");

    if (dados.status === "s") {
        campo_retorno.textContent = dados.mensagem;
        campo_retorno.style.color = "green";
        form.reset();
    } else {
        campo_retorno.textContent = dados.mensagem;
        campo_retorno.style.color = "red";
    }
}

async function entrar() {

    var form = document.getElementById("form-login");
    var form_data = new FormData(form);

    var retorno = await fetch("/TechDex/app/controllers/LoginController.php", {
        method: "POST",
        body: form_data
    });

    var dados = await retorno.json();

    var campo_retorno = document.getElementById("login_retorno");

    if (dados.status === "s") {
        window.location.href = "/TechDex/app/views/home.php";
    } else {
        campo_retorno.textContent = dados.mensagem;
    }
}