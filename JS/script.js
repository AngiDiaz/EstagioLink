


function previewFoto(event){
  var reader = new FileReader();
  var output = document.getElementById('foto');
  if(event.target.files && event.target.files[0]){
  reader.onload = function(){
    
    output.src = reader.result;
    output.style.display = 'flex';
  }
  reader.readAsDataURL(event.target.files[0]);

  } else{
    output.style.display = 'none';
  }

}

function atualizarFoto() {
  // Faz uma requisição ao PHP
  fetch('http://localhost/EstagioLink/PHP-CONFIG/perfilevent.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição');
                }
                return response.text(); // Recebe os dados como texto
            })
            .then(dados => {
                console.log("Dados recebidos:", dados); // Depuração

                // Divide a string usando o delimitador "|"
                const [caminhoFoto, nomeUsuario] = dados.split('|');

                // Atualiza o src da imagem no HTML
                const fotoUsuario = document.getElementById('fotoUsuario');
                if (fotoUsuario) {
                    fotoUsuario.src = caminhoFoto;
                } else {
                    fotoUsuario.src = caminhoFoto;
                }

                // Atualiza o conteúdo do span com o nome do usuário
                const spanNomeUsuario = document.getElementById('nomeUsuario');
                if (spanNomeUsuario) {
                    spanNomeUsuario.textContent = `Bem-vindo, ${nomeUsuario}`;
                } else {
                    console.error('Elemento com ID "nomeUsuario" não encontrado.');
                }
            })
            .catch(error => console.error('Erro ao buscar os dados:', error));
    }
    function salvarDados(formId) {
        const form = document.getElementById(formId);
        if (!form) return; // Se o formulário não existir, sai da função
    
        const inputs = form.querySelectorAll('input, textarea, select');
        
        let dados = {};
        inputs.forEach(input => {
            dados[input.name] = input.value;
        });
    
        localStorage.setItem(formId, JSON.stringify(dados));
    }
    function gerarPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF("p", "mm", "a4");
        doc.html(document.getElementById("curriculo"), {
            callback: function (doc) {
                doc.save("Curriculo_Estagiario.pdf");
                const pdfBase64 = doc.output('datauristring').split(',')[1];
                enviarPDFparaPHP(pdfBase64);
            },
            x: 3,
            y: 0,
            width: 190,
            windowWidth: document.getElementById("curriculo").scrollWidth
        });
        function enviarPDFparaPHP(pdfBase64) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/EstagioLink/PHP-CONFIG/salvarpdf.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // Resposta do servidor
                }
            };

            const dados = "pdf=" + encodeURIComponent(pdfBase64);
            xhr.send(dados);
        }
    }
    function carregarCurriculo() {
        const secoes = ['dados-pessoais', 'dados-curriculares', 'experiencia', 'documentos-adicionais', 'layout-form'];

        secoes.forEach(secao => {
            const dados = JSON.parse(localStorage.getItem(secao));

            if (dados) {
                Object.keys(dados).forEach(chave => {
                    const campo = document.getElementById(chave);
                    if (campo) {
                        campo.innerText = dados[chave] ? dados[chave] : "Não informado";
                    }
                });
            }
        });
    }

    window.onload = carregarCurriculo;

// Executa a função quando a página carregar
window.onload = atualizarFoto;