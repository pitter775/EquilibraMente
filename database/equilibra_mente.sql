-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/12/2024 às 21:36
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `equilibra_mente`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `conveniencias`
--

CREATE TABLE `conveniencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `conveniencias`
--

INSERT INTO `conveniencias` (`id`, `nome`, `icone`, `created_at`, `updated_at`) VALUES
(1, 'Espaço de convivência', 'fa-solid fa-users', NULL, NULL),
(2, 'Opções de transporte', 'fa-solid fa-bus', NULL, NULL),
(3, 'Área de Espera', 'fa-solid fa-chair', NULL, NULL),
(4, 'Café', 'fa-solid fa-coffee', NULL, NULL),
(5, 'Wifi', 'fa-solid fa-wifi', NULL, NULL),
(6, 'Localização no centro', 'fa-solid fa-map-marker-alt', NULL, NULL),
(7, 'Equipamentos de ponta', 'fa-solid fa-tools', NULL, NULL),
(8, 'Ambiente elegante', 'fa-solid fa-landmark', NULL, NULL),
(9, 'Ar condicionado', 'fa-solid fa-fan', NULL, NULL),
(10, 'Estacionamento', 'fa-solid fa-parking', NULL, NULL),
(11, 'Acessibilidade', 'fa-solid fa-wheelchair', NULL, NULL),
(12, 'Recepção', 'fa-solid fa-concierge-bell', NULL, NULL),
(13, 'Segurança 24h', 'fa-solid fa-shield-alt', NULL, NULL),
(14, 'Sala de reuniões', 'fa-solid fa-door-closed', NULL, NULL),
(15, 'Videoconferência', 'fa-solid fa-video', NULL, NULL),
(16, 'Projetor multimídia', 'fa-solid fa-project-diagram', NULL, NULL),
(17, 'Impressora', 'fa-solid fa-print', NULL, NULL),
(18, 'Quadro branco', 'fa-solid fa-chalkboard', NULL, NULL),
(19, 'Cadeiras ergonômicas', 'fa-solid fa-chair', NULL, NULL),
(20, 'Serviço de limpeza', 'fa-solid fa-broom', NULL, NULL),
(21, 'Janelas com vista', 'fa-solid fa-window-maximize', NULL, NULL),
(22, 'Iluminação natural', 'fa-solid fa-lightbulb', NULL, NULL),
(23, 'Som ambiente', 'fa-solid fa-volume-up', NULL, NULL),
(24, 'Bicicletário', 'fa-solid fa-bicycle', NULL, NULL),
(25, 'Espaço para eventos', 'fa-solid fa-calendar-alt', NULL, NULL),
(26, 'Cozinha compartilhada', 'fa-solid fa-utensils', NULL, NULL),
(27, 'Telefone fixo', 'fa-solid fa-phone', NULL, NULL),
(28, 'Monitor', 'fa-solid fa-tv', NULL, NULL),
(29, 'Rede cabeada', 'fa-solid fa-network-wired', NULL, NULL),
(30, 'Chave eletrônica', 'fa-solid fa-key', NULL, NULL),
(31, 'Espaço para coworking', 'fa-solid fa-briefcase', NULL, NULL),
(32, 'Alto padrão de acabamento', 'fa-solid fa-brush', NULL, NULL),
(33, 'Atendimento personalizado', 'fa-solid fa-user-tie', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disponibilidades`
--

CREATE TABLE `disponibilidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enderecavel_type` varchar(255) NOT NULL,
  `enderecavel_id` bigint(20) UNSIGNED NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `enderecavel_type`, `enderecavel_id`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Sala', 1, 'Rua Elisabetta Lips', '304', 'sala 1522', 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763190', '2024-11-25 02:52:23', '2024-11-25 02:52:23'),
(2, 'App\\Models\\User', 2, 'Rua Elisabetta Lips', '304', NULL, 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763-190', '2024-11-25 16:45:59', '2024-11-25 16:45:59'),
(3, 'App\\Models\\Sala', 2, 'Rua Elisabetta Lips', '304', 'sala 1522', 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763-190', '2024-11-25 19:35:50', '2024-11-25 19:35:50'),
(4, 'App\\Models\\User', 3, 'Rua Elisabetta Lips', '304', NULL, 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763-190', '2024-12-01 19:00:33', '2024-12-01 19:00:33'),
(5, 'App\\Models\\User', 5, 'Rua Elisabetta Lips', '304', NULL, 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763-190', '2024-12-01 23:06:25', '2024-12-01 23:06:25'),
(6, 'App\\Models\\User', 6, 'Rua Elisabetta Lips', '304', NULL, 'Jardim Bontempo', 'Taboão da Serra', 'SP', '06763-190', '2024-12-01 23:26:09', '2024-12-01 23:26:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `faturas`
--

CREATE TABLE `faturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transacao_id` bigint(20) UNSIGNED NOT NULL,
  `numero_fatura` varchar(255) NOT NULL,
  `data_emissao` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens_salas`
--

CREATE TABLE `imagens_salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `imagens_salas`
--

INSERT INTO `imagens_salas` (`id`, `sala_id`, `path`, `principal`, `created_at`, `updated_at`) VALUES
(2, 1, 'salas/CpG5wwLpF0wTbsO3qR7IQkSDjTVaY8jhsa5mPOze.jpg', 0, '2024-11-25 02:52:24', '2024-11-27 17:54:28'),
(3, 1, 'salas/1HeQMpk2T4wGoi1AdWHT5xJC16gtx4KEmhNzW6cZ.jpg', 1, '2024-11-25 02:52:24', '2024-11-27 17:54:28'),
(4, 1, 'salas/I7pzXLqiw6p0Fj41TdqF1nEpRXQIiawLJXisdVGm.jpg', 0, '2024-11-25 02:52:24', '2024-11-27 17:54:28'),
(6, 2, 'salas/TiabqCPDcjaZE4PMPfE33s23unLW1RXUcyNPN0cL.jpg', 0, '2024-11-25 19:35:51', '2024-11-27 17:54:17'),
(11, 1, 'salas/XgKQKcNRSVixsM6YWcVPkHuu07kHKQ2o8ktLDZ4a.jpg', 0, '2024-11-25 22:15:54', '2024-11-27 17:54:28'),
(12, 2, 'salas/NJsTIfaYv7aohsn4KoNIBWAQOHx1b2bXNJS2EgZb.jpg', 0, '2024-11-27 17:07:58', '2024-11-27 17:54:17'),
(13, 2, 'salas/NrQ6xNu01A3AiTxmOlZfgKfCDNxpe9jiTWizbFsD.jpg', 1, '2024-11-27 17:07:58', '2024-11-27 17:54:17'),
(14, 2, 'salas/aOCETIpSKE9LWSr4dByVOIWlc2Zgqtaknzh1VO7R.jpg', 0, '2024-11-27 17:07:58', '2024-11-27 17:54:17'),
(15, 2, 'salas/4bLALxIW4eRTgH1jKB9WYlIDjvvSpYK3EYXBKylZ.jpg', 0, '2024-11-27 17:07:58', '2024-11-27 17:54:17'),
(16, 2, 'salas/fW99Wl7WDIl9Ibyj3cRHTsYhZUNJh2mIo6kJRM2R.jpg', 0, '2024-11-27 17:07:58', '2024-11-27 17:54:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_09_30_022034_criar_enderecos_tabela', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_09_30_022043_criar_salas_tabela', 1),
(7, '2024_09_30_022048_criar_disponibilidades_tabela', 1),
(8, '2024_09_30_022055_criar_reservas_tabela', 1),
(9, '2024_09_30_031948_criar_transacoes_tabela', 1),
(10, '2024_09_30_032111_criar_faturas_tabela', 1),
(11, '2024_09_30_032123_criar_notas_fiscais_tabela', 1),
(12, '2024_10_20_184819_create_imagens_salas_table', 1),
(13, '2024_11_22_171953_create_conveniencias_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas_fiscais`
--

CREATE TABLE `notas_fiscais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transacao_id` bigint(20) UNSIGNED NOT NULL,
  `numero_nota` varchar(255) NOT NULL,
  `chave_acesso` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendente',
  `data_emissao` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `data_reserva` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ativa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id`, `usuario_id`, `sala_id`, `data_reserva`, `hora_inicio`, `hora_fim`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2024-11-28', '09:00:00', '10:00:00', 'ativa', '2024-11-27 18:47:45', '2024-11-27 18:47:45'),
(2, 2, 1, '2024-11-28', '10:00:00', '11:00:00', 'ativa', '2024-11-27 18:47:45', '2024-11-27 18:47:45'),
(3, 2, 1, '2024-11-28', '14:00:00', '15:00:00', 'ativa', '2024-11-27 18:47:45', '2024-11-27 18:47:45'),
(4, 2, 1, '2024-11-27', '08:00:00', '09:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(5, 2, 1, '2024-11-27', '09:00:00', '10:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(6, 2, 1, '2024-11-27', '13:00:00', '14:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(7, 2, 1, '2024-11-27', '14:00:00', '15:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(8, 2, 1, '2024-11-27', '10:00:00', '11:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(9, 2, 1, '2024-11-27', '11:00:00', '12:00:00', 'ativa', '2024-11-27 20:13:14', '2024-11-27 20:13:14'),
(10, 2, 1, '2024-11-29', '10:00:00', '11:00:00', 'ativa', '2024-11-27 20:15:47', '2024-11-27 20:15:47'),
(11, 2, 1, '2024-11-29', '14:00:00', '15:00:00', 'ativa', '2024-11-27 20:15:47', '2024-11-27 20:15:47'),
(12, 2, 1, '2024-11-30', '09:00:00', '10:00:00', 'ativa', '2024-11-27 20:36:42', '2024-11-27 20:36:42'),
(13, 2, 1, '2024-11-30', '13:00:00', '14:00:00', 'ativa', '2024-11-27 20:36:42', '2024-11-27 20:36:42'),
(14, 2, 1, '2024-11-30', '14:00:00', '15:00:00', 'ativa', '2024-11-27 20:36:42', '2024-11-27 20:36:42'),
(15, 3, 2, '2024-12-03', '09:00:00', '10:00:00', 'ativa', '2024-12-01 23:30:11', '2024-12-01 23:30:11'),
(16, 3, 2, '2024-12-03', '13:00:00', '14:00:00', 'ativa', '2024-12-01 23:30:11', '2024-12-01 23:30:11'),
(17, 3, 2, '2024-12-03', '14:00:00', '15:00:00', 'ativa', '2024-12-01 23:30:11', '2024-12-01 23:30:11'),
(18, 3, 1, '2024-12-01', '08:00:00', '09:00:00', 'ativa', '2024-12-01 23:35:48', '2024-12-01 23:35:48'),
(19, 3, 1, '2024-12-01', '17:00:00', '18:00:00', 'ativa', '2024-12-01 23:35:48', '2024-12-01 23:35:48'),
(20, 1, 1, '2024-12-02', '09:00:00', '10:00:00', 'ativa', '2024-12-01 20:58:15', '2024-12-01 20:58:15'),
(21, 1, 1, '2024-12-02', '13:00:00', '14:00:00', 'ativa', '2024-12-01 20:58:15', '2024-12-01 20:58:15'),
(22, 2, 1, '2024-12-12', '09:00:00', '10:00:00', 'ativa', '2024-12-01 21:18:28', '2024-12-01 21:18:28'),
(23, 2, 1, '2024-12-12', '13:00:00', '14:00:00', 'ativa', '2024-12-01 21:18:28', '2024-12-01 21:18:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'disponivel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `salas`
--

INSERT INTO `salas` (`id`, `nome`, `descricao`, `valor`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sala de Reunião Conforto', '<p>Bem-vindo(a) um espaço projetado para garantir conforto, praticidade e profissionalismo em todas as suas reuniões e eventos. Com capacidade para até 10 pessoas, esta sala é ideal para apresentações, entrevistas, sessões de brainstorming e encontros corporativos.</p><p><br></p><h3>Características do Ambiente</h3><ul><li>Conforto e Estilo: A sala conta com cadeiras ergonômicas e uma mesa de design moderno, criando um ambiente elegante e acolhedor.</li><li>Equipamentos de Ponta: Equipada com projetor de alta definição, lousa interativa e sistema de som surround para garantir apresentações e discussões de alta qualidade.</li><li>Conexão Wi-Fi: Internet rápida e estável, disponível para você e seus convidados.</li><li>Controle de Luz e Climatização: Iluminação ajustável e ar-condicionado independente para criar o ambiente perfeito para suas reuniões.</li></ul><p><br></p><h3>Na Área de Espera, Oferecemos:</h3><ul><li>Café: Com custo adicional de R$ 4,00 por cápsula (ou você pode trazer suas próprias cápsulas)</li><li>Água, Copos e Guardanapos</li><li>Cafeteira, Açúcar e Adoçantes</li></ul><h3><br></h3><h3>Áreas Comuns</h3><p>Além das salas, disponibilizamos áreas comuns, incluindo recepção e sala de espera, que promovem um ambiente colaborativo e acolhedor. Nossa missão é oferecer um espaço onde profissionais de diversas áreas possam realizar suas atividades com excelência, segurança e conforto.</p><p>Localizada no coração da cidade, com fácil acesso a transporte público e opções de estacionamento, nossa sala oferece praticidade para você e seus clientes.</p>', 135.00, 'disponivel', '2024-11-25 02:52:23', '2024-11-25 19:31:39'),
(2, 'Sala Undeground GTI', '<p>Bem-vindo(a) um espaço projetado para garantir conforto, praticidade e profissionalismo em todas as suas reuniões e eventos. Com capacidade para até 10 pessoas, esta sala é ideal para apresentações, entrevistas, sessões de brainstorming e encontros corporativos.</p><p><br></p><h3>Características do Ambiente</h3><ul><li>Conforto e Estilo: A sala conta com cadeiras ergonômicas e uma mesa de design moderno, criando um ambiente elegante e acolhedor.</li><li>Equipamentos de Ponta: Equipada com projetor de alta definição, lousa interativa e sistema de som surround para garantir apresentações e discussões de alta qualidade.</li><li>Conexão Wi-Fi: Internet rápida e estável, disponível para você e seus convidados.</li><li>Controle de Luz e Climatização: Iluminação ajustável e ar-condicionado independente para criar o ambiente perfeito para suas reuniões.</li></ul><p><br></p><h3>Na Área de Espera, Oferecemos:</h3><ul><li>Café: Com custo adicional de R$ 4,00 por cápsula (ou você pode trazer suas próprias cápsulas)</li><li>Água, Copos e Guardanapos</li><li>Cafeteira, Açúcar e Adoçantes</li></ul><h3><br></h3><h3>Áreas Comuns</h3><p>Além das salas, disponibilizamos áreas comuns, incluindo recepção e sala de espera, que promovem um ambiente colaborativo e acolhedor. Nossa missão é oferecer um espaço onde profissionais de diversas áreas possam realizar suas atividades com excelência, segurança e conforto.</p><p>Localizada no coração da cidade, com fácil acesso a transporte público e opções de estacionamento, nossa sala oferece praticidade para você e seus clientes.</p>', 183.00, 'disponivel', '2024-11-25 19:35:50', '2024-11-25 19:35:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala_conveniencias`
--

CREATE TABLE `sala_conveniencias` (
  `sala_id` bigint(20) UNSIGNED NOT NULL,
  `conveniencia_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sala_conveniencias`
--

INSERT INTO `sala_conveniencias` (`sala_id`, `conveniencia_id`) VALUES
(1, 9),
(1, 14),
(1, 19),
(1, 24),
(1, 28),
(1, 1),
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 13),
(1, 15),
(1, 16),
(1, 21),
(1, 22),
(1, 32),
(1, 11),
(1, 31),
(2, 9),
(2, 10),
(2, 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `transacoes`
--

CREATE TABLE `transacoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `reserva_id` bigint(20) UNSIGNED NOT NULL,
  `metodo_pagamento` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL DEFAULT 'cliente',
  `cpf` varchar(255) DEFAULT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `registro_profissional` varchar(255) DEFAULT NULL,
  `tipo_registro_profissional` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `endereco_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'ativo',
  `cadastro_completo` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `tipo_usuario`, `cpf`, `sexo`, `idade`, `registro_profissional`, `tipo_registro_profissional`, `photo`, `telefone`, `endereco_id`, `status`, `cadastro_completo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Teste', 'pitter775@gmail.com2', NULL, '$2y$12$1VGI0r/9xeXYls55RlDH6uQt0glYgtzFaMaFwwIQla/A/ZtFGlGF2', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', 0, NULL, '2024-11-25 02:51:44', '2024-11-25 02:51:44'),
(2, 'Pitter Rocha', 'pitter775@gmail.com', NULL, '$2y$12$XI0zXZMI5T1mFzfoCnT4eudxn7NCFVXpYjLZIpxObvajRZlEnhuqK', 'cliente', '391.626.338-21', 'masculino', 20, '4564565464564', 'CRM', 'https://lh3.googleusercontent.com/a/ACg8ocL6e13sdCuzbnnHH-O9h38wBviaD6zOh-bNdRupzcBhoka66K75cQ=s96-c', '(11) 94950-6267', NULL, 'ativo', 1, NULL, '2024-11-25 16:45:27', '2024-11-25 16:46:07'),
(3, 'Equilibra Mente', 'equilibramente22@gmail.com', NULL, '$2y$12$Gn.sF/tjIOExUr.J3nyrje.x7sI78IsLuORM71IpIji3l723QfTdC', 'cliente', '391.626.338-21', 'feminino', 21, '4564565464564', 'CRM', 'https://lh3.googleusercontent.com/a/ACg8ocI3-Nhef8ikRGpGQvKmONHVKuvr-XwqX04BDeDq53kKYwjw2Q=s96-c', '(11) 94950-6267', NULL, 'ativo', 1, NULL, '2024-12-01 18:59:25', '2024-12-01 19:00:33'),
(5, 'Pi4444444444tter Rocha Bico', 'pitter7475@gmail.com', NULL, '$2y$12$TCC5klhR7HZMsqw6cmx9EOC3OGqeIXFHrh8tJTLZhxfYngven.ZwK', 'cliente', '391.626.338-21', 'masculino', 444, '4564565464564', NULL, NULL, '(11) 94950-6267', NULL, 'ativo', 1, NULL, '2024-12-01 23:06:25', '2024-12-01 23:06:25'),
(6, 'Pitter Rocha Bico', 'pittetttttr775@gmail.com', NULL, '$2y$12$oePRR0m8LulBmud0JalSSOZWDyxNXoQRuptL5wkHjNsQWZvTyAaxa', 'cliente', '391.626.338-21', 'masculino', 44, '4564565464564', NULL, NULL, '(11) 94950-6267', NULL, 'ativo', 1, NULL, '2024-12-01 23:26:09', '2024-12-01 23:26:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `conveniencias`
--
ALTER TABLE `conveniencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `disponibilidades`
--
ALTER TABLE `disponibilidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disponibilidades_sala_id_foreign` (`sala_id`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enderecos_enderecavel_type_enderecavel_id_index` (`enderecavel_type`,`enderecavel_id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `faturas`
--
ALTER TABLE `faturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faturas_numero_fatura_unique` (`numero_fatura`),
  ADD KEY `faturas_transacao_id_foreign` (`transacao_id`);

--
-- Índices de tabela `imagens_salas`
--
ALTER TABLE `imagens_salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagens_salas_sala_id_foreign` (`sala_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notas_fiscais_numero_nota_unique` (`numero_nota`),
  ADD UNIQUE KEY `notas_fiscais_chave_acesso_unique` (`chave_acesso`),
  ADD KEY `notas_fiscais_transacao_id_foreign` (`transacao_id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reserva_unica` (`sala_id`,`data_reserva`,`hora_inicio`,`hora_fim`),
  ADD KEY `reservas_usuario_id_foreign` (`usuario_id`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sala_conveniencias`
--
ALTER TABLE `sala_conveniencias`
  ADD KEY `sala_conveniencias_sala_id_foreign` (`sala_id`),
  ADD KEY `sala_conveniencias_conveniencia_id_foreign` (`conveniencia_id`);

--
-- Índices de tabela `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transacoes_usuario_id_foreign` (`usuario_id`),
  ADD KEY `transacoes_reserva_id_foreign` (`reserva_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_endereco_id_foreign` (`endereco_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conveniencias`
--
ALTER TABLE `conveniencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `disponibilidades`
--
ALTER TABLE `disponibilidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `faturas`
--
ALTER TABLE `faturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagens_salas`
--
ALTER TABLE `imagens_salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `disponibilidades`
--
ALTER TABLE `disponibilidades`
  ADD CONSTRAINT `disponibilidades_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`);

--
-- Restrições para tabelas `faturas`
--
ALTER TABLE `faturas`
  ADD CONSTRAINT `faturas_transacao_id_foreign` FOREIGN KEY (`transacao_id`) REFERENCES `transacoes` (`id`);

--
-- Restrições para tabelas `imagens_salas`
--
ALTER TABLE `imagens_salas`
  ADD CONSTRAINT `imagens_salas_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  ADD CONSTRAINT `notas_fiscais_transacao_id_foreign` FOREIGN KEY (`transacao_id`) REFERENCES `transacoes` (`id`);

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`),
  ADD CONSTRAINT `reservas_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `sala_conveniencias`
--
ALTER TABLE `sala_conveniencias`
  ADD CONSTRAINT `sala_conveniencias_conveniencia_id_foreign` FOREIGN KEY (`conveniencia_id`) REFERENCES `conveniencias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sala_conveniencias_sala_id_foreign` FOREIGN KEY (`sala_id`) REFERENCES `salas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `transacoes_reserva_id_foreign` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`),
  ADD CONSTRAINT `transacoes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_endereco_id_foreign` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
