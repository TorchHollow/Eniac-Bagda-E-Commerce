const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const chooseBtn = document.getElementById('chooseBtn');
const preview = document.getElementById('preview');
const form = document.getElementById('productForm');

chooseBtn.addEventListener('click', () => fileInput.click());

['dragenter','dragover'].forEach(evt =>
  dropZone.addEventListener(evt, e => {
    e.preventDefault();
    e.stopPropagation();
    dropZone.classList.add('is-dragover');
  })
);
['dragleave','drop'].forEach(evt =>
  dropZone.addEventListener(evt, e => {
    e.preventDefault();
    e.stopPropagation();
    dropZone.classList.remove('is-dragover');
  })
);

dropZone.addEventListener('drop', e => {
  const file = e.dataTransfer.files?.[0];
  if (file) handleFile(file);
});

dropZone.addEventListener('keydown', e => {
  if (e.key === 'Enter' || e.key === ' ') {
    e.preventDefault();
    fileInput.click();
  }
});

fileInput.addEventListener('change', e => {
  const file = e.target.files?.[0];
  if (file) handleFile(file);
});

function handleFile(file){
  if(!file.type.startsWith('image/')){
    alert('Selecione um arquivo de imagem.');
    return;
  }
  const reader = new FileReader();
  reader.onload = () => {
    preview.src = reader.result;
    preview.hidden = false;
  };
  reader.readAsDataURL(file);
}

document.querySelectorAll('.menu__item').forEach(a=>{
  a.addEventListener('click', e=>{
    e.preventDefault();
    document.querySelectorAll('.menu__item').forEach(n=>n.classList.remove('active'));
    a.classList.add('active');
  });
});