DROP DATABASE IF EXISTS `asperger`;
CREATE DATABASE `asperger` CHARACTER SET utf8;

USE `asperger`;

CREATE TABLE `Test` (
  `id`                  TINYINT     UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
  `category`            CHAR(2)     NOT NULL  UNIQUE,
  `score_type`          VARCHAR(20) NOT NULL,
  `value_max`           TINYINT     UNSIGNED  NOT NULL,
  `asperger_min`        TINYINT     UNSIGNED  NOT NULL,
  `asperger_max`        TINYINT     UNSIGNED  NOT NULL,
  `man_min`             TINYINT     UNSIGNED  NOT NULL,
  `man_max`             TINYINT     UNSIGNED  NOT NULL,
  `woman_min`           TINYINT     UNSIGNED  NOT NULL,
  `woman_max`           TINYINT     UNSIGNED  NOT NULL,
  `author`              VARCHAR(50) NOT NULL,
  `year`                YEAR        NOT NULL,
  `translation_author`  VARCHAR(50) NOT NULL,
  `translation_year`    YEAR        NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `AQ` (
  `id`          TINYINT       UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `answer`      TINYINT(1)    NOT NULL,
  `question`    VARCHAR(200)  NOT NULL    UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `EQ` (
  `id`          TINYINT       UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `answer`      TINYINT(1)    NOT NULL,
  `question`    VARCHAR(200)  NOT NULL    UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `SQ` (
  `id`          TINYINT       UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `answer`      TINYINT(1)    NOT NULL,
  `question`    VARCHAR(200)  NOT NULL    UNIQUE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `FQ` (
  `id`          TINYINT       UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `question`    VARCHAR(200),
  `answer_1`    VARCHAR(200),
  `answer_2`    VARCHAR(200),
  `answer_3`    VARCHAR(200),
  `answer_4`    VARCHAR(200),
  `answer_5`    VARCHAR(200),
  `answer_6`    VARCHAR(200),
  `answer_7`    VARCHAR(200),
  `answer_8`    VARCHAR(200)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Test` (`category`, `score_type`, `value_max`, `asperger_min`, `asperger_max`, `man_min`, `man_max`, `woman_min`, `woman_max`, `author`, `year`, `translation_author`, `translation_year`) VALUES
('AQ', '(fort) = (faible)', 50, 31, 45, 12, 26, 11, 23, 'Baron-Cohen, Wheelwright, Skinner, Martin & Clubey', 2001, 'Braun & Kempenaers', 2007),
('EQ', '(fort) = 2*(faible)', 80, 9, 33, 26, 51, 37, 59, 'Baron-Cohen & Wheelwright', 2004, 'Besche-Richard, Olivier & Albert', 2006),
('FQ', '', 135, 35, 78, 55, 86, 74, 106, 'Baron-Cohen & Wheelwright', 2003, 'Beck', 2021),
('SQ', '(fort) = 2*(faible)', 150, 50, 120, 35, 80, 25, 70, 'Baron-Cohen, Wheelwright, Skinner, Martin & Clubey', 2003, 'Braun & Kempenaers', 2007);

INSERT INTO `AQ` (`answer`, `question`) VALUES
(0, 'Je préfère réaliser des activités avec d’autres personnes plutôt que seul(e).'),
(1, 'Je préfère tout faire continuellement de la même manière.'),
(0, 'Quand j’essaye d’imaginer quelque chose, il est très facile de m’en représenter une image mentalement.'),
(1, 'Je suis fréquemment tellement absorbé(e) par une chose que je perds tout le reste de vue.'),
(1, 'Mon attention est souvent attirée par des bruits discrets que les autres ne remarquent pas.'),
(1, 'Je fais habituellement attention aux numéros de plaques d’immatriculation ou à d’autres types d’informations de ce genre.'),
(1, 'Les gens me disent souvent que ce que j’ai dit était impoli, même quand je pense moi que c’était poli.'),
(0, 'Quand je lis une histoire, je peux facilement imaginer à quoi les personnages pourraient ressembler.'),
(1, 'Je suis fasciné(e) par les dates.'),
(0, 'Au sein d’un groupe, je peux facilement suivre les conversations de plusieurs personnes à la fois.'),
(0, 'Je trouve les situations de la vie en société faciles.'),
(1, 'J’ai tendance à remarquer certains détails que les autres ne voient pas.'),
(1, 'Je préfèrerais aller dans une bibliothèque plutôt qu’à une fête.'),
(0, 'Je trouve facile d’inventer des histoires.'),
(0, 'Je suis plus facilement attiré(e) par les gens que par les objets.'),
(1, 'J’ai tendance à avoir des centres d’intérêt très importants. Je me tracasse lorsque je ne peux m’y consacrer.'),
(0, 'J’apprécie le bavardage en société.'),
(1, 'Quand je parle, il n’est pas toujours facile pour les autres de placer un mot.'),
(1, 'Je suis fasciné(e) par les chiffres.'),
(1, 'Quand je lis une histoire, je trouve qu’il est difficile de me représenter les intentions des personnages.'),
(1, 'Je n’aime pas particulièrement lire des romans.'),
(1, 'Je trouve qu’il est difficile de se faire de nouveaux amis.'),
(1, 'Je remarque sans cesse des schémas réguliers dans les choses qui m’entourent.'),
(0, 'Je préfèrerais aller au théâtre qu’au musée.'),
(0, 'Cela ne me dérange pas si mes habitudes quotidiennes sont perturbées.'),
(1, 'Je remarque souvent que je ne sais pas comment entretenir une conversation.'),
(0, 'Je trouve qu’il est facile de « lire entre les lignes » lorsque quelqu’un me parle.'),
(0, 'Je me concentre habituellement plus sur l’ensemble d’une image que sur les petits détails de celle-ci.'),
(0, 'Je ne suis pas très doué(e) pour me souvenir des numéros de téléphone.'),
(0, 'Je ne remarque habituellement pas les petits changements dans une situation ou dans l’apparence de quelqu’un.'),
(0, 'Je sais m’en rendre compte quand mon interlocuteur s’ennuie.'),
(0, 'Je trouve qu’il est facile de faire plus d’une chose à la fois.'),
(1, 'Quand je parle au téléphone, je ne suis pas sûr(e) de savoir quand c’est à mon tour de parler.'),
(0, 'J’aime faire les choses de manière spontanée.'),
(1, 'Je suis souvent le(la) dernier(ère) à comprendre le sens d’une blague.'),
(0, 'Je trouve qu’il est facile de décoder ce que les autres pensent ou ressentent juste en regardant leur visage.'),
(0, 'Si je suis interrompu(e), je peux facilement revenir à ce que j’étais en train de faire.'),
(0, 'Je suis doué(e) pour le bavardage en société.'),
(1, 'Les gens me disent souvent que répète continuellement les mêmes choses.'),
(0, 'Quand j’étais enfant, j’aimais habituellement jouer à des jeux de rôle avec les autres.'),
(1, 'J’aime collectionner des informations sur des catégories de choses (types de voitures, d’oiseaux, de trains, de plantes...).'),
(1, 'Je trouve qu’il est difficile de s’imaginer dans la peau d’un autre.'),
(1, 'J’aime planifier avec soin toute activité à laquelle je participe.'),
(0, 'J’aime les événements sociaux.'),
(1, 'Je trouve qu’il est difficile de décoder les intentions des autres.'),
(1, 'Les nouvelles situations me rendent anxieux(se).'),
(0, 'J’aime rencontrer de nouvelles personnes.'),
(0, 'Je suis une personne qui a le sens de la diplomatie.'),
(0, 'Je ne suis pas très doué(e) pour me souvenir des dates de naissance des gens.'),
(0, 'Je trouve qu’il est très facile de jouer à des jeux de rôle avec des enfants.');

INSERT INTO `EQ` (`answer`, `question`) VALUES
(1, 'Je peux facilement dire quand quelqu’un veut entamer une conversation.'),
(0, 'Je trouve difficile d’expliquer aux autres des choses que j’ai comprises facilement et que eux n’ont pas comprises du premier coup.'),
(1, 'J’aime prendre soin des autres.'),
(0, 'Je trouve difficile de savoir ce qu’il faut faire dans les relations sociales.'),
(0, 'On me dit souvent que je vais trop loin quand j’expose mon point de vue dans une discussion.'),
(0, 'Cela ne m’ennuie pas trop d’être en retard à un rendez-vous fixé à un ami.'),
(0, 'Les relations sociales sont si difficiles que j’essaie de ne pas m’en soucier.'),
(0, 'J’ai souvent du mal à juger si quelque chose est grossier ou familier.'),
(0, 'Dans une conversation, j’ai tendance à me centrer sur mes propres pensées plutôt que sur celles de mon interlocuteur.'),
(0, 'Quand j’étais enfant, j’aimais couper des vers de terre pour voir ce qui se passe.'),
(1, 'Je détecte rapidement si quelqu’un dit une chose qui en signifie une autre.'),
(0, 'Je ne comprends pas comment des choses vexent tant certaines personnes.'),
(1, 'Il est pour moi facile de me mettre à la place de quelqu’un d’autre.'),
(1, 'Je prédis assez bien le ressenti des autres.'),
(1, 'Dans un groupe, je repère facilement quand quelqu’un se sent gêné ou mal à l’aise.'),
(0, 'Si j’offense quelqu’un en parlant, j’estime que c’est son problème et pas le mien.'),
(0, 'Si quelqu’un me demandait mon avis sur sa coupe de cheveux, je répondrais honnêtement même si elle ne me plaît pas.'),
(0, 'Je ne comprends pas toujours pourquoi une personne peut être offensée par une remarque.'),
(0, 'Voir quelqu’un pleurer ne me touche pas vraiment.'),
(0, 'Je ne mâche pas mes mots, ce qui est souvent pris pour de la grossièreté même si ce n’est pas mon intention.'),
(1, 'En général, je comprends facilement les situations sociales.'),
(1, 'On me dit généralement que je comprends bien les sentiments et les pensées des autres.'),
(1, 'Quand je discute avec quelqu’un, j’essaie de parler de ses expériences plutôt que des miennes.'),
(1, 'Ça me bouleverse de voir un animal souffrant.'),
(0, 'Je suis capable de prendre des décisions sans être influencé(e) par les sentiments des autres.'),
(1, 'Je remarque facilement si quelqu’un est intéressé ou ennuyé par ce que je dis.'),
(1, 'Lorsque je regarde le journal télévisé, je suis triste de voir des personnes qui souffrent.'),
(1, 'Mes amis me parlent généralement de leurs problèmes car ils disent que je suis très compréhensif(ve).'),
(1, 'Je peux sentir quand je dérange les autres, même s’ils ne me le disent pas.'),
(0, 'Des fois, on me dit que j’exagère quand je charrie les gens.'),
(0, 'On me dit souvent que je suis insensible même si je ne vois pas toujours pourquoi.'),
(0, 'Si je vois qu’il y a un nouveau venu dans un groupe de personnes, je crois que c’est à elles d’essayer de l’intégrer.'),
(0, 'D’habitude, je ne m’implique pas émotionnellement lorsque je regarde un film.'),
(1, 'Je peux me mettre à l’écoute du ressenti des autres rapidement et intuitivement.'),
(1, 'Je peux facilement comprendre ce que quelqu’un veut dire.'),
(1, 'Je peux deviner si quelqu’un masque ses émotions.'),
(1, 'Je n’essaie pas de déchiffrer de façon consciente les règles en jeu dans les situations sociales.'),
(1, 'Je suis bon(ne) pour prédire ce que quelqu’un va faire.'),
(1, 'J’ai tendance à m’impliquer émotionnellement dans les problèmes de mes amis.'),
(1, 'Habituellement, je comprends le point de vue des autres même si je ne le partage pas.');

INSERT INTO `SQ` (`answer`, `question`) VALUES
(1, 'Je trouve cela très facile d’utiliser les tableaux horaires des trains même s’ils impliquent plusieurs correspondances.'),
(1, 'J’aime les magasins de musique ou les librairies parce qu’ils sont clairement organisés.'),
(0, 'Je n’aimerais pas organiser des événements comme des soirées de collecte, des fêtes, des conférences...'),
(1, 'Quand je lis quelque chose, je remarque toujours si c’est grammaticalement correct.'),
(1, 'Je me surprends à classer mentalement les gens en différents types.'),
(0, 'Je trouve cela difficile de lire et de comprendre les cartes.'),
(1, 'Quand je regarde une montagne, je pense à la manière précise dont elle s’est formée.'),
(0, 'Je ne suis pas intéressé(e) par le détails des taux de change, des taux d’intérêt et des valeurs boursières.'),
(1, 'Si j’achetais une voiture, je souhaiterais obtenir des informations spécifiques sur la capacité de son moteur.'),
(0, 'Je trouve cela difficile d’apprendre comment on programme un magnétoscope.'),
(1, 'Quand j’apprécie quelque chose, j’aime collectionner beaucoup d’exemples différents de chaque type d’objet afin de pouvoir observer ce en quoi ils diffèrent les uns des autres.'),
(1, 'Quand j’apprends une langue, je suis intrigué(e) par ses règles grammaticales.'),
(1, 'J’aime savoir comment les comités sont structurés : qui les différents membres du comité représentent ou quelles fonctions ils occupent.'),
(1, 'Si j’avais une collection (par exemple, de CD, de timbres, de pièces de monnaies, …), elle serait extrêmement organisée.'),
(0, 'Je trouve qu’il est difficile de comprendre les manuels d’instructions permettant d’assembler des appareils.'),
(1, 'Quand je regarde un bâtiment, je suis curieux(se) de savoir de quelle manière précise il a été construit.'),
(0, 'Je ne suis pas intéressé(e) par la compréhension du fonctionnement des réseaux de communication sans fil (ex : téléphonie mobile).'),
(1, 'Quand je voyage en train, je me demande souvent comment le réseau des chemins de fer est précisément coordonné.'),
(1, 'J’aime consulter les catalogues de produits afin de voir le détail de chaque produit et de voir comment il se distingue des autres.'),
(1, 'Quand il me manque quelque chose à la maison, je l’ajoute toujours à ma liste de courses.'),
(1, 'Je sais, avec une précision raisonable, quelle quantité d’argent entre et sort sur/de mon compte en banque ce mois.'),
(0, 'Quand j’étais jeune, je ne prenais pas de plaisir à collectionner des séries de choses comme des stickers, des cartes de football, etc'),
(1, 'Je suis intéressé(e) par mon arbre généalogique et par le fait de comprendre comment chaque personne est reliée aux autres au sein de la famille.'),
(0, 'Quand j’apprends des événements historiques, je ne me focalise pas sur les dates exactes.'),
(1, 'Je trouve qu’il est facile de comprendre exactement comment dans les paris les cotes fonctionnent.'),
(0, 'Je ne prends pas de plaisir dans les jeux qui requièrent un haut niveau de stratégie (par exemple les échecs, Risk...).'),
(1, 'Quand j’apprends une nouvelle catégorie, j’aime aller dans les détails pour comprendre les petites différences entre les membres de cette catégorie.'),
(0, 'Je ne trouve pas cela gênant quand quelqu’un qui vit avec moi perturbe mes habitudes.'),
(1, 'Quand je regarde un animal, j’aime connaître l’espèce précise à laquelle il appartient.'),
(1, 'Je peux me rappeler de grandes quantités d’informations à propos d’un sujet qui m’intéresse (par exemple, les drapeaux nationaux, les logos des compagnies aériennes).'),
(0, 'A la maison, je ne classe pas précautioneusement tous les documents importants (par exemple, les garanties, les polices d’assurance).'),
(1, 'Je suis fasciné(e) par la manière dont les machines fonctionnent.'),
(0, 'Quand je regarde un meuble, je ne remarque pas les détails de sa réalisation.'),
(0, 'Je connais très peu de choses sur les différentes étapes des procédures législatives de mon pays.'),
(0, 'Je n’ai pas tendance à regarder des documentaires scientifiques à la télévision ou à lire des articles portant sur la science et la nature.'),
(1, 'Si quelqu’un m’arrêtait pour me demander le chemin, je serais capable de lui indiquer la direction vers n’importe quelle partie de la ville dans laquelle je vis.'),
(0, 'Quand je regarde un tableau, je ne pense habituellement pas à la technique employée pour le réaliser.'),
(1, 'Je préfère les interactions sociales qui sont organisées autour d’une activité précise (par exemple, un hobby).'),
(0, 'Je ne vérifie pas toujours que mes tickets de frais correspondent à mes relevés de compte bancaire.'),
(0, 'Je ne suis pas intéressé(e) par la manière dont le gouvernement est organisé en terme des différents ministères et départements.'),
(1, 'Cela m’intéresse de connaître le parcours d’une rivière, de sa source à la mer.'),
(1, 'J’ai une vaste collection de livres, CD, vidéos, etc'),
(1, 'S’il y avait un problème avec l’installation électrique de ma maison, je serais capable de le règler moi-même.'),
(0, 'Dans ma garde-robe, mes vêtements ne sont pas précautionneusement organisés en fonction de leurs différentes catégories d’appartenance.'),
(0, 'Je lis rarement des articles ou des pages web sur des nouvelles technologies.'),
(1, 'Je peux facilement visualiser la manière dont les autoroutes de ma région sont reliées les unes aux autres.'),
(0, 'Quand une élection a lieu, je ne suis pas intéressé(e) par les résultats de chacun des partis.'),
(0, 'Je ne prends pas particulièrement de plaisir à en apprendre sur les faits et les personnages historiques.'),
(0, 'Je n’ai pas tendance à me souvenir des dates d’anniversaire des gens (en terme de jour et de mois).'),
(1, 'Quand je me balade à la campagne, je suis curieux(se) de savoir de quelle manière les variétés d’arbres diffèrent.'),
(0, 'Je trouve difficile de comprendre les informations que la banque m’envoi sur les différents types d’investissement et sur les systèmes de protection.'),
(0, 'Si j’achetais un appareil photo, je ne ferais pas particulièrement attention à la qualité de la lentille.'),
(1, 'Si j’achetais un ordinateur, je voudrais connaître les détails exacts des capacités du disque dur et de la vitesse du processeur.'),
(0, 'Je ne lis pas les documents légaux très attentivement.'),
(1, 'Quand j’arrive à la caisse d’un supermarché, je range les différentes catégories de produits dans des sacs distincts.'),
(0, 'Je ne suis pas une méthode particulière quand je nettoie ma maison.'),
(0, 'Je ne prends pas de plaisir aux discussions politiques approfondies.'),
(0, 'Je ne suis pas très méticuleux(se) lorsque j’effectue des travaux moi-même pour, par exemple, apporter des améliorations à ma maison.'),
(0, 'Je ne prendrais pas de plaisir à monter une affaire du début à la fin.'),
(1, 'Si j’achetais une chaîne stéréo, je voudrais connaître ses caractéristiques techniques spécifiques.'),
(1, 'J’ai tendance à conserver des choses que d’autres pourraient jetter au cas où elles me seraient utiles dans l’avenir.'),
(1, 'J’évite les situations que je ne peux pas contrôler.'),
(0, 'Cela ne m’intéresse pas de connaître le nom des plantes que je vois.'),
(0, 'Quand j’entend les prévisions météo, je ne suis pas très intéressé(e) par les aspects purement météorologiques.'),
(0, 'Cela ne m’embête pas si les choses de ma maison ne sont pas à leur place.'),
(1, 'En math, je suis intrigué(e) par les règles et les relations qui gouvernent les nombres.'),
(0, 'Je trouve difficile de m’orienter dans une nouvelle ville.'),
(1, 'Je pourrais faire la liste de mes 10 livres préférés, et me rappeler des titres et du nom des auteurs de mémoire.'),
(1, 'Quand je lis le journal, je suis attiré(e) par les grilles d’informations comme les scores du football ou les indices de marché.'),
(0, 'Quand je suis dans un avion, je ne pense pas aux lois de l’aérodynamique.'),
(0, 'Je ne conserve pas avec soin les factures du ménage.'),
(1, 'Quand j’ai pas mal de courses à faire, j’aime planifier les types de magasins dans lesquels je dois aller et l’ordre dans lequel je compte m’y rendre.'),
(0, 'Quand je cuisine, je ne pense pas exactement à la manière dont les différents ingrédients et tâches contribuent au produit final.'),
(1, 'Quand j’écoute un morceau de musique, je remarque toujours la manière dont il est structuré.'),
(1, 'Je pourrais produire la liste de mes 10 chansons favorites de mémoire, en donnant le titre et le nom des artistes qui ont réalisé chaque chanson.');

INSERT INTO `FQ` (`question`, `answer_1`, `answer_2`, `answer_3`, `answer_4`, `answer_5`, `answer_6`, `answer_7`, `answer_8`) VALUES
('', 'J’ai un ou deux meilleurs amis.', 'J’ai plusieurs amis que j’appellerais mes meilleurs amis.', 'Je n’ai personne que j’appellerais un meilleur ami.', '', '', '', '', ''),
('', 'La chose la plus importante dans une amitié est d’avoir quelqu’un à qui se confier.', 'La chose la plus importante dans une amitié est d’avoir quelqu’un avec qui s’amuser.', '', '', '', '', '', ''),
('', 'Si je devais choisir, je préférerais avoir un ami qui aime faire les mêmes choses que moi qu’un ami qui ressent la même chose que moi dans la vie.', 'Si je devais choisir, je préférerais avoir un ami qui ressent la même chose que moi dans la vie, qu’un ami qui aime faire les mêmes choses que moi.', '', '', '', '', '', ''),
('', 'J’aime être proche des gens.', 'J’aime garder mes distances avec les gens.', '', '', '', '', '', ''),
('', 'Lorsque je parle au téléphone avec des amis, c’est généralement pour prendre des dispositions plutôt que pour discuter.', 'Lorsque je parle avec des amis au téléphone, c’est généralement pour discuter plutôt que pour prendre des dispositions.', '', '', '', '', '', ''),
('', 'J’ai tendance à penser à une activité que je veux faire et à trouver ensuite quelqu’un avec qui la faire.', 'J’ai tendance à m’arranger pour rencontrer quelqu’un et à penser ensuite à quelque chose à faire.', '', '', '', '', '', ''),
('', 'Je préfère rencontrer un ami pour une activité spécifique, par exemple aller au cinéma, jouer au golf.', 'Je préfère rencontrer un ami pour discuter, par exemple dans un pub, dans un café.', '', '', '', '', '', ''),
('', 'Si je déménageais dans une nouvelle région, je ferais plus d’efforts pour rester en contact avec de vieux amis que pour me faire de nouveaux amis.', 'Si je déménageais dans une nouvelle région, je mettrais plus d’efforts à me faire de nouveaux amis qu’à rester en contact avec de vieux amis.', '', '', '', '', '', ''),
('', 'Mes amis me valorisent plus comme quelqu’un qui les soutient que comme quelqu’un avec qui s’amuser.', 'Mes amis me valorisent plus comme quelqu’un avec qui s’amuser que comme quelqu’un qui les soutient.', '', '', '', '', '', ''),
('', 'Si un ami avait un problème, je ferais mieux de discuter de ses sentiments à propos du problème que de trouver des solutions pratiques.', 'Si un ami avait un problème, je ferais mieux de trouver des solutions pratiques que de discuter de ses sentiments à propos du problème.', '', '', '', '', '', ''),
('', 'Si un ami avait des problèmes personnels, j’attendrais qu’il me contacte car je ne voudrais pas interférer.', 'Si un ami avait des problèmes personnels, je le contacterais pour discuter du problème.', '', '', '', '', '', ''),
('', 'Quand j’ai un problème personnel, je pense qu’il vaut mieux le résoudre moi-même.', 'Quand j’ai un problème personnel, je pense qu’il vaut mieux le partager avec un ami.', 'Quand j’ai un problème personnel, je pense qu’il vaut mieux essayer de l’oublier.', '', '', '', '', ''),
('', 'Si je dois dire quelque chose de critique à un ami, je pense qu’il vaut mieux aborder le sujet avec douceur.', 'Si je dois dire quelque chose de critique à un ami, je pense qu’il est préférable de sortir et de le dire.', '', '', '', '', '', ''),
('Si je me suis brouillé avec un bon ami et que je pensais que je n’avais rien fait de mal', 'Je ferais tout ce qu’il faut pour réparer la relation.', 'Je serais prêt à faire le premier pas, à condition qu’ils me rendent la pareille.', 'Je serais prêt à régler le problème, s’ils faisaient le premier pas.', 'Je ne me sentirais plus capable d’être leur ami proche.', '', '', '', ''),
('Mon espace de travail idéal serait', 'dans un bureau seul, sans aucun visiteur pendant la journée.', 'dans un bureau seul, avec un visiteur occasionnel pendant la journée.', 'dans un bureau avec un ou deux autres.', 'dans un bureau à aire ouverte.', '', '', '', ''),
('Est-ce que vous trouvez facile de discuter de vos sentiments avec vos amis ?', 'Très facile', 'Assez facile', 'Pas très facile', 'Assez difficile', 'Très difficile', '', '', ''),
('Dans quelle mesure trouveriez-vous facile de discuter de vos sentiments avec un étranger ?', 'Très facile', 'Assez facile', 'Pas très facile', 'Assez difficile', 'Très difficile', '', '', ''),
('En termes de personnalité, dans quelle mesure avez-vous tendance à ressembler à vos amis ?', 'Très similaire', 'Assez similaire', 'Pas très similaire', 'Très dissemblable', '', '', '', ''),
('En termes d’intérêts, dans quelle mesure avez-vous tendance à ressembler à vos amis ?', 'Très similaire', 'Assez similaire', 'Pas très similaire', 'Très dissemblable', '', '', '', ''),
('À quel point est-ce important pour vous ce que vos amis pensent de vous ?', 'Sans importance', 'De peu d’importance', 'Assez important', 'Très important', 'De la plus haute importance', '', '', ''),
('Quelle importance accordez-vous à ce que les étrangers pensent de vous ?', 'Sans importance', 'De peu d’importance', 'Assez important', 'Très important', 'De la plus haute importance', '', '', ''),
('Est-ce que vous trouvez facile d’admettre à vos amis quand vous vous trompez ?', 'Très facile', 'Assez facile', 'Pas très facile', 'Assez difficile', 'Très difficile', '', '', ''),
('Trouvez-vous facile de parler à un ami de vos faiblesses et de vos échecs ?', 'Très facile', 'Assez facile', 'Pas très facile', 'Assez difficile', 'Très difficile', '', '', ''),
('Trouvez-vous facile de parler à un ami de vos réalisations et de vos succès ?', 'Très facile', 'Assez facile', 'Pas très facile', 'Assez difficile', 'Très difficile', '', '', ''),
('Dans quelle mesure êtes-vous intéressé par les détails quotidiens (par exemple, leurs relations, leur famille, ce qui se passe actuellement dans leur vie) de la vie de vos amis proches ?', 'Complètement désintéressé', 'Pas très intéressé', 'Assez intéressé', 'Très intéressé', '', '', '', ''),
('Dans quelle mesure êtes-vous intéressé par les détails quotidiens (par exemple, leurs relations, leur famille, ce qui se passe actuellement dans leur vie) de la vie de vos amis occasionnels ?', 'Complètement désintéressé', 'Pas très intéressé', 'Assez intéressé', 'Très intéressé', '', '', '', ''),
('Lorsque vous êtes dans un groupe, par ex. au travail, à l’école, à l’église, dans un groupe de parents, etc., dans quelle mesure est-il important pour vous de connaître les «potins», par ex. qui n’aime pas qui, qui a eu une relation avec qui, des secrets.', 'Sans importance', 'De peu d’importance', 'Assez important', 'Très important', 'De la plus haute importance', '', '', ''),
('Travaillez-vous plus dur à votre carrière qu’au maintien de vos relations avec vos amis ?', 'Oui', 'Non', 'Egal', '', '', '', '', ''),
('À quelle fréquence prévoyez-vous de rencontrer des amis ?', 'Une ou deux fois par an', 'Une fois tous les 2 ou 3 mois', 'Une fois par mois', 'Une fois toutes les deux semaines', 'Une fois ou deux fois par semaine', '3 ou 4 fois par semaine', 'Plus que tout ce qui précède', ''),
('', '', '', '', '', '', '', '', ''),
('', '', '', '', '', '', '', '', ''),
('', '', '', '', '', '', '', '', ''),
('', '', '', '', '', '', '', '', ''),
('', '', '', '', '', '', '', '', ''),
('', '', '', '', '', '', '', '', '');
