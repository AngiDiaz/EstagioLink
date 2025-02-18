document.addEventListener('DOMContentLoaded', function () {


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
  fetch('../PHP-CONFIG/fotoevent.php')
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
                    console.error('Elemento com ID "fotoUsuario" não encontrado.');
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

// Executa a função quando a página carregar
window.onload = atualizarFoto();

});