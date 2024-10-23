TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `calculTotalBeforeInsert` BEFORE INSERT ON `tireur` FOR EACH ROW SET NEW.scoreTotalTireur = NEW.scoreSerie1 + NEW.scoreSerie2 + NEW.scoreSerie3 + NEW.scoreSerie4 + NEW.scoreSerie5 + NEW.scoreSerie6' 'CREATE DEFINER=`root`@`localhost` TRIGGER `calculTotalBeforeUpdate` BEFORE UPDATE ON `tireur` FOR EACH ROW SET NEW.scoreTotalTireur = NEW.scoreSerie1 + NEW.scoreSerie2 + NEW.scoreSerie3 + NEW.scoreSerie4 + NEW.scoreSerie5 + NEW.scoreSerie6' 'CREATE DEFINER=`root`@`localhost` TRIGGER `attribuerCategorieACompetitionInsert` AFTER INSERT ON `tireur` FOR EACH ROW INSERT IGNORE INTO `bdtsr`.`avoir` (`idCategorieTireur`, `idCompetition`) VALUES (NEW.idCategorieTireur, NEW.idCompetition)' 'CREATE DEFINER=`root`@`localhost` TRIGGER `attribuerCategorieACompetitionUpdate` AFTER UPDATE ON `tireur` FOR EACH ROW INSERT IGNORE INTO `bdtsr`.`avoir` (`idCategorieTireur`, `idCompetition`) VALUES (NEW.idCategorieTireur, NEW.idCompetition)'
sql_modes=524288 524288 1073741824 1073741824
definers='root@localhost' 'root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
