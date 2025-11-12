const AES_KEY = "12345678901234567890123456789012";

function encryptAES(plainText) {
  const key = CryptoJS.enc.Utf8.parse(AES_KEY);
  const iv = CryptoJS.lib.WordArray.random(16);
  const encrypted = CryptoJS.AES.encrypt(plainText, key, {
    iv: iv,
    mode: CryptoJS.mode.CBC,
    padding: CryptoJS.pad.Pkcs7
  });

  const combined = iv.clone().concat(encrypted.ciphertext);
  const base64 = CryptoJS.enc.Base64.stringify(combined);

  return base64.replace(/\s+/g, '');
}


async function cadastrar() {
    const form = document.getElementById("form-cadastro");
    const form_data = new FormData(form);

    const nome = encryptAES(form_data.get("nome"));
    const username = encryptAES(form_data.get("username"));
    const email = encryptAES(form_data.get("email"));
    const senha = encryptAES(form_data.get("senha"));

    form_data.set("nome", nome);
    form_data.set("username", username);
    form_data.set("email", email);
    form_data.set("senha", senha);

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
        form.reset();
    }
}
// LOGIN
async function entrar() {

    console.log("Função entrar() chamada!");
    var form = document.getElementById("form-login");
    var form_data = new FormData(form);

    var username = encryptAES(form_data.get("username"));
    var senha = encryptAES(form_data.get("senha"));

    form_data.set("username", username);
    form_data.set("senha", senha);

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