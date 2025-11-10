async function cadastrar() {
    const form = document.getElementById("form-cadastro");
    const form_data = new FormData(form);

    const resposta = await fetch("/TechDex/app/controllers/CadastroController.php", {
        method: "POST",
        body: form_data
    });

    const dados = await resposta.json();
    const campo_retorno = document.getElementById("campo_retorno");

    if (dados.status === "s") {
        campo_retorno.textContent = dados.mensagem;
        campo_retorno.style.color = "green";
        form.reset();
    } else {
        campo_retorno.textContent = dados.mensagem;
        campo_retorno.style.color = "red";
    }
}