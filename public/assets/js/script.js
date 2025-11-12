// key secreta — precisa ser a MESMA do PHP
const key = CryptoJS.enc.Utf8.parse("chave-super-secreta-32bytes"); 
const IV = CryptoJS.enc.Utf8.parse("1234567890123456"); // 16 bytes

function criptografar(texto) {
  const encrypted = CryptoJS.AES.encrypt(texto, key, {
    iv: IV,
    mode: CryptoJS.mode.CBC,
    padding: CryptoJS.pad.Pkcs7
  });
  // ciphertext puro em base64 (compatível com PHP)
  return encrypted.ciphertext.toString(CryptoJS.enc.Base64);
}

// CADASTRO
async function cadastrar() {
    const form = document.getElementById("form-cadastro");
    const form_data = new FormData(form);

    // Criptografa todos os campos antes de enviar
    form_data.set("nome", criptografar(form_data.get("nome")));
    form_data.set("username", criptografar(form_data.get("username")));
    form_data.set("email", criptografar(form_data.get("email")));
    form_data.set("senha", criptografar(form_data.get("senha")));

    const resposta = await fetch("/TechDex/app/controllers/CadastroController.php", {
        method: "POST",
        body: form_data
    });

    const dados = await resposta.json();
    const campo_retorno = document.getElementById("cadastro_retorno");

    if (dados.status === "s") {
        window.location.href = "/TechDex/app/views/login.php";
    } else {
        campo_retorno.textContent = dados.mensagem;
        campo_retorno.style.color = "red";
        form.reset();
    }
}
// LOGIN
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
        form.reset();
    }
}