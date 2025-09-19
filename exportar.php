<?php
// Configuração do banco
$host = "localhost";
$user = "root";
$pass = "";
$db   = "vendas_db";

// Conectar
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Query para pegar todas as vendas
$sql = "SELECT id, cliente, valor_total, status, DATE_FORMAT(data_venda, '%Y-%m-%d') AS data_venda FROM vendas ORDER BY data_venda";
$result = $conn->query($sql);

// Cabeçalho para download de CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=vendas.csv');

// Abrir saída do PHP como arquivo
$output = fopen('php://output', 'w');

// Escrever cabeçalho da tabela (usando ponto-e-vírgula como separador para compatibilidade regional)
fputcsv($output, ['ID', 'Cliente', 'Valor Total', 'Status', 'Data da Venda'], ';');

// Escrever linhas do banco
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Garantir formato de número com separador ponto para o CSV (Excel regional pode interpretar)
        $row['valor_total'] = number_format((float)$row['valor_total'], 2, ',', '.');
        fputcsv($output, [$row['id'], $row['cliente'], $row['valor_total'], $row['status'], $row['data_venda']], ';');
    }
}

fclose($output);
$conn->close();
exit;
?>