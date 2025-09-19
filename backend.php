<?php
header("Content-Type: application/json; charset=UTF-8");

// Configurações do banco de dados - ajuste conforme seu ambiente
$host = "localhost";
$user = "root";
$pass = "";
$db   = "vendas_db";

// Conectar ao MySQL (mysqli)
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Erro na conexão: " . $conn->connect_error]);
    exit;
}
$conn->set_charset("utf8");

// Query para indicadores principais
$sqlIndicadores = "
    SELECT 
        COALESCE(SUM(valor_total),0) AS faturamentoBruto,
        COALESCE(SUM(CASE WHEN status = 'concluido' THEN valor_total ELSE 0 END),0) AS faturamentoLiquido,
        COALESCE(SUM(CASE WHEN status = 'reembolso' THEN valor_total ELSE 0 END),0) AS reembolsos
    FROM vendas
";
$resultIndicadores = $conn->query($sqlIndicadores);
$indicadores = $resultIndicadores->fetch_assoc();

// Query para vendas mensais (últimos 6 meses)
$sqlMensal = "
    SELECT DATE_FORMAT(data_venda, '%b') AS mes, SUM(valor_total) AS total, MONTH(data_venda) as mes_num
    FROM vendas
    WHERE data_venda >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY MONTH(data_venda)
    ORDER BY mes_num
";
$resultMensal = $conn->query($sqlMensal);

$labels = [];
$valores = [];
while ($row = $resultMensal->fetch_assoc()) {
    $labels[] = $row['mes'];
    $valores[] = (float)$row['total'];
}

// Caso não existam dados, fornecer valores padronizados
if (empty($labels)) {
    $labels = ['Jan','Fev','Mar','Abr','Mai','Jun'];
    $valores = [0,0,0,0,0,0];
}

// Montar resposta em JSON
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

// Fechar conexão
$conn->close();
?>