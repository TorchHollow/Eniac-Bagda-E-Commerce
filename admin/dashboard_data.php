<?php
header("Content-Type: application/json; charset=UTF-8");

// Usa a nossa conexão PDO unificada
require_once '../includes/conexao.php';

try {
    // Query para os indicadores principais (faturamento, etc.)
    $sqlIndicadores = "
        SELECT 
            COALESCE(SUM(valor_total), 0) AS faturamentoBruto,
            COALESCE(SUM(CASE WHEN status = 'concluido' THEN valor_total ELSE 0 END), 0) AS faturamentoLiquido,
            COALESCE(SUM(CASE WHEN status = 'cancelado' THEN valor_total ELSE 0 END), 0) AS reembolsos
        FROM vendas
    ";
    $stmtIndicadores = $db->query($sqlIndicadores);
    $indicadores = $stmtIndicadores->fetch(PDO::FETCH_ASSOC);

    // Query para as vendas mensais para o gráfico
    $sqlMensal = "
        SELECT DATE_FORMAT(data_venda, '%b') AS mes, SUM(valor_total) AS total
        FROM vendas
        WHERE data_venda >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
        GROUP BY DATE_FORMAT(data_venda, '%Y-%m')
        ORDER BY MIN(data_venda)
    ";
    $stmtMensal = $db->query($sqlMensal);

    $labels = [];
    $valores = [];
    while ($row = $stmtMensal->fetch(PDO::FETCH_ASSOC)) {
        $labels[] = $row['mes'];
        $valores[] = (float)$row['total'];
    }

    // Monta a resposta final em JSON
    $response = [
        "indicadores" => [
            "faturamentoBruto" => (float)$indicadores['faturamentoBruto'],
            "faturamentoLiquido" => (float)$indicadores['faturamentoLiquido'],
            "reembolsos" => (float)$indicadores['reembolsos']
        ],
        "vendasMensais" => [
            "labels" => $labels,
            "valores" => $valores
        ]
    ];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro ao consultar o banco de dados: " . $e->getMessage()]);
}
?>