-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/10/2025 às 00:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `eniac_ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `imagem_1` varchar(255) DEFAULT NULL,
  `imagem_2` varchar(255) DEFAULT NULL,
  `imagem_3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `condicao`, `categoria`, `imagem_1`, `imagem_2`, `imagem_3`) VALUES
(1, 'O Menino Maluquinho', 'Sobre o Autor\r\nZiraldo nasceu em Caratinga, Minas Gerais, em 1932. Autor de livros infantis, ilustrador e cartunista, é uma das personalidades de maior destaque na cultura brasileira. Sua obra compreende mais de 167 títulos para crianças e jovens, além de publicações para adultos. Com seus livros traduzidos para diversos idiomas, entre eles o inglês, o espanhol, o alemão, o francês, o italiano e o hebraico, Ziraldo representa o talento e o humor brasileiros no mundo. Seu livro de maior sucesso, O Menino Maluquinho, é um dos maiores fenômenos editoriais de todos os tempos no Brasil. O livro foi adaptado para teatro, quadrinhos, ópera infantil, videogame, internet e cinema, e conta com 129 edições, tendo vendido mais de 4 milhões de exemplares.', 23.90, 'novo', 'livros_apostilas', '1759801915_livro.png', NULL, NULL),
(3, 'Computador Completo I3 8Gb Ram Hd 500Gb Monitor 19', 'Computador completo i3 8gb ram hd 500gb monitor 19\r\nOs computadores da amorim, seja para grandes ou pequenas empresas, profissionais em home office ou alunos, nossa linha home é completamente pensada para atender às necessidades de profissionais e alunos que buscam eficiência e bom desempenho na execução de seus trabalhos e atividades. Com componentes selecionados para uma melhor desempenho, nossos computadores irão tornar a sua rotina muito mais eficiente\r\n\r\nEspecificações cpu:\r\n\r\nProcessador: intel core i3-540 3.06ghz 2 núcleos e 4 threads.\r\n\r\nPlaca mãe h55 suporta processadores intel core i7, core i5, core i3. Permite no máximo 8gb ddr3 e acompanha 4 slots de 2gb ddr3 de memória.\r\n\r\nHd: 500 gb\r\n\r\nMemória 8gb ddr3\r\n\r\nSistema operacional: windows 10 pro\r\n\r\nEntrada vga\r\n\r\n4 portas usb 2.0\r\n\r\nVoltagem 110/220v\r\n\r\nFonte 200w\r\n\r\nIncluso na embalagem:\r\n\r\n1x cpu com todas as especificações acima\r\n\r\n1x monitor de 19 polegadas - reformado\r\n\r\n1x teclado e mouse com fio\r\n\r\nCabos de alimentação\r\n\r\nGarantia de 06 meses o termo de garantia será enviado junto ao produto.', 962.90, 'usado', 'equipamentos_informatica', '1759805610_pc.png', '1759805610_pc2.png', '1759805610_pc3.png'),
(4, 'Kit Escolar Individual AZUL – (Mesa e Cadeira) – INFANTIL – MADEIRA – COR AZUL – REALPLAST – 40085', 'Kit Escolar Individual AZUL – (Mesa e Cadeira) – INFANTIL – MADEIRA – COR AZUL – REALPLAST – 40085\r\nModelo: Kit Escolar Individual\r\nReferência do Modelo: Kit Escolar individual infantil azul\r\nAltura mesa (cm): 59\r\nLargura mesa (cm): 60\r\nProfundidade mesa (cm): 0,44\r\nPeso Suportado (Kg): 100\r\nCor: azul\r\nGarantia do Fornecedor: 24 Meses\r\nMarca: REALPLAST\r\nMais Informações: Assento e encosto em polímero termoplástico (polipropileno), Estrutura de aço, Plástico não tóxico, Plástico 100% sustentável, Tampo em MDF (fitado), Porta Livros.', 395.90, 'semi-novo', 'mobilia', '1759805720_imagem_2025-10-06_235455401.png', '1759805720_imagem_2025-10-06_235504778.png', '1759805720_imagem_2025-10-06_235519496.png'),
(5, 'Agitador Mecânico Digital 60L', 'Características do Agitador Mecânico Digital 60L \r\n \r\nO Agitador Mecânico Digital Onesense 20 da Marte é um equipamento de laboratório de alta qualidade e tecnologia que tem como objetivo agitar produtos com viscosidade de até 80.000 mPa.s (máx. 3,5 kg de creme) e até 60 litros de água. Com um microprocessador, o aparelho consegue manter constante a agitação, alterando a potência do motor de acordo com a viscosidade do produto até a potência máxima. Além disso, o equipamento possui autoajuste de rotação para uma menor, caso ele não consiga atingir a rotação solicitada.  \r\n\r\nO Agitador Mecânico Digital Onesense 20 possui uma série de características que o tornam um equipamento de destaque em sua categoria. Ele possui uma memória para salvar até três modos de agitação (velocidade x tempo), um display digital que apresenta velocidade, tempo e modo, um motor DC de imã permanente com baixo ruído e livre de manutenção.  \r\n\r\nEntre as especificações técnicas, destacam-se a capacidade máxima de agitação de 60 L (HO), a potência de entrada do motor de 200 W e a potência de saída do motor de 180 W. A tensão de alimentação é de 100-240 VAC, a frequência é de 50/60 Hz e a potência (consumo) é de 210 W. A faixa de velocidade de rotação varia de 100 a 2000 rpm, com display LCD, resolução de velocidade de ±1 rpm e incremento de velocidade de 20 rpm. O torque máximo é de 90 N.cm e possui proteção contra sobrecarga que resulta em parada automática. A viscosidade máxima suportada é de 80000 mPa.s, e o diâmetro máximo de fixação do mandril é de 0.5-10 mm. A dimensão geral é de 200x315x600 mm e o peso líquido é de 12 kg. O grau de proteção é de IP 42 e a temperatura ambiente permitida varia de 5 a 40°C. A umidade ambiente permitida é de 80%.  \r\n\r\nO Agitador Mecânico Digital Onesense 20 é um equipamento completo e acompanha diversos acessórios, como a mufa de fixação, fonte de alimentação bivolt, garra e mufa secundária, suporte (haste e base), haste e hélice naval, e haste e hélice centrífuga. Seu alto desempenho e tecnologia o tornam ideal para o uso em laboratórios, universidades, indústrias farmacêuticas, químicas, entre outras áreas.  ', 3751.90, 'novo', 'laboratorios', '1759805857_imagem_2025-10-06_235714335.png', '1759805857_imagem_2025-10-06_235721935.png', '1759805857_imagem_2025-10-06_235729467.png'),
(6, 'Projetor Epson Powerlite E20 3LCD, XGA, 3.400 Lumens, Conexão HDMI, Bivolt - V11H981020', 'Projetor Epson Powerlite E20 3LCD, XGA, 3.400 Lumens, Conexão HDMI, Bivolt - V11H981020\r\n\r\n\r\nFaça projeções incríveis em sala de aula, numa faixa de preço acessível, com o projetor PowerLite E20. Com a avançada tecnologia 3LCD, esse projetor ultrabrilhante de 3.400 lumens¹ entrega imagens vibrantes e realistas. Possui o Melhor Brilho em Cores² de Sua Categoria e resolução nativa XGA. Desenvolvido especificamente para ambientes de sala de aula, o PowerLite E20 aumenta o engajamento e enriquece os planos de aula graças à conectividade HDMI e ao alto-falante integrado de 5W. Feito para durar, esse projetor oferece longa vida útil de lâmpada — até 12.000 horas no modo ECO³ —, além de ter instalação conveniente e versatilidade de posicionamento, o que permite projetar facilmente a partir de todos os ângulos da sala de aula.\r\n\r\n \r\n\r\nConfiguração fácil e versatilidade de posicionamento\r\n\r\n\r\nZoom digital de 1.0-1.35x, ±30 graus de correção keystone horizontal e vertical, e slider horizontal keystone. \r\nTecnologia 3LCD de 3 chips para o melhor brilho em cores de sua categoria \r\n3.400 lumens de brilho em cores e 3.400 lumens brilho em branco. \r\nLâmpada de longa duração a um preço acessível  até 12.000 horas em Modo ECO.  Resolução nativa XGA e performance 4:3\r\npara imagens vibrantes e coloridas', 3339.99, 'semi-novo', 'equipamentos_informatica', '1759805948_imagem_2025-10-06_235841890.png', '1759805948_imagem_2025-10-06_235856974.png', '1759805948_imagem_2025-10-06_235907284.png'),
(7, 'Caixa de Som, Edifier R1000T4, 24W RMS', 'Acústica Surpreendente\r\nMaterial com fibra de Madeira 100% (MDF), este monitor de áudio é construído para resistir à ressonância. Para ser usado em home studio, em casa ou no escritório, esta é a opção perfeita com o melhor custo benefício do mercado nacional.\r\nUso Semi-Profissional\r\nApesar de ser um produto dedicado aqueles que estão a procura dos tons mais limpos e nítidos, a R1000T4 não se direciona apenas a esse grupo. Seja você um entusiasta de jogos ou simplesmente quer dar ainda mais qualidade para os conteúdos multimídia que você reproduz no seu computador, celular ou tablet, esse monitor irá cair como uma luva. Surpreenda-se com os resultados e viva experiências com ainda mais emoção.', 799.90, 'novo', 'audio_video', NULL, NULL, NULL),
(8, 'Cd-r gravável (80min/700mb)52x printable CD052 Multi PT 50 UN', 'Características do Produto\r\nA Multilaser projetou mídias de excelente qualidade para armazenamento de documentos em geral, jogos, fotos digitais, aplicações multimídias e etc. Diâmetro da mídia: 120mm\r\nEspecificações\r\nCD-R gravável\r\nCapacidade\r\nCapacidade de 700MB ou 80 minutos\r\nVelocidade\r\nVelocidade de gravação de 52x\r\nEmbalagem\r\nShrink Imprimivel', 69.90, 'novo', 'equipamentos_informatica', '1759806163_imagem_2025-10-07_000241113.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(256) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `cpf`, `data_nascimento`, `telefone`, `senha`) VALUES
(1, 'Arthur Lopes dos Santos', 'als.arthurlopes@gmail.com', '391f626f559bc89cb73b46898682a34841b80a8a0a69acb091a9fdc69b58ddf8', '2005-12-21', '(11) 99999-9990', '$2y$10$HAORHe0xJzKT2y2jY1e9F.5vgmBPGGDPFq0BIsXpoHK8gaYqukbxO'),
(3, 'Joao Pedro', 'joao@gmail.com', 'be16e6f1fa4c9736c6bf390fcf458f67e5be37d7c0dc40b72345810ead840019', '2000-02-07', '(11) 99999-9999', '$2y$10$Juz1Xf6cxNeafH9tE3.aJOMjikiuDqx2/5pF3TABTJTb3LYIxS65a');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('concluido','pendente','reembolso') DEFAULT 'pendente',
  `data_venda` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `id_usuario`, `valor_total`, `status`, `data_venda`, `created_at`) VALUES
(4, 1, 23.90, 'concluido', '0000-00-00', '2025-10-07 02:11:18'),
(5, 1, 904.44, 'concluido', '2025-10-06', '2025-10-07 02:19:50'),
(6, 3, 3339.99, 'concluido', '2025-10-07', '2025-10-07 03:45:43'),
(7, 3, 69.90, 'concluido', '2025-10-10', '2025-10-10 21:50:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda_itens`
--

CREATE TABLE `venda_itens` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `valor_produto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda_itens`
--

INSERT INTO `venda_itens` (`id`, `id_venda`, `id_produto`, `nome_produto`, `valor_produto`) VALUES
(1, 5, 2, 'Computador Completo I3 8Gb Ram Hd 500Gb Monitor 19', 904.44),
(2, 6, 6, 'Projetor Epson Powerlite E20 3LCD, XGA, 3.400 Lumens, Conexão HDMI, Bivolt - V11H981020', 3339.99),
(3, 7, 8, 'Cd-r gravável (80min/700mb)52x printable CD052 Multi PT 50 UN', 69.90);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `venda_itens`
--
ALTER TABLE `venda_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venda` (`id_venda`),
  ADD KEY `id_produto` (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `venda_itens`
--
ALTER TABLE `venda_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Restrições para tabelas `venda_itens`
--
ALTER TABLE `venda_itens`
  ADD CONSTRAINT `venda_itens_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
