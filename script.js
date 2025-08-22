async function carregarDados() {
  try {
    const response = await fetch('./backend.php');
    const dashboardData = await response.json();

    document.getElementById('faturamentoBruto').textContent = formatarMoeda(dashboardData.indicadores.faturamentoBruto);
    document.getElementById('faturamentoLiquido').textContent = formatarMoeda(dashboardData.indicadores.faturamentoLiquido);
    document.getElementById('reembolsosTotais').textContent = formatarMoeda(dashboardData.indicadores.reembolsos);

    renderizarGrafico(dashboardData.vendasMensais);
  } catch (e) {
    console.error('Erro ao carregar dados do backend', e);
  }
}

function formatarMoeda(valor) {
  return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

function renderizarGrafico(vendasMensais) {
  const ctx = document.getElementById('salesChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: vendasMensais.labels,
      datasets: [{
        label: 'Vendas (R$)',
        data: vendasMensais.valores,
        backgroundColor: 'rgba(37,99,235,0.7)',
        borderRadius: 6
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });
}

carregarDados();