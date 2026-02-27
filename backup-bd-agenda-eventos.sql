-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql204.infinityfree.com
-- Tempo de geração: 27/02/2026 às 17:01
-- Versão do servidor: 11.4.10-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_41125853_agenda_eventos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `data_evento` datetime NOT NULL,
  `local` varchar(150) NOT NULL,
  `capacidade_maxima` int(11) NOT NULL,
  `criado_por` int(11) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id`, `titulo`, `descricao`, `data_evento`, `local`, `capacidade_maxima`, `criado_por`, `ativo`, `criado_em`) VALUES
(1, 'Palestra: Inteligência Artificial na Medicina', 'Palestra com especialistas sobre aplicações de IA no diagnóstico médico e tratamento de doenças. Debate sobre ética e futuro da medicina tecnológica.', '2026-02-15 14:00:00', 'Auditório Central - Bloco A', 200, 4, 1, '2026-01-20 13:00:00'),
(2, 'Workshop: Desenvolvimento Mobile com Flutter', 'Curso prático de 8 horas sobre criação de aplicativos multiplataforma usando Flutter e Dart. Traga seu notebook!', '2026-02-18 09:00:00', 'Laboratório de Informática 3', 40, 4, 1, '2026-01-25 18:30:00'),
(3, 'Semana de Engenharia Elétrica', 'Evento de 5 dias com palestras, minicursos e feira de projetos dos alunos. Inscrições para o primeiro dia incluem acesso a toda semana.', '2026-02-22 08:00:00', 'Centro de Convenções Universitário', 500, 4, 1, '2026-01-18 12:00:00'),
(4, 'Hackathon Universitário 2026', 'Maratona de programação de 24 horas. Forme equipes de até 4 pessoas e desenvolva soluções inovadoras. Premiação para os 3 melhores projetos.', '2026-02-25 18:00:00', 'Ginásio Poliesportivo', 120, 4, 1, '2026-01-22 14:15:00'),
(5, 'Simpósio de Pesquisa em Física Quântica', 'Apresentação de artigos científicos e discussões sobre avanços em computação quântica, criptografia e aplicações práticas.', '2026-03-05 13:00:00', 'Auditório do Instituto de Física', 150, 4, 1, '2026-02-01 11:30:00'),
(6, 'Minicurso: Python para Análise de Dados', 'Aprenda a usar Pandas, NumPy e Matplotlib para análise exploratória de dados. Voltado para iniciantes em Data Science.', '2026-03-08 14:00:00', 'Sala 205 - Departamento de Estatística', 35, 4, 1, '2026-02-05 19:00:00'),
(7, 'Feira de Estágios e Trainee 2026', 'Mais de 50 empresas parceiras oferecendo vagas de estágio e programa trainee. Traga currículos atualizados!', '2026-03-12 09:00:00', 'Pavilhão de Exposições', 800, 4, 1, '2026-02-10 13:00:00'),
(8, 'Palestra: Sustentabilidade e Economia Circular', 'Discussão sobre práticas empresariais sustentáveis e modelos de negócio baseados em economia circular. Com cases brasileiros.', '2026-03-15 15:30:00', 'Anfiteatro do Curso de Administração', 100, 24, 1, '2026-02-12 17:20:00'),
(9, 'Workshop: Design Thinking na Prática', 'Metodologia ágil para solução de problemas complexos. Atividades práticas em grupo e desenvolvimento de protótipos.', '2026-03-20 09:00:00', 'Sala de Inovação - Bloco B', 50, 4, 1, '2026-02-15 12:45:00'),
(10, 'Congresso de Biomedicina e Biotecnologia', 'Três dias de palestras, pôsteres científicos e debates sobre terapias gênicas, nanomedicina e bioengenharia.', '2026-03-25 08:30:00', 'Centro de Ciências Biológicas', 300, 4, 1, '2026-02-18 14:00:00'),
(11, 'Semana da Computação 2026', 'Palestras sobre DevOps, Cloud Computing, Machine Learning e Segurança da Informação. Certificado de 40 horas.', '2026-04-01 08:00:00', 'Campus de Tecnologia - Vários Locais', 400, 4, 1, '2026-02-25 11:00:00'),
(12, 'Torneio de Robótica Universitário', 'Competição de robôs autônomos em diferentes categorias: seguidor de linha, sumô e futebol de robôs. Equipes de 3-5 integrantes.', '2026-04-08 10:00:00', 'Arena de Robótica', 80, 4, 1, '2026-03-01 18:30:00'),
(13, 'Palestra: Carreira em Startups Tecnológicas', 'Fundadores de startups brasileiras de sucesso compartilham experiências sobre empreendedorismo, investimentos e desafios.', '2026-04-12 19:00:00', 'Auditório Central - Bloco A', 250, 4, 1, '2026-03-05 13:15:00'),
(14, 'Curso: Introdução ao Machine Learning', 'Curso de 20 horas sobre algoritmos de ML, validação de modelos e aplicações práticas com Python e Scikit-learn.', '2026-04-14 18:00:00', 'Laboratório de IA', 30, 4, 1, '2026-03-08 16:40:00'),
(15, 'Workshop: Fotografia e Produção Audiovisual', 'Técnicas de fotografia, iluminação, edição de vídeo e produção de conteúdo para redes sociais. Aberto a todos os cursos.', '2026-04-19 14:00:00', 'Estúdio de Comunicação Social', 25, 4, 1, '2026-03-10 19:20:00'),
(16, 'Simpósio de Direito Digital e Proteção de Dados', 'Discussões sobre LGPD, crimes cibernéticos, contratos digitais e regulamentação de IA no Brasil e mundo.', '2026-04-22 09:00:00', 'Faculdade de Direito - Auditório', 180, 4, 1, '2026-03-12 12:00:00'),
(17, 'Maratona de Programação ACM-ICPC Regional', 'Competição oficial ACM-ICPC com problemas de alta complexidade. Equipes de 3 competidores. Classificatória para a nacional.', '2026-05-03 08:00:00', 'Centro de Computação', 90, 4, 1, '2026-03-20 11:30:00'),
(18, 'Jornada de Arquitetura e Urbanismo', 'Exposição de projetos, palestras sobre arquitetura sustentável e visitas técnicas a obras importantes da cidade.', '2026-05-10 09:00:00', 'Faculdade de Arquitetura', 150, 4, 1, '2026-03-25 17:00:00'),
(19, 'Palestra: Neurociência e Aprendizagem', 'Como o cérebro aprende? Pesquisadores apresentam descobertas sobre memória, atenção e técnicas de estudo baseadas em evidências.', '2026-05-14 16:00:00', 'Instituto de Neurociências', 120, 4, 1, '2026-04-01 13:30:00'),
(20, 'Workshop: Git e GitHub para Iniciantes', 'Controle de versão, trabalho colaborativo, pull requests e boas práticas de desenvolvimento em equipe. Prático e objetivo.', '2026-05-17 10:00:00', 'Laboratório de Informática 1', 45, 4, 1, '2026-04-05 14:15:00'),
(21, 'Encontro de Química Orgânica Aplicada', 'Apresentação de pesquisas em síntese orgânica, catálise e desenvolvimento de novos materiais para indústria farmacêutica.', '2026-05-22 13:30:00', 'Instituto de Química - Sala 401', 80, 4, 1, '2026-04-08 18:45:00'),
(22, 'Semana do Meio Ambiente na Universidade', 'Palestras, oficinas de reciclagem, plantio de árvores e debates sobre mudanças climáticas e biodiversidade brasileira.', '2026-06-05 08:00:00', 'Praça Central do Campus', 500, 4, 1, '2026-04-15 12:00:00'),
(23, 'Bootcamp: DevOps e Cloud Computing', 'Imersão de 3 dias em Docker, Kubernetes, CI/CD, AWS e práticas DevOps. Para alunos com conhecimento intermediário em programação.', '2026-06-10 09:00:00', 'Laboratório de Redes', 35, 4, 1, '2026-04-20 16:00:00'),
(24, 'Colóquio de Matemática Aplicada', 'Aplicações da matemática em criptografia, modelagem epidemiológica, otimização e aprendizado de máquina. Palestras e mesas redondas.', '2026-06-18 14:00:00', 'Departamento de Matemática', 100, 4, 1, '2026-04-25 19:30:00'),
(25, 'Feira de Inovação e Empreendedorismo', 'Exposição de projetos de incubadoras, pitch de startups, mentorias com investidores e networking com o ecossistema de inovação.', '2026-06-25 10:00:00', 'Centro de Empreendedorismo', 300, 4, 1, '2026-05-01 11:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('INSCRITO','CANCELADO') DEFAULT 'INSCRITO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `inscricoes`
--

INSERT INTO `inscricoes` (`id`, `usuario_id`, `evento_id`, `data_inscricao`, `status`) VALUES
(1, 7, 1, '2026-01-23 11:10:00', 'INSCRITO'),
(2, 8, 1, '2026-01-23 19:30:00', 'INSCRITO'),
(3, 9, 1, '2026-01-24 13:00:00', 'INSCRITO'),
(4, 10, 1, '2026-01-24 16:25:00', 'INSCRITO'),
(5, 11, 1, '2026-01-25 14:40:00', 'INSCRITO'),
(6, 12, 1, '2026-01-25 18:55:00', 'INSCRITO'),
(7, 13, 1, '2026-01-26 12:30:00', 'INSCRITO'),
(8, 14, 1, '2026-01-26 17:20:00', 'INSCRITO'),
(9, 15, 1, '2026-01-27 13:45:00', 'INSCRITO'),
(10, 16, 1, '2026-01-27 19:10:00', 'INSCRITO'),
(11, 17, 1, '2026-01-28 11:50:00', 'INSCRITO'),
(12, 18, 1, '2026-01-28 16:15:00', 'INSCRITO'),
(13, 19, 1, '2026-01-29 14:20:00', 'INSCRITO'),
(14, 20, 1, '2026-01-29 18:35:00', 'INSCRITO'),
(15, 21, 1, '2026-01-30 12:00:00', 'INSCRITO'),
(16, 22, 1, '2026-01-30 17:40:00', 'INSCRITO'),
(17, 23, 1, '2026-01-31 13:25:00', 'INSCRITO'),
(18, 24, 1, '2026-01-31 19:00:00', 'INSCRITO'),
(19, 25, 1, '2026-02-01 11:30:00', 'INSCRITO'),
(20, 26, 1, '2026-02-01 15:45:00', 'INSCRITO'),
(21, 27, 1, '2026-02-02 12:15:00', 'INSCRITO'),
(22, 28, 1, '2026-02-02 18:20:00', 'INSCRITO'),
(23, 29, 1, '2026-02-03 13:50:00', 'INSCRITO'),
(24, 30, 1, '2026-02-03 17:30:00', 'INSCRITO'),
(124, 7, 2, '2026-01-26 13:45:00', 'INSCRITO'),
(125, 9, 2, '2026-01-26 17:20:00', 'INSCRITO'),
(126, 11, 2, '2026-01-27 11:15:00', 'INSCRITO'),
(127, 13, 2, '2026-01-27 14:00:00', 'INSCRITO'),
(128, 15, 2, '2026-01-27 18:30:00', 'INSCRITO'),
(129, 17, 2, '2026-01-28 12:40:00', 'INSCRITO'),
(130, 19, 2, '2026-01-28 16:25:00', 'INSCRITO'),
(131, 21, 2, '2026-01-29 13:10:00', 'INSCRITO'),
(132, 34, 2, '2026-01-29 17:50:00', 'INSCRITO'),
(133, 8, 2, '2026-01-30 14:45:00', 'INSCRITO'),
(134, 10, 2, '2026-01-31 12:20:00', 'INSCRITO'),
(135, 12, 2, '2026-01-31 18:10:00', 'INSCRITO'),
(136, 14, 2, '2026-02-01 13:00:00', 'INSCRITO'),
(137, 16, 2, '2026-02-01 16:35:00', 'INSCRITO'),
(138, 18, 2, '2026-02-02 11:50:00', 'INSCRITO'),
(139, 20, 2, '2026-02-02 17:15:00', 'INSCRITO'),
(140, 22, 2, '2026-02-03 12:30:00', 'INSCRITO'),
(141, 23, 2, '2026-02-03 15:20:00', 'INSCRITO'),
(142, 24, 2, '2026-02-04 13:40:00', 'INSCRITO'),
(143, 25, 2, '2026-02-04 18:00:00', 'INSCRITO'),
(144, 26, 2, '2026-02-05 11:20:00', 'INSCRITO'),
(145, 27, 2, '2026-02-05 14:50:00', 'INSCRITO'),
(146, 28, 2, '2026-02-06 12:10:00', 'INSCRITO'),
(147, 29, 2, '2026-02-06 17:30:00', 'INSCRITO'),
(148, 30, 2, '2026-02-07 13:25:00', 'INSCRITO'),
(149, 4, 3, '2026-01-19 13:30:00', 'CANCELADO'),
(150, 35, 3, '2026-01-19 14:45:00', 'INSCRITO'),
(151, 7, 3, '2026-01-20 11:30:00', 'INSCRITO'),
(152, 8, 3, '2026-01-20 12:45:00', 'INSCRITO'),
(153, 9, 3, '2026-01-20 14:15:00', 'INSCRITO'),
(154, 10, 3, '2026-01-20 16:50:00', 'INSCRITO'),
(155, 11, 3, '2026-01-21 11:00:00', 'INSCRITO'),
(156, 12, 3, '2026-01-21 13:20:00', 'INSCRITO'),
(157, 13, 3, '2026-01-21 15:40:00', 'INSCRITO'),
(158, 14, 3, '2026-01-21 18:10:00', 'INSCRITO'),
(159, 15, 3, '2026-01-22 12:30:00', 'INSCRITO'),
(160, 16, 3, '2026-01-22 14:00:00', 'INSCRITO'),
(161, 17, 3, '2026-01-22 16:25:00', 'INSCRITO'),
(162, 18, 3, '2026-01-22 19:00:00', 'INSCRITO'),
(163, 19, 3, '2026-01-23 11:45:00', 'INSCRITO'),
(164, 20, 3, '2026-01-23 13:15:00', 'INSCRITO'),
(165, 21, 3, '2026-01-23 15:30:00', 'INSCRITO'),
(166, 22, 3, '2026-01-23 17:50:00', 'INSCRITO'),
(167, 24, 4, '2026-01-23 14:30:00', 'INSCRITO'),
(168, 25, 4, '2026-01-23 17:20:00', 'INSCRITO'),
(169, 26, 4, '2026-01-24 11:40:00', 'INSCRITO'),
(170, 7, 4, '2026-01-24 13:15:00', 'INSCRITO'),
(171, 8, 4, '2026-01-24 16:00:00', 'INSCRITO'),
(172, 9, 4, '2026-01-25 12:25:00', 'INSCRITO'),
(173, 10, 4, '2026-01-25 14:50:00', 'INSCRITO'),
(174, 11, 4, '2026-01-25 18:10:00', 'INSCRITO'),
(175, 12, 4, '2026-01-26 11:30:00', 'INSCRITO'),
(176, 13, 4, '2026-01-26 15:00:00', 'INSCRITO'),
(177, 14, 4, '2026-01-27 12:45:00', 'INSCRITO'),
(178, 15, 4, '2026-01-27 16:20:00', 'INSCRITO'),
(179, 16, 4, '2026-01-28 13:10:00', 'INSCRITO'),
(180, 17, 4, '2026-01-28 17:35:00', 'INSCRITO'),
(181, 18, 4, '2026-01-29 11:55:00', 'INSCRITO'),
(182, 19, 4, '2026-01-29 14:40:00', 'INSCRITO'),
(183, 20, 4, '2026-01-30 12:15:00', 'INSCRITO'),
(184, 10, 5, '2026-02-02 12:00:00', 'INSCRITO'),
(185, 7, 5, '2026-02-02 14:30:00', 'INSCRITO'),
(186, 9, 5, '2026-02-02 17:45:00', 'INSCRITO'),
(187, 11, 5, '2026-02-03 11:20:00', 'INSCRITO'),
(188, 13, 5, '2026-02-03 13:50:00', 'INSCRITO'),
(189, 15, 5, '2026-02-03 16:15:00', 'INSCRITO'),
(190, 17, 5, '2026-02-04 12:40:00', 'INSCRITO'),
(191, 19, 5, '2026-02-04 15:10:00', 'INSCRITO'),
(192, 21, 5, '2026-02-04 18:30:00', 'INSCRITO'),
(193, 23, 5, '2026-02-05 11:50:00', 'INSCRITO'),
(194, 25, 5, '2026-02-05 14:20:00', 'INSCRITO'),
(195, 27, 5, '2026-02-05 17:00:00', 'INSCRITO'),
(196, 29, 5, '2026-02-06 12:25:00', 'INSCRITO'),
(211, 34, 6, '2026-02-06 12:30:00', 'INSCRITO'),
(212, 31, 6, '2026-02-06 14:00:00', 'INSCRITO'),
(213, 32, 6, '2026-02-06 16:45:00', 'INSCRITO'),
(214, 10, 6, '2026-02-07 11:20:00', 'INSCRITO'),
(215, 12, 6, '2026-02-07 13:50:00', 'INSCRITO'),
(216, 14, 6, '2026-02-07 15:30:00', 'INSCRITO'),
(217, 16, 6, '2026-02-07 18:10:00', 'INSCRITO'),
(218, 18, 6, '2026-02-08 12:00:00', 'INSCRITO'),
(219, 20, 6, '2026-02-08 14:40:00', 'INSCRITO'),
(220, 22, 6, '2026-02-08 17:20:00', 'INSCRITO'),
(221, 24, 6, '2026-02-09 11:35:00', 'INSCRITO'),
(222, 26, 6, '2026-02-09 13:15:00', 'INSCRITO'),
(223, 28, 6, '2026-02-09 16:50:00', 'INSCRITO'),
(224, 30, 6, '2026-02-09 19:25:00', 'INSCRITO'),
(225, 24, 7, '2026-02-11 11:15:00', 'INSCRITO'),
(226, 25, 7, '2026-02-11 11:30:00', 'INSCRITO'),
(227, 26, 7, '2026-02-11 11:45:00', 'INSCRITO'),
(228, 7, 7, '2026-02-11 12:00:00', 'INSCRITO'),
(229, 8, 7, '2026-02-11 12:15:00', 'INSCRITO'),
(230, 9, 7, '2026-02-11 12:30:00', 'INSCRITO'),
(231, 10, 7, '2026-02-11 12:45:00', 'INSCRITO'),
(232, 11, 7, '2026-02-11 13:00:00', 'INSCRITO'),
(233, 12, 7, '2026-02-11 13:15:00', 'INSCRITO'),
(234, 13, 7, '2026-02-11 13:30:00', 'INSCRITO'),
(235, 14, 7, '2026-02-11 13:45:00', 'INSCRITO'),
(236, 15, 7, '2026-02-11 14:00:00', 'INSCRITO'),
(237, 16, 7, '2026-02-11 14:15:00', 'INSCRITO'),
(238, 17, 7, '2026-02-11 14:30:00', 'INSCRITO'),
(239, 18, 7, '2026-02-11 14:45:00', 'INSCRITO'),
(240, 19, 7, '2026-02-11 15:00:00', 'INSCRITO'),
(241, 20, 7, '2026-02-11 15:15:00', 'INSCRITO'),
(242, 21, 7, '2026-02-11 15:30:00', 'INSCRITO'),
(243, 22, 7, '2026-02-11 15:45:00', 'INSCRITO'),
(244, 34, 11, '2026-02-26 12:15:00', 'INSCRITO'),
(245, 32, 11, '2026-02-26 13:00:00', 'INSCRITO'),
(246, 31, 11, '2026-02-26 13:45:00', 'INSCRITO'),
(247, 7, 11, '2026-02-26 14:30:00', 'INSCRITO'),
(248, 8, 11, '2026-02-26 15:15:00', 'INSCRITO'),
(249, 9, 11, '2026-02-26 16:00:00', 'INSCRITO'),
(250, 10, 11, '2026-02-26 16:45:00', 'INSCRITO'),
(251, 11, 11, '2026-02-26 17:30:00', 'INSCRITO'),
(252, 12, 11, '2026-02-26 18:15:00', 'INSCRITO'),
(253, 13, 11, '2026-02-27 11:00:00', 'INSCRITO'),
(254, 14, 11, '2026-02-27 12:00:00', 'INSCRITO'),
(255, 15, 11, '2026-02-27 13:00:00', 'INSCRITO'),
(256, 16, 11, '2026-02-27 14:00:00', 'INSCRITO'),
(257, 17, 11, '2026-02-27 15:00:00', 'INSCRITO'),
(258, 18, 11, '2026-02-27 16:00:00', 'INSCRITO'),
(259, 19, 11, '2026-02-27 17:00:00', 'INSCRITO'),
(260, 20, 11, '2026-02-27 18:00:00', 'INSCRITO'),
(261, 8, 14, '2026-03-09 12:30:00', 'INSCRITO'),
(262, 7, 14, '2026-03-09 14:00:00', 'INSCRITO'),
(263, 9, 14, '2026-03-09 16:15:00', 'INSCRITO'),
(264, 11, 14, '2026-03-09 17:45:00', 'INSCRITO'),
(265, 13, 14, '2026-03-09 19:20:00', 'INSCRITO'),
(266, 15, 14, '2026-03-10 11:30:00', 'INSCRITO'),
(267, 17, 14, '2026-03-10 13:00:00', 'INSCRITO'),
(268, 23, 17, '2026-03-21 12:30:00', 'INSCRITO'),
(269, 10, 17, '2026-03-21 13:00:00', 'INSCRITO'),
(270, 14, 17, '2026-03-21 13:30:00', 'INSCRITO'),
(271, 7, 17, '2026-03-21 14:00:00', 'INSCRITO'),
(272, 8, 17, '2026-03-21 14:30:00', 'INSCRITO'),
(273, 22, 20, '2026-04-06 11:00:00', 'INSCRITO'),
(274, 21, 20, '2026-04-06 12:00:00', 'INSCRITO'),
(275, 8, 20, '2026-04-06 13:00:00', 'INSCRITO'),
(276, 10, 20, '2026-04-06 14:00:00', 'INSCRITO'),
(277, 12, 20, '2026-04-06 15:00:00', 'INSCRITO'),
(278, 14, 20, '2026-04-06 16:00:00', 'INSCRITO'),
(279, 16, 20, '2026-04-06 17:00:00', 'INSCRITO'),
(280, 18, 20, '2026-04-06 18:00:00', 'INSCRITO'),
(281, 20, 20, '2026-04-06 19:00:00', 'INSCRITO'),
(282, 8, 23, '2026-04-21 12:00:00', 'INSCRITO'),
(283, 7, 23, '2026-04-21 13:00:00', 'INSCRITO'),
(284, 9, 23, '2026-04-21 14:00:00', 'INSCRITO'),
(285, 11, 23, '2026-04-21 15:00:00', 'INSCRITO'),
(286, 13, 23, '2026-04-21 16:00:00', 'INSCRITO'),
(287, 15, 23, '2026-04-21 17:00:00', 'INSCRITO'),
(288, 4, 25, '2026-05-02 13:00:00', 'INSCRITO'),
(289, 11, 25, '2026-05-02 14:00:00', 'INSCRITO'),
(290, 12, 25, '2026-05-02 15:00:00', 'INSCRITO'),
(291, 7, 25, '2026-05-02 16:00:00', 'INSCRITO'),
(292, 8, 25, '2026-05-02 17:00:00', 'INSCRITO'),
(293, 9, 25, '2026-05-02 18:00:00', 'INSCRITO'),
(294, 10, 25, '2026-05-02 19:00:00', 'INSCRITO'),
(295, 35, 1, '2026-02-10 17:52:42', 'CANCELADO'),
(299, 2, 1, '2026-02-11 15:26:55', 'CANCELADO'),
(300, 4, 1, '2026-02-11 20:41:44', 'CANCELADO'),
(301, 4, 2, '2026-02-11 20:41:52', 'CANCELADO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('ADM','USER') NOT NULL DEFAULT 'USER',
  `ativo` tinyint(1) DEFAULT 1,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `ativo`, `criado_em`) VALUES
(2, 'Paulao de Dados Silva', 'paulo@dados.com.br', '$2y$10$b2mmA0937ToEu9C4cqmPjeXbhyNuXVJ.dvjRqivDv5FjXWRfQZ42S', 'USER', 1, '2026-02-06 12:03:55'),
(4, 'Pedrão Agiota', 'pagiota@gmail.com', '$2y$10$Qfc4aBjx2HtbHinQjo7NtORZ5pBDPlI36B.xUVGDz0UmVxy5UEg7u', 'ADM', 1, '2026-02-06 12:15:19'),
(7, 'João Pedro Oliveira', 'joao.oliveira@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-20 13:15:00'),
(8, 'Maria Eduarda Souza', 'maria.souza@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-21 14:20:00'),
(9, 'Lucas Gabriel Costa', 'lucas.costa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-22 17:30:00'),
(10, 'Gabriela Fernandes Lima', 'gabriela.lima@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-23 12:45:00'),
(11, 'Rafael Henrique Alves', 'rafael.alves@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-24 19:00:00'),
(12, 'Beatriz Rodrigues Pereira', 'beatriz.pereira@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-25 16:15:00'),
(13, 'Felipe Augusto Santos', 'felipe.santos@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-26 13:30:00'),
(14, 'Larissa Vitória Martins', 'larissa.martins@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-27 18:45:00'),
(15, 'Bruno César Ribeiro', 'bruno.ribeiro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-28 14:00:00'),
(16, 'Camila Aparecida Gomes', 'camila.gomes@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-08-29 17:20:00'),
(17, 'Thiago Luiz Nascimento', 'thiago.nascimento@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-01 12:30:00'),
(18, 'Juliana Cristina Moreira', 'juliana.moreira@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-02 19:15:00'),
(19, 'Diego Fernando Silva', 'diego.silva@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-03 13:00:00'),
(20, 'Amanda Caroline Barbosa', 'amanda.barbosa@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-04 16:40:00'),
(21, 'Vitor Hugo Cardoso', 'vitor.cardoso@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-05 18:20:00'),
(22, 'Isabela Cristine Araújo', 'isabela.araujo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-06 14:50:00'),
(23, 'Guilherme Soares Castro', 'guilherme.castro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-07 17:10:00'),
(24, 'Fernanda Luiza Ramos', 'fernanda.ramos@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-08 12:25:00'),
(25, 'Matheus Henrique Dias', 'matheus.dias@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-09 19:35:00'),
(26, 'Bianca Sofia Teixeira', 'bianca.teixeira@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-09-10 13:40:00'),
(27, 'Dr. Roberto Mendes', 'roberto.mendes@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-10 11:00:00'),
(28, 'Dra. Patricia Freitas', 'patricia.freitas@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-11 12:15:00'),
(29, 'Prof. Eduardo Batista', 'eduardo.batista@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-12 13:30:00'),
(30, 'Profa. Márcia Azevedo', 'marcia.azevedo@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-13 14:45:00'),
(31, 'Dr. Fernando Carvalho', 'fernando.carvalho@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-14 16:00:00'),
(32, 'Dra. Silvia Montenegro', 'silvia.montenegro@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-02-15 17:15:00'),
(33, 'Pedro Henrique Coordenador', 'pedro.coord@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-03-01 11:30:00'),
(34, 'Renata Silva Secretaria', 'renata.secretaria@universidade.edu.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '', 1, '2025-03-02 12:00:00'),
(35, 'Marcos teste', 'marcos@gmail.com', '$2y$10$LS52fP85ASHz3UAo1NeAYenhjHNeVO0v1wNPsnCp5eKGtnTs/x7Kq', 'USER', 1, '2026-02-10 16:56:46'),
(36, 'Marcao Gente Boa', 'marcos@gente.boa.com', '$2y$10$ZOoxrxDlkQE5ebt1lKDFMOHXE91rRmV1KAPTcbzEPuscdI3xFS0g2', 'USER', 1, '2026-02-11 15:30:06');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criado_por` (`criado_por`);

--
-- Índices de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`evento_id`),
  ADD KEY `evento_id` (`evento_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`criado_por`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD CONSTRAINT `inscricoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscricoes_ibfk_2` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
