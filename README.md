# Projeto Dashboard de Vendas

Arquivos neste diretório:
- `index.html` — Front-end da dashboard (chama `backend.php` e `exportar.php`).
- `backend.php` — Endpoint PHP que retorna os indicadores e vendas mensais em JSON.
- `exportar.php` — Gera e retorna um arquivo CSV (vendas.csv) para download.
- `schema.sql` — Script SQL para criar a base `vendas_db`, tabela `vendas` e inserir dados de exemplo.

## Como usar (local)
1. Coloque os arquivos em um servidor com PHP e MySQL (ex.: XAMPP, MAMP, LAMP).
2. Importe `schema.sql` no seu MySQL para criar a base e os dados:
   `mysql -u root -p < schema.sql` ou use o phpMyAdmin.
3. Ajuste credenciais em `backend.php` e `exportar.php` caso seu MySQL não use `root` sem senha.
4. Acesse `index.html` via servidor (ex.: http://localhost/project_vendas/index.html).
5. Clique em "Exportar para Excel" para baixar `vendas.csv`.

Se quiser, faço também:
- Endpoint para inserir novas vendas (`create_sale.php`) com validação.
- Autenticação básica para proteger os endpoints.
- Gerar `.xlsx` nativo via PhpSpreadsheet.

