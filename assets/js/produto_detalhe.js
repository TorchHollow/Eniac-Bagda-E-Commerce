function swapImage(el) {
    // Corrige o ID de 'main-image' para 'img-principal'
    const mainImage = document.getElementById('img-principal');
    if (mainImage) {
        mainImage.src = el.src;
        mainImage.alt = el.alt;
        // Remove a classe de zoom ao trocar de imagem
        mainImage.classList.remove('zoom');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('img-principal');
    const thumbnails = document.querySelectorAll('.miniaturas .thumb');
    const prevBtn = document.querySelector('.nav-btn.prev');
    const nextBtn = document.querySelector('.nav-btn.next');
    
    // Cria um array com todas as URLs das miniaturas para a navegação
    const allImages = Array.from(thumbnails).map(img => img.src);
    let currentIndex = 0;

    // --- 1. Lógica do Zoom e Inicialização ---
    if (mainImage) {
        mainImage.addEventListener('click', () => {
            // Usa 'zoom' como definido no seu CSS (produto_detalhe.css)
            mainImage.classList.toggle('zoom'); 
        });
        
        // Encontra o índice da imagem principal inicial
        const initialSrc = mainImage.src;
        const initialIndex = allImages.findIndex(src => src === initialSrc);
        if (initialIndex !== -1) {
            currentIndex = initialIndex;
        }
    }

    // --- 2. Lógica de Troca por Miniatura (Thumbnail Click) ---
    thumbnails.forEach((thumb, index) => {
        thumb.addEventListener('click', (e) => {
            e.preventDefault();
            swapImage(thumb);
            currentIndex = index; // Atualiza o índice
        });
    });

    // --- 3. Lógica de Navegação (Prev/Next Buttons) ---
    function updateImage(n) {
        if (allImages.length === 0) return;

        // Calcula o novo índice de forma cíclica (volta para o início/fim se ultrapassar)
        currentIndex = (currentIndex + n) % allImages.length;
        if (currentIndex < 0) {
            currentIndex = allImages.length - 1;
        }

        const newSrc = allImages[currentIndex];
        
        mainImage.src = newSrc;
        mainImage.alt = `Imagem ${currentIndex + 1}`;
        mainImage.classList.remove('zoom');
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            updateImage(-1);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            updateImage(1);
        });
    }

    // --- 4. Manutenção das Funções de Favorito e Compartilhamento ---
    const favBtn = document.getElementById('favBtn');
    if (favBtn) {
        favBtn.addEventListener('click', ()=>{
            const icon = favBtn.querySelector('i');
            icon.classList.toggle('fa-regular');
            icon.classList.toggle('fa-solid');
            icon.style.color = icon.classList.contains('fa-solid') ? 'red' : '#333';
            favBtn.classList.add('animate');
            setTimeout(()=> favBtn.classList.remove('animate'),400);
        });
    }
    
    const shareBtn = document.getElementById('shareBtn');
    if (shareBtn) {
        shareBtn.addEventListener('click', ()=>{
            shareBtn.classList.add('animate');
            setTimeout(()=> shareBtn.classList.remove('animate'),400);
            if(navigator.share){
              navigator.share({
                title: 'Anúncio de Produto',
                text: 'Confira este produto incrível!',
                url: window.location.href
              });
            } else {
              alert('Compartilhamento não suportado neste navegador.');
            }
        });
    }
});