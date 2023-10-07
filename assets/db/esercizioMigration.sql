-- Comandi per creare il database "esercizio_edusogno"
CREATE DATABASE esercizio_edusogno;

-- Utilizza il database
USE esercizio_edusogno;

-- Comando per creare la tabella "eventi"
CREATE TABLE eventi (
  id int(11) NOT NULL AUTO_INCREMENT,
  attendees text,
  nome_evento varchar(255) DEFAULT NULL,
  data_evento datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Comando per inserire dati nella tabella "eventi"
INSERT INTO eventi (id, attendees, nome_evento, data_evento) VALUES
(4, 'ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'Test Edusogno 1', '2022-10-13 14:00:00'),
(5, 'dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'Test Edusogno 2', '2022-10-15 19:00:00'),
(6, 'dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net', 'Test Edusogno 2', '2022-10-15 19:00:00'),
(10, 'ulysses200915@varen8.com,qmonkey14@falixiao.com,lorenzomartini.mrt@outlook.it', 'prova evento 123', '2023-10-14 22:57:00'),
(19, 'ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net,info@wobdesign.it', 'qwerty', '2023-10-28 00:29:00'),
(21, 'qmonkey14@falixiao.com', 'prova evento', '2023-10-28 03:18:00');

-- Comando per creare la tabella "password_reset_tokens"
CREATE TABLE password_reset_tokens (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  expiry datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Comando per inserire dati nella tabella "password_reset_tokens"
INSERT INTO password_reset_tokens (id, user_email, token, expiry) VALUES
(1, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '1e2affb08b0ee904fa348a9a42348964ebb0207ed87f7dc4705f48a4ac3e0c07', '2023-10-05 08:45:47'),
(2, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '5f14212258830a8d295b4498ea83de0e170b7483ccef9541991e7b416d3a1e71', '2023-10-05 08:50:55'),
(3, 'LORENZOMARTINI.MRT@OUTLOOK.IT', 'f9cb65e948d025ccab74d91c6aa0a629fef5079a174a68cd02544813228c3af2', '2023-10-05 08:59:31'),
(4, 'LORENZOMARTINI.MRT@OUTLOOK.IT', 'a90400ae949757a6a5d05ca28c5c50acdfe528eb9129e8e126a3bd1a9b3c2390', '2023-10-05 09:06:57'),
(5, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '118d53a0f18c3acd17bf15fbb4ba610114dec207a80a6695da5a26e364a34af5', '2023-10-05 09:09:02'),
(6, 'lorenzomartini.mrt@outlook.it', 'ab40ef9102e38e28c4906b51f7eb56247ad8a28a3daece8fe697b965628151a1', '2023-10-05 09:34:10'),
(7, 'LORENZOMARTINI.MRT@OUTLOOK.IT', 'e5ba73da855276d1b943de3843fd7479e6bd9e474395f2c0c62c81ce0973426d', '2023-10-05 09:42:44'),
(8, 'lorenzomartini.mrt@outlook.it', '48165158bc473ce6cd6a2e12eac2cd786a04f4437cf4c2ae8a4ad57e7ae69dd7', '2023-10-05 10:28:55'),
(9, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '4fd311732ed66ddd0fbee2bc9a6d9ec5c5e85bd06c25b7a6933a66c623f3f54b', '2023-10-05 11:13:30'),
(10, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '29a0153822db043394a4443e416a03f7497c966667260dd1dc0be5b3a82360da', '2023-10-05 13:07:27'),
(11, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '349df782fd5e18df7d5b9d0dcc7aef73d4428ee4e151dd09714b5d6d0292ec5e', '2023-10-05 13:12:52'),
(12, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '05dde486d468919a0111c0c9e67aa72a3e4028357ccc8a34a7dc8eedb42a5c08', '2023-10-05 13:14:22'),
(13, 'LORENZOMARTINI.MRT@OUTLOOK.IT', '0fc803a338b9f73295496029f694223c77ae2cddc570b529f75dad19e71a439b', '2023-10-05 13:19:42'),
(14, 'LORENZOMARTINI.MRT@OUTLOOK.IT', 'f5320db5122e670c9d754c4a595dde0fc45a7b66a95e7885511d0851d6b376f4', '2023-10-05 13:34:41'),
(15, 'lorenzomartini.lm@outlook.it', '6b5a272b75d28a2e39844660778a073aca0716612a75bd45bf528b4e4fe28f92', '2023-10-05 15:42:37'),
(16, 'lorenzomartini.lm@outlook.it', 'ea75b4aa3f1faa92c14f98bb4d5f1c8d52ebc3a32ea29be81a9127b62d250cd3', '2023-10-05 15:29:55'),
(17, 'lorenzomartini.mrt@outlook.it', '69e1b5900d2e1d2bfc0a66fcea8681c5d4b155d21fdef42124362ff7558c04af', '2023-10-05 16:49:42'),
(18, 'LORENZOMARTINI.MRT@OUTLOOK.IT', 'dfdcaea052a9477e8fbe83c6654e31ca12bae74f6170adfa6e8761332cdc36e2', '2023-10-05 17:14:15'),
(19, 'lorenzomartini.mrt@outlook.it', '31363ab33f2d247e5adcb422aa707bd7df5ceb0df3d81c3e47735f22748598aa', '2023-10-06 13:51:55'),
(20, 'lorenzomartini.mrt@outlook.it', '1ecb50fe371a22d112b2ac962a68db33d647593e3b5639a42cd9b0922b625385', '2023-10-07 14:07:14');

-- Comando per creare la tabella "utenti"
CREATE TABLE utenti (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(45) DEFAULT NULL,
  cognome varchar(45) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  admin tinyint(1) DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Comando per inserire dati nella tabella "utenti"
INSERT INTO utenti (id, nome, cognome, email, password, admin) VALUES
(1, 'Marco', 'Rossi', 'ulysses200915@varen8.com', '$2y$10$Eg6V3V7put22VNbRM62DCuiFyzMinE2tNuRSh7gPCtaZq0iDIU7S.', 0),
(2, 'Filippo', 'D’Amelio', 'qmonkey14@falixiao.com', '$2y$10$jW0O0bHg05knwdrLs8xZre691jhk8MGvBHjWet.DWxGL5PU2smNbW', 0),
(3, 'Gian Luca', 'Carta', 'mavbafpcmq@hitbase.net', '$2y$10$5YK07/fhjI6N6sGlM1vWv.BumKnokjB9sAHtVopMAcUcl8.msxkXC', 0),
(4, 'Stella', 'De Grandis', 'dgipolga@edume.me', '$2y$10$40b.61r/PICzaNq32X467uw/SV3AwE5z0R6qXI.jBCwCgjV5ODsWS', 0),
(7, 'Lorenzo', 'Rossi', 'lorenzomartini.lm@outlook.it', '$2y$10$QaV9I7c0mHFGS8upzpblsemmrWabmAbj.GSN1QEMN.bhZB3F9TzLW', 0),
(8, 'Lorenzo', 'Martini', 'lorenzomartini.mrt@outlook.it', '$2y$10$0gv3wJN9uExZFASqMLBEgezasVGfRyOMdtJgIfV9YATAxFL/Vn8Y.', 1),
(9, 'Mario', 'Paperino', 'info@wobdesign.it', '$2y$10$JKDnjDq5KC7LtdeaxfZwP.mnTeehSvhAenWMVma2DXVyP75RjOeDK', 0),
(10, 'Pippo', 'Baudo', 'mail@mail.it', '$2y$10$iIFaFQHdEyrMlfg7hNPZ.uzaOCLJX1fn8wszqHIp98G0pfUd7xJAm', 0);

-- Imposta l'auto-incremento per le tabelle
ALTER TABLE eventi
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
ALTER TABLE password_reset_tokens
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
ALTER TABLE utenti
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;