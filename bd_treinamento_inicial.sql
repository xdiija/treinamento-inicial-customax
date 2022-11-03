-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Nov-2022 às 14:09
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `treinamento_inicial`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `keys_amazon`
--

CREATE TABLE `keys_amazon` (
  `access_key` varchar(256) NOT NULL,
  `secret_key` varchar(256) NOT NULL,
  `bucket_amazon` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `keys_amazon`
--

INSERT INTO `keys_amazon` (`access_key`, `secret_key`, `bucket_amazon`) VALUES
('***inserir access_key***', '***inserir secret_key***', 'bucket-djalma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `kits_sistema`
--

CREATE TABLE `kits_sistema` (
  `id_kit` int(11) NOT NULL,
  `tipo_kit` int(11) NOT NULL,
  `finame_kit` int(11) NOT NULL,
  `potencia_modulo_kit` int(11) NOT NULL,
  `qtd_min_modulos_kit` int(11) NOT NULL,
  `qtd_max_modulos_kit` int(11) NOT NULL,
  `range_modulos_kit` int(11) NOT NULL,
  `cod_inversor1_kit` int(11) NOT NULL,
  `cod_inversor2_kit` int(11) NOT NULL,
  `cod_inversor3_kit` int(11) NOT NULL,
  `qtd_inversor1_kit` int(11) NOT NULL,
  `qtd_inversor2_kit` int(11) NOT NULL,
  `qtd_inversor3_kit` int(11) NOT NULL,
  `potencia_inversor_kit` decimal(10,0) NOT NULL,
  `potencia_trafo_kit` float NOT NULL,
  `valor_comercial_kit` decimal(10,0) NOT NULL,
  `corrente_inversores1_kit` decimal(10,0) NOT NULL,
  `corrente_inversores2_kit` decimal(10,0) NOT NULL,
  `monitoramento_kit` varchar(256) NOT NULL,
  `dps_ca_kit` int(11) NOT NULL,
  `disjuntor_comercial_kit` int(11) NOT NULL,
  `status_kit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `kits_sistema`
--

INSERT INTO `kits_sistema` (`id_kit`, `tipo_kit`, `finame_kit`, `potencia_modulo_kit`, `qtd_min_modulos_kit`, `qtd_max_modulos_kit`, `range_modulos_kit`, `cod_inversor1_kit`, `cod_inversor2_kit`, `cod_inversor3_kit`, `qtd_inversor1_kit`, `qtd_inversor2_kit`, `qtd_inversor3_kit`, `potencia_inversor_kit`, `potencia_trafo_kit`, `valor_comercial_kit`, `corrente_inversores1_kit`, `corrente_inversores2_kit`, `monitoramento_kit`, `dps_ca_kit`, `disjuntor_comercial_kit`, `status_kit`) VALUES
(1, 0, 0, 330, 6, 10, 4, 2, 5, 0, 1, 1, 0, '340', 369.57, '2501', '1', '2', 'Wi-fi etc..', 2030, 105, 0),
(2, 0, 0, 330, 6, 10, 4, 2, 5, 0, 1, 1, 0, '340', 369.57, '2501', '1', '2', 'Wi-fi etc..', 2030, 105, 0),
(3, 0, 0, 330, 6, 10, 4, 2, 5, 0, 1, 1, 0, '340', 369.57, '2501', '1', '2', 'Wi-fi etc..', 2030, 105, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_gerais`
--

CREATE TABLE `logs_gerais` (
  `id_log` int(11) NOT NULL,
  `rotina_log` varchar(256) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `cod_registro` int(11) NOT NULL,
  `tipo_log` varchar(256) NOT NULL,
  `descricao_log` varchar(256) NOT NULL,
  `data_log` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logs_gerais`
--

INSERT INTO `logs_gerais` (`id_log`, `rotina_log`, `cod_usuario`, `cod_registro`, `tipo_log`, `descricao_log`, `data_log`) VALUES
(1, 'CXESCAD043', 1, 0, 'Atualização de Kits', '<br />\r\n					Importado = 1Registros<br>Potência = 330', '2022-10-21'),
(2, 'CXESCAD043', 1, 0, 'Atualização de Kits', '<br />\r\n					Importado = 1Registros<br>Potência = 330', '2022-10-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

CREATE TABLE `perfis` (
  `id_perfil` int(11) NOT NULL,
  `nome_perfil` varchar(300) NOT NULL,
  `status_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`id_perfil`, `nome_perfil`, `status_perfil`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `s3files`
--

CREATE TABLE `s3files` (
  `id_file` int(11) NOT NULL,
  `s3_file_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `s3files`
--

INSERT INTO `s3files` (`id_file`, `s3_file_path`) VALUES
(23, 'fotos_usuarios/facon_2022-10-29_09_22_42.png'),
(24, 'fotos_usuarios/logo_orig - Copia_2022-10-31_16_22_17.png'),
(26, 'fotos_usuarios/facon_2022-11-01_07_29_28.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(200) NOT NULL,
  `perfil_usuario` int(11) NOT NULL,
  `login_usuario` varchar(200) NOT NULL,
  `senha_usuario` varchar(200) NOT NULL,
  `email_usuario` varchar(200) NOT NULL,
  `telefone_usuario` varchar(20) NOT NULL,
  `rua_usuario` varchar(256) NOT NULL,
  `numero_usuario` varchar(30) NOT NULL,
  `bairro_usuario` varchar(50) NOT NULL,
  `cidade_usuario` varchar(100) NOT NULL,
  `estado_usuario` varchar(50) NOT NULL,
  `complemento_usuario` varchar(150) NOT NULL,
  `nasc_usuario` date DEFAULT NULL,
  `cpf_usuario` varchar(50) NOT NULL,
  `status_usuario` int(11) NOT NULL,
  `foto_usuario` varchar(500) DEFAULT NULL,
  `data_cadastro_usuario` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `perfil_usuario`, `login_usuario`, `senha_usuario`, `email_usuario`, `telefone_usuario`, `rua_usuario`, `numero_usuario`, `bairro_usuario`, `cidade_usuario`, `estado_usuario`, `complemento_usuario`, `nasc_usuario`, `cpf_usuario`, `status_usuario`, `foto_usuario`, `data_cadastro_usuario`) VALUES
(1, 'Djalma Leandro', 1, 'xdiija', 'e10adc3949ba59abbe56e057f20f883e', 'Djalma@gmail.com', '33763166', 'Manoel VIeira', '240', 'Barra', 'Jaragua', 'SC', 'casa', '1969-12-31', '075.975.999-51', 1, 'fotos_usuarios/16_foto.png', '2020-10-01'),
(2, 'Jair Messias Bolsonaro', 2, 'teste2', 'e10adc3949ba59abbe56e057f20f883e\r\n', 'a@k.com', '33763166', 'Rua das Pedras', '110', 'Centro', 'Joinville', 'SC', 'casa', '1992-10-05', '11356485599', 1, 'fotos_usuarios/imagem exemplo.jpg', '2019-05-10'),
(16, 'Ariane Muller', 2, 'aria', 'fefcdca2c09e64bcbffdddfd0a170bd7', 'arianecristinamuller@gmail.com', '(47) 99999-9999', 'Txunusnbango txununsbago', '180', 'Barra', 'Laranjal do Jari', 'Amapá', '240', '1998-12-10', '113.108.009-28', 1, 'fotos_usuarios/16_foto.png', '2022-05-01'),
(17, 'Joao da Silva', 1, 'joao', '76e5dda5d53f3c21a0f8dd3ba3debf56', 'joa@gmail.com', '(47) 99999-9999', 'Rua das flores', '357', 'Centro', 'Acrelândia', 'Acre', 'Apartamento', '2000-10-10', '604.846.850-40', 1, 'fotos_usuarios/17_foto.png', '2021-10-05'),
(18, 'Matheus Oliveira', 2, 'lol', '76e5dda5d53f3c21a0f8dd3ba3debf56', 'asds@gmail.com', '(33) 333', 'nao tem', '430', 'Barra do Rio Cerro', 'Abaiara', 'Ceará', '12', '1000-10-10', '867.521.710-25', 1, 'fotos_usuarios/17_foto.png', '2021-10-05'),
(19, 'Thiago André', 1, 'xdiijaa', '76e5dda5d53f3c21a0f8dd3ba3debf56', 'arianecristinamuller@gmail.comm', '33763166', 'nao tem', '50', 'Barra do Rio Cerro', 'Abaíra', 'Bahia', 'a', '1000-10-10', '768.114.790-00', 1, 'fotos_usuarios/1_foto.png', '2021-10-05'),
(20, 'Diego Joao', 2, 'djoao', '76e5dda5d53f3c21a0f8dd3ba3debf56', 'daj@jsad.com', '(32) 3232-3', 'asd', '12', 'Barra do Rio Cerro', 'Acrelândia', 'Acre', 'casa', '1991-01-10', '895.977.010-81', 1, 'fotos_usuarios/imagem exemplo.jpg', '2021-10-05'),
(21, 'Mauricio Dias Meireles', 2, 'xdiijaaa', '76e5dda5d53f3c21a0f8dd3ba3debf56', 'djalma.classemoveis@gmail.com', '(12) 3', '123', '651', '123', 'Jaraguá do Sul', 'Santa Catarina', '123', '1000-10-10', '480.906.770-02', 1, 'fotos_usuarios/21_foto.png', '2021-10-05');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `kits_sistema`
--
ALTER TABLE `kits_sistema`
  ADD PRIMARY KEY (`id_kit`);

--
-- Índices para tabela `logs_gerais`
--
ALTER TABLE `logs_gerais`
  ADD PRIMARY KEY (`id_log`);

--
-- Índices para tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `s3files`
--
ALTER TABLE `s3files`
  ADD PRIMARY KEY (`id_file`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `kits_sistema`
--
ALTER TABLE `kits_sistema`
  MODIFY `id_kit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `logs_gerais`
--
ALTER TABLE `logs_gerais`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `s3files`
--
ALTER TABLE `s3files`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
