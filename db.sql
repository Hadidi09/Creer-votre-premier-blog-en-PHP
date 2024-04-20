-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: blog_post
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_post`
--

DROP TABLE IF EXISTS `blog_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `dateDeCreation` datetime NOT NULL,
  `dateDeMisAJour` varchar(45) NOT NULL,
  `utilisateur_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utlisateurID_idx` (`utilisateur_id`),
  CONSTRAINT `utilisateur_id` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  CONSTRAINT `utilisateurID` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_post`
--

LOCK TABLES `blog_post` WRITE;
/*!40000 ALTER TABLE `blog_post` DISABLE KEYS */;
INSERT INTO `blog_post` VALUES (6,'Salah déchire les offres du PSG et de l\'Arabie Saoudite','A un an de la fin de son contrat à Liverpool, Mohamed Salah fait plus que jamais l\'objet de rumeurs de transfert. Le PSG pense notamment à lui comme remplaçant de Mbappé. Néanmoins, l\'Egyptien a refroidi ses prétendants.','Parmi les attaquants stars en Europe, il est sans doute le joueur le plus abordable à court terme. Mohamed Salah est l\'objet de toutes les convoitises cet été. L\'Egyptien arrive sans doute à la fin d\'un cycle à Liverpool. Arrivé en 2017, Salah n\'a plus qu\'un an de contrat restant chez les Reds. A 31 ans, il serait temps pour lui de débuter une nouvelle aventure surtout que son coach emblématique, Jurgen Klopp, s\'en va. Salah est sur les tablettes des clubs saoudiens depuis plusieurs mois. Il a notamment refusé une offre XXL d\'Al-Ittihad l\'été dernier. Le PSG aussi rêve de le recruter alors que Kylian Mbappé va partir dans quelques mois.\r\n\r\nSalah veut encore rester à Liverpool\r\nDans ce contexte, difficile de ne pas imaginer un départ de Mohamed Salah en juin prochain. Cependant, l\'Egyptien a quelque peu douché l\'enthousiasme de ses prétendants sur le marché. Même s\'il n\'a pas encore prolongé à Liverpool, sa dernière déclaration risque de fermer la porte à un transfert estival. Interrogé par Jamie Carragher sur Sky Sports, Salah a affirmé ne pas vouloir suivre les pas de Jurgen Klopp cet été.\r\n\r\n','2024-03-15 09:45:07','2024-04-05 11:15:25',1,'salah-660fc12d2dc6f9.37908945.webp'),(9,'Arsenal se qualifie, Deschamps s’en prend plein la tête','Les séances de tirs au but, ça se prépare. C\'est le message passé après la qualification d\'Arsenal face au FC Porto, et dans lequel Didier Deschamps peut se sentir visé. ','Aussi incroyable que cela puisse paraitre, jamais deux équipes n’avaient du disputer une séance de tirs au but en Ligue des Champions depuis 2016 et la finale entre le Real et l’Atlético de Madrid. Ce fut pourtant le cas à l’Emirates ce mardi soir avec le match entre Arsenal et le FC Porto. Après le match, Mikel Arteta a avoué avoir préparé ses joueurs en leur faisant tirer des pénaltys, même s’ils n\'avaient pas été nombreux à avoir réussi leur tentative. Peut-être que le gardien des Gunners, David Raya, était déjà trop fort. Toujours est-il que l’entraineur espagnol n’a pas voulu laisser les choses totalement au hasard, même s’il y a toujours deux façons de penser. Didier Deschamps estime par exemple que l’on peut s’entrainer autant que l’on veut sur pénalty, cela ne prépare pas au stress et à la pression d’une séance fatidique. Pour le sélectionneur des Bleus, qui a perdu dans cet exercice face à la Suisse ou à l’Argentine récemment, cela s’apparente à une loterie.','2024-03-22 10:40:29','2024-03-22 10:40:29',1,'arsenal-65fd520da00654.08795710.webp');
/*!40000 ALTER TABLE `blog_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  `status` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `utilisateur_id` int NOT NULL,
  `blog_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId_idx` (`utilisateur_id`),
  KEY `blogID_idx` (`blog_id`),
  CONSTRAINT `blogID` FOREIGN KEY (`blog_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `userId` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (1,'Barcola est un des meilleurs joueurs !','1','2024-03-17 17:16:42',9,6),(2,'quel  match de la part de barcola !','1','2024-03-17 17:34:45',9,6),(5,'on attend toujours le retour de barcola !','1','2024-03-22 11:04:43',9,6),(6,'Aussi incroyable que cela puisse paraitre, jamais deux équipes n’avaient du disputer une séance de tirs au but en Ligue des Champions depuis 2016','0','2024-03-22 11:05:52',9,6),(7,'Aussi incroyable que cela puisse paraitre, jamais deux équipes n’avaient du disputer','0','2024-03-22 11:07:16',9,6),(8,' Pour le sélectionneur des Bleus, qui a perdu dans cet exercice face à la Suisse ou à l’Argentine récemment, cela s’apparente à une loterie.','0','2024-03-22 11:12:01',9,6),(9,'Il faut reconnaitre les deux arrêts incroyables de Raya, et les pénaltys quasiment parfaits des quatre tireurs d’Arsenal.','0','2024-03-22 11:13:27',9,6),(10,'En annonçant sa décision au Paris Saint-Germain dès le mois de février, Kylian Mbappé permet au moins à ses supérieurs de mieux préparer l’avenir sans lui.','0','2024-03-22 11:15:59',9,6),(11,'Kylian Mbappé permet au moins à ses supérieurs de mieux préparer l’avenir sans lui.','0','2024-03-22 11:16:34',9,6),(12,'Il a notamment refusé une offre XXL d\'Al-Ittihad l\'été dernier.','0','2024-03-22 11:17:17',9,6),(13,'le match est fini','0','2024-03-22 12:12:31',9,6);
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'ndiaye','hadramy','charko25@gmail.com','hadidi','utilisateur'),(2,'mymy','hadra','dev-1email@flywheel.local','hadidi','utilisateur'),(3,'julien','Bastien','charko25@gmail.com','hadidi','utilisateur'),(4,'ndiaye','hadramy','charko25@gmail.com','hadidi','utilisateur'),(5,'loris','bard','charko45@gmail.com','hadi58','utilisateur'),(6,'loris','bard','charko25@gmail.com','hadidi','utilisateur'),(7,'cherki','rayan','cherki@gmail.com','$2y$10$9lvMre3Z.KYOdmQsZhDbDeUgTc7Fh.C0zosgf2i9.j4EavE9IqDaq','utilisateur'),(8,'lama','serge','gajasew405@cutefier.com','$2y$10$4Bh6TGDTZJIklw7DRvetU.qOgJ50RE2x/aylJs10xYVofTXpLJMkq','utilisateur'),(9,'ramos','sergio','ramos_90@yahoo.fr','$2y$10$NNLXw84BMYEMYYpA/MZdXuUED8OmuwjgfFvrK7zJFSCktYooYdUrq','utilisateur'),(10,'benzema','karim','benzema_90@yahoo.fr','$2y$10$G3GqNCPIPwb0rDP5v1YF/.UsXwzIxTYe7Z7aOOHbRcqexBJj3FTeS','utilisateur'),(11,'figo','luis','figo_90@yahoo.fr','$2y$10$IRwDtf0tcLrDYNYVYlG2UO.EbT/JClF.TQ/k./4BJdHF0R.9hclj6','utilisateur'),(12,'viera','patrick','patrick@yahoo.fr','$2y$10$ywcRmDrxqkX53cKry/MmjOJ.zdIqYKvf.dM9vmCq2PMoU3OtPkbii','utilisateur'),(13,'breton','bocar','bocar_90@yahoo.fr','$2y$10$.h.zEJLCYcenBy.5pYeEw.aZqKKen.8aAUCdp1OdxkDz3z5wHwfvG','utilisateur');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-19 12:27:44
