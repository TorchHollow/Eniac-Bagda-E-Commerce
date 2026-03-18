<?php
// Usa a nossa conexão PDO unificada
require_once '../includes/conexao.php';

// Define os cabeçalhos para forçar o download do arquivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=relatorio_vendas.csv');

// Abre o fluxo de saída do PHP para escrever o arquivo
$output = fopen('php://output', 'w');

// Escreve a linha de cabeçalho no CSV (com ponto e vírgula como separador)
fputcsv($output, ['ID Venda', 'ID Usuario', 'Valor Total', 'Status', 'Data da Venda'], ';');

try {
    // Query para buscar todas as vendas, ordenadas por data
    $stmt = $db->query("SELECT id, id_usuario, valor_total, status, DATE_FORMAT(data_venda, '%Y-%m-%d') AS data_formatada FROM vendas ORDER BY data_venda DESC");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Formata o valor para o padrão brasileiro antes de escrever no CSV
        $row['valor_total'] = number_format((float)$row['valor_total'], 2, ',', '.');
        
        // Escreve a linha da venda no arquivo
        fputcsv($output, [
            $row['id'],
            $row['id_usuario'],
            $row['valor_total'],
            $row['status'],
            $row['data_formatada']
        ], ';');
    }

} catch (PDOException $e) {
    // Em caso de erro, pode-se logar ou simplesmente não gerar linhas
}

fclose($output);
exit;
?>