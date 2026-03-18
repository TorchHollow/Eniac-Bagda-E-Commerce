document.addEventListener('DOMContentLoaded', () => {
    // Seleciona todos os inputs de arquivo que tiverem a classe 'file-input'
    const fileInputs = document.querySelectorAll('.file-input');

    // Para cada input encontrado, adiciona o evento de escuta
    fileInputs.forEach(input => {
        input.addEventListener('change', (event) => {
            // Pega o elemento <span> que está logo após o input
            const fileNameSpan = input.nextElementSibling;
            
            // Verifica se um arquivo foi realmente selecionado
            if (input.files.length > 0) {
                // Se sim, exibe o nome do arquivo no <span>
                fileNameSpan.textContent = input.files[0].name;
            } else {
                // Se o usuário cancelar, limpa o texto
                fileNameSpan.textContent = '';
            }
        });
    });
});