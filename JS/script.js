// Seleciona os elementos do formulário
const layoutOptions = document.querySelectorAll('input[name="layout"]');
const nextButton = document.getElementById('nextButton');

// Habilita o botão somente se um layout for selecionado
layoutOptions.forEach(option => {
  option.addEventListener('change', () => {
    nextButton.disabled = false;
  });
});

// Adiciona a ação ao clicar no botão
nextButton.addEventListener('click', () => {
  const selectedLayout = document.querySelector('input[name="layout"]:checked');
  if (selectedLayout) {
    // Redireciona para a próxima página
    window.location.href = `../../paginas-pesquisa/aluno.html?layout=${selectedLayout.value}`;
  }
});

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