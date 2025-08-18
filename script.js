function swapImage(el){
    const main = document.getElementById('main-image');
    main.src = el.src;
    main.alt = el.alt;
    main.classList.remove('zoomed');
  }
  
  const mainImage = document.getElementById('main-image');
  mainImage.addEventListener('click', ()=>{
    mainImage.classList.toggle('zoomed');
  });
  
  // Favoritar
  const favBtn = document.getElementById('favBtn');
  favBtn.addEventListener('click', ()=>{
    const icon = favBtn.querySelector('i');
    icon.classList.toggle('fa-regular');
    icon.classList.toggle('fa-solid');
    icon.style.color = icon.classList.contains('fa-solid') ? 'red' : '#333';
    favBtn.classList.add('animate');
    setTimeout(()=> favBtn.classList.remove('animate'),400);
  });
  
  // Compartilhar
  const shareBtn = document.getElementById('shareBtn');
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