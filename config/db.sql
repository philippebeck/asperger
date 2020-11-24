DROP DATABASE IF EXISTS `asperger`;
CREATE DATABASE `asperger` CHARACTER SET utf8;

USE `asperger`;

CREATE TABLE `Users`
(
    `id`    TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `name`  VARCHAR(50)     NOT NULL,
    `image` VARCHAR(50)     UNIQUE,
    `email` VARCHAR(100)    NOT NULL    UNIQUE,
    `pass`  VARCHAR(100)    NOT NULL
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Articles`
(
  `id`              TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `name`            VARCHAR(30)     NOT NULL    UNIQUE,
  `created_date`    DATETIME        NOT NULL,
  `updated_date`    DATETIME        NOT NULL,
  `content`         TEXT
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Resources`
(
  `id`          TINYINT         UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
  `name`        VARCHAR(30)     NOT NULL    UNIQUE,
  `link`        VARCHAR(60)     NOT NULL    UNIQUE,
  `category`    VARCHAR(30)     NOT NULL,
  `description` TEXT
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `Tests`
(
    `id`          TINYINT       UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
    `category`    CHAR(2)       NOT NULL,
    `question`    VARCHAR(100)  NOT NULL    UNIQUE
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Tests` (`category`, `question`) VALUES
('AQ', 'I prefer to do activities with other people rather than alone.'),
('AQ', 'I prefer to do everything the same way over & over again.'),
('AQ', 'When I try to imagine something, it is very easy to imagine it in my mind.'),
('AQ', 'I am frequently so engrossed in one thing that I lose sight of everything else.'),
('AQ', 'My attention is often drawn to quiet noises that others do not notice.'),
('AQ', 'I usually pay attention to license plate numbers or other such information.'),
('AQ', 'People often tell me that what I said was rude, even when I think it was polite.'),
('AQ', 'When I read a story I can easily imagine what the characters might look like.'),
('AQ', 'I am fascinated by dates.'),
('AQ', 'Within a group, I can easily follow the conversations of several people at the same time.'),
('AQ', 'I find social situations easy.'),
('AQ', 'I tend to notice certain details that others do not see.'),
('AQ', 'I would rather go to a library than to a party.'),
('AQ', 'I find it easy to make up stories.'),
('AQ', 'I am more attracted to people than to things.'),
('AQ', 'I tend to have very important interests. I worry when I cannot devote myself to it.'),
('AQ', 'I enjoy social chatting.'),
('AQ', 'When I speak, it is not always easy for others to get a word out.'),
('AQ', 'I am fascinated by the numbers.'),
('AQ', 'When I read a story, I find it difficult to imagine the intentions of the characters.'),
('AQ', 'I do not particularly like reading novels.'),
('AQ', 'I find it difficult to make new friends.'),
('AQ', 'I keep noticing regular patterns in the things around me.'),
('AQ', 'I would rather go to the cinema than to the museum.'),
('AQ', 'I do not mind if my daily habits are disrupted.'),
('AQ', 'I often notice that I do not know how to carry on a conversation.'),
('AQ', 'I find it easy to "read between the lines" when someone is talking to me.'),
('AQ', 'I usually focus more on the whole image than on the small details of it.'),
('AQ', 'I am not very good at remembering phone numbers.'),
('AQ', 'I usually do not notice small changes in a situation or in the appearance of someone.'),
('AQ', 'I can recognize when my interlocutor is bored.'),
('AQ', 'I find it easy to do more than one thing at a time.'),
('AQ', 'When I speak on the phone, I am not sure when it is my turn to speak.'),
('AQ', 'I like to do things spontaneously.'),
('AQ', 'I am often the last to understand the meaning of a joke.'),
('AQ', 'I find it easy to decode what other people are thinking or feeling just by looking at their faces.'),
('AQ', 'If I am interrupted I can easily go back to what I was doing.'),
('AQ', 'I am good at social chatter.'),
('AQ', 'People often tell me that I keep repeating the same things over & over again.'),
('AQ', 'When I was a child, I usually liked to role-play with others.'),
('AQ', 'I like to collect information on categories of things.'),
('AQ', 'I find it hard to imagine yourself in the shoes of someone else.'),
('AQ', 'I like to plan carefully any activity in which I participate.'),
('AQ', 'I like social events.'),
('AQ', 'I find it difficult to decode the intentions of others.'),
('AQ', 'New situations make me anxious.'),
('AQ', 'I like meeting new people.'),
('AQ', 'I am a person who has a good sense of diplomacy.'),
('AQ', 'I am not very good at remembering dates of birth of people.'),
('AQ', 'I find it very easy to role play with children.');
