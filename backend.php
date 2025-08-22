<?php
header("Content-Type: application/json; charset=UTF-8");


$host = "localhost";
$user = "root";        
$pass = "";            
$db   = "vendas_db";   

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Erro na conexão: " . $conn->connect_error]);
    exit;
}

$sqlIndicadores = "
    SELECT 
        SUM(valor_total) AS faturamentoBruto,
        SUM(CASE WHEN status = 'concluido' THEN valor_total ELSE 0 END) AS faturamentoLiquido,
        SUM(CASE WHEN status = 'reembolso' THEN valor_total ELSE 0 END) AS reembolsos
    FROM vendas
";
$resultIndicadores = $conn->query($sqlIndicadores);
$indicadores = $resultIndicadores->fetch_assoc();

$sqlMensal = "
    SELECT DATE_FORMAT(data_venda, '%b') AS mes, SUM(valor_total) AS total
    FROM vendas
    WHERE YEAR(data_venda) = YEAR(CURDATE())
    GROUP BY MONTH(data_venda)
    ORDER BY MONTH(data_venda)
    LIMIT 6
";
$resultMensal = $conn->query($sqlMensal);

$labels = [];
$valores = [];
while ($row = $resultMensal->fetch_assoc()) {
    $labels[] = $row['mes'];
    $valores[] = (float)$row['total'];
}


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


$conn->close();
?>
