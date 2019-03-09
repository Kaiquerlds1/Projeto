-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 09-Mar-2019 às 11:31
-- Versão do servidor: 5.7.24
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdsistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estabelecimentos`
--

DROP TABLE IF EXISTS `estabelecimentos`;
CREATE TABLE IF NOT EXISTS `estabelecimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razao` varchar(250) DEFAULT NULL,
  `fantasia` varchar(250) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `agencia` varchar(30) DEFAULT NULL,
  `conta` varchar(30) DEFAULT NULL,
  `datacadastro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estabelecimentos`
--

INSERT INTO `estabelecimentos` (`id`, `razao`, `fantasia`, `cnpj`, `email`, `endereco`, `cidade`, `estado`, `categoria`, `telefone`, `status`, `agencia`, `conta`, `datacadastro`) VALUES
(1, 'Borracharia Renascer', 'Renascer', '60.628.994/0001-17', 'borracharia@gmail.com', 'Av Santana, 619, Jd Amanda', 'Hortolândia', 'São Paulo', 'Borracharia', '(19) 3865-1942', 'ativo', '112-5', '11.258-7', '2019-03-09'),
(2, 'Guindola Restaurante Ltda', 'Guindola', '43.424.180/0001-41', 'guindola@gmail.com', 'Marcelina Ramos Meira, 56, Jd Rosolen', 'Hortolândia', 'São Paulo', 'Restaurante', '', 'ativo', '258-7', '11.478-2', '2019-03-09'),
(3, 'Supermercado Pag Menos Ltda', 'Pag menos', '13.290.326/0001-42', 'pagmenos@gmail.com', 'Cabo Antonio Leite, 102, Jd Nossa Senha', 'Hortolândia', 'São Paulo', 'Supermercado', '(19) 3809-6300', 'ativo', '258-7', '11.478-2', '2019-03-09'),
(4, 'Posto Ipiranga Ltda', 'Posto Ipiranga', '83.825.001/0001-00', 'postoipiranga@hotmail.com', 'Antonio Fernandes Leite, 55', 'Campinas', 'São Paulo', 'Posto', '(19) 3809-0889', 'ativo', '114-5', '15.871-5', '2019-03-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `estadoID` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` char(20) DEFAULT '0',
  `sigla` char(2) DEFAULT NULL,
  PRIMARY KEY (`estadoID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`estadoID`, `nome`, `sigla`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(19, 'Piauí', 'PI'),
(20, 'RG do Norte', 'RN'),
(21, 'RG do Sul', 'RS'),
(22, 'Rio de Janeiro', 'RJ'),
(24, 'Rondônia', 'RO'),
(25, 'Roraima', 'RA'),
(26, 'Santa Catarina', 'SC'),
(27, 'São Paulo', 'SP'),
(28, 'Santa Catarina', 'SC'),
(29, 'Sergipe', 'SE'),
(30, 'Tocantins', 'TO');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
