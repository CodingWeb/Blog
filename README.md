# Blog
Je suis toujours entrain d'approfondir mes connaissances en Php j'utilise boostrap dans mon projet, je suis en train de réaliser un blog, qui va évoluer avec le temps j'éspére avoir des retours pour des améliorations.

J'ai terminé le blog je vais passer du côté administration qui aura comme option de modifier un article, d'en supprimer avec ses commentaires associés bien entendus,
après ce projet terminé je passerai à la programmation orientée objet, je ferai des exercices par exemple reconstruire l'intégralité de ce bloc en programmation orientée objet,
je compte après passer à symfony qui est orienté objet et qui à l'architecture MVC, Pour tous les débutants qui voudraient jeter un œil au code pour mieux comprendre son fonctionnement,
Il suffit de télécharger l'intégralité de l'archive et d'extraire dans le dossier wamp/www

Créer une base de données nommées blog, si vous choisissez un autre nom de bases de données n'oubliez pas de le changer dans le fichier connexion.phpAjouter les deux tables ci-dessous.


CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8

N'hésitez pas si vous voyez que le code pourrait être amélioré.

À bientôt
