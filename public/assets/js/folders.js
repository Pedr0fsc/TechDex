window.onload = async function () {
    if (document.getElementById("lista")) {
        // Busca lista de itens
        var resposta = await fetch("/TechDex/app/controllers/ItemController.php");
        var dados = await resposta.json();

        var html = '';
        for (var i = 0; i < dados.length; i++) {
            html += `
                <div class="itens">
                    <p>${dados[i].linguagem}</p>
                    <button class="salvar">Salvar</button>
                    <p>${dados[i].empresa || 'N/A'}</p>
                    <p>${dados[i].tag || 'Sem tag'}</p>
                </div>
            `;
        }
        document.getElementById("lista").innerHTML = html;

    } else {
        // Busca lista de tags
        var resposta1 = await fetch("/TechDex/app/controllers/TagController.php");
        var dados1 = await resposta1.json();

        var htmlPastas = '';
        for (var j = 0; j < dados1.length; j++) {
            htmlPastas += `
                <div class="itens">
                    <i class="fa-solid fa-folder" style="color: #FFD43B;"></i>
                    <p>${dados1[j].tag}</p>
                    <p>${dados1[j].quantidade}</p>
                </div>
            `;
        }
        document.getElementById("list").innerHTML = htmlPastas;
    }
};
