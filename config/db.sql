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
    `number`      TINYINT(2)    NOT NULL,
    `answer`      TINYINT(1)    NOT NULL,
    `question`    VARCHAR(120)  NOT NULL    UNIQUE
)
    ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `Tests` (`category`, `number`, `answer`, `question`) VALUES
('AQ', 1, 0, 'I prefer to do things with others rather than on my own.'),
('AQ', 2, 1, 'I prefer to do things the same way over and over again.'),
('AQ', 3, 0, 'If I try to imagine something, I find it very easy to create a picture in my mind.'),
('AQ', 4, 1, 'I frequently get so strongly absorbed in one thing that I lose sight of other things.'),
('AQ', 5, 1, 'I often notice small sounds when others do not.'),
('AQ', 6, 1, 'I usually notice car number plates or similar strings of information.'),
('AQ', 7, 1, 'Other people frequently tell me that what I’ve said is impolite, even though I think it is polite.'),
('AQ', 8, 0, 'When I’m reading a story, I can easily imagine what the characters might look like.'),
('AQ', 9, 1, 'I am fascinated by dates.'),
('AQ', 10, 0, 'In a social group, I can easily keep track of several different people’s conversations.'),
('AQ', 11, 0, 'I find social situations easy.'),
('AQ', 12, 1, 'I tend to notice details that others do not.'),
('AQ', 13, 1, 'I would rather go to a library than a party.'),
('AQ', 14, 0, 'I find making up stories easy.'),
('AQ', 15, 0, 'I find myself drawn more strongly to people than to things.'),
('AQ', 16, 1, 'I tend to have very strong interests which I get upset about if I can’t pursue.'),
('AQ', 17, 0, 'I enjoy social chit-chat.'),
('AQ', 18, 1, 'When I talk, it isn’t always easy for others to get a word in edgeways.'),
('AQ', 19, 1, 'I am fascinated by numbers.'),
('AQ', 20, 1, 'When I’m reading a story, I find it difficult to work out the characters’ intentions.'),
('AQ', 21, 1, 'I don’t particularly enjoy reading fiction.'),
('AQ', 22, 1, 'I find it hard to make new friends.'),
('AQ', 23, 1, 'I notice patterns in things all the time.'),
('AQ', 24, 0, 'I would rather go to the theatre than a museum.'),
('AQ', 25, 0, 'It does not upset me if my daily routine is disturbed.'),
('AQ', 26, 1, 'I frequently find that I don’t know how to keep a conversation going.'),
('AQ', 27, 0, 'I find it easy to “read between the lines” when someone is talking to me.'),
('AQ', 28, 0, 'I usually concentrate more on the whole picture, rather than the small details.'),
('AQ', 29, 0, 'I am not very good at remembering phone numbers.'),
('AQ', 30, 0, 'I don’t usually notice small changes in a situation, or a person’s appearance.'),
('AQ', 31, 0, 'I know how to tell if someone listening to me is getting bored.'),
('AQ', 32, 0, 'I find it easy to do more than one thing at once.'),
('AQ', 33, 1, 'When I talk on the phone, I’m not sure when it’s my turn to speak.'),
('AQ', 34, 0, 'I enjoy doing things spontaneously.'),
('AQ', 35, 1, 'I am often the last to understand the point of a joke.'),
('AQ', 36, 0, 'I find it easy to work out what someone is thinking or feeling just by looking at their face.'),
('AQ', 37, 0, 'If there is an interruption, I can switch back to what I was doing very quickly.'),
('AQ', 38, 0, 'I am good at social chit-chat.'),
('AQ', 39, 1, 'People often tell me that I keep going on and on about the same thing.'),
('AQ', 40, 0, 'When I was young, I used to enjoy playing games involving pretending with other children.'),
('AQ', 41, 1, 'I like to collect information about categories of things.'),
('AQ', 42, 1, 'I find it difficult to imagine what it would be like to be someone else.'),
('AQ', 43, 1, 'I like to plan any activities I participate in carefully.'),
('AQ', 44, 0, 'I enjoy social occasions.'),
('AQ', 45, 1, 'I find it difficult to work out people’s intentions.'),
('AQ', 46, 1, 'New situations make me anxious.'),
('AQ', 47, 0, 'I enjoy meeting new people.'),
('AQ', 48, 0, 'I am a good diplomat.'),
('AQ', 49, 0, 'I am not very good at remembering people’s date of birth.'),
('AQ', 50, 0, 'I find it very easy to play games with children that involve pretending.'),
('EQ', 1, 1, 'I can easily tell if someone else wants to enter a conversation.'),
('EQ', 2, 0, 'I find it difficult to explain to others things that I understand easily, when they do not understand it first time.'),
('EQ', 3, 1, 'I really enjoy caring for other people.'),
('EQ', 4, 0, 'I find it hard to know what to do in a social situation.'),
('EQ', 5, 0, 'People often tell me that I went too far in driving my point home in a discussion.'),
('EQ', 6, 0, 'It does not bother me too much if I am late meeting a friend.'),
('EQ', 7, 0, 'Friendships and relationships are just too difficult, strongly slightly so I tend not to bother with them.'),
('EQ', 8, 0, 'I often find it difficult to judge if something is rude strongly slightly or polite.'),
('EQ', 9, 0, 'In a conversation, I tend to focus on my own thoughts rather than on what my listener might be agree thinking.'),
('EQ', 10, 0, 'When I was a child, I enjoyed cutting up worms to strongly slightly see what would happen.'),
('EQ', 11, 1, 'I can pick up quickly if someone says one thing but strongly slightly means another.'),
('EQ', 12, 0, 'It is hard for me to see why some things upset people so much.'),
('EQ', 13, 1, 'I find it easy to put myself in somebody else’s shoes.'),
('EQ', 14, 1, 'I am good at predicting how someone will feel.'),
('EQ', 15, 1, 'I am quick to spot when someone in a group is feeling awkward or uncomfortable.'),
('EQ', 16, 0, 'If I say something that someone else is offended by, I think that that is their problem, not mine.'),
('EQ', 17, 0, 'If anyone asked me if I liked their haircut, I would strongly slightly reply truthfully, even if I did not like it.'),
('EQ', 18, 0, 'I cannot always see why someone should have felt offended by a remark.'),
('EQ', 19, 0, 'Seeing people cry does not really upset me.'),
('EQ', 20, 0, 'I am very blunt, which some people take to be rudeness, even though this is unintentional.'),
('EQ', 21, 1, 'I don’t tend to find social situations confusing.'),
('EQ', 22, 1, 'Other people tell me I am good at understanding how they are feeling and what they are thinking.'),
('EQ', 23, 1, 'When I talk to people, I tend to talk about their experiences rather than my own.'),
('EQ', 24, 1, 'It upsets me to see an animal in pain.'),
('EQ', 25, 0, 'I am able to make decisions without being influenced by people’s feelings.'),
('EQ', 26, 1, 'I can easily tell if someone else is interested or bored with what I am saying.'),
('EQ', 27, 1, 'I get upset if I see people suffering on news programmes.'),
('EQ', 28, 1, 'Friends usually talk to me about their problems as strongly slightly they say that I am very understanding.'),
('EQ', 29, 1, 'I can sense if I am intruding, even if the other person does not tell me.'),
('EQ', 30, 0, 'People sometimes tell me that I have gone too far with teasing.'),
('EQ', 31, 0, 'Other people often say that I am insensitive, though I don’t always see why.'),
('EQ', 32, 0, 'If I see a stranger in a group, I think that it is up to strongly slightly them to make an effort to join in.'),
('EQ', 33, 0, 'I usually stay emotionally detached when watching strongly slightly a film.'),
('EQ', 34, 1, 'I can tune into how someone else feels rapidly and strongly slightly intuitively.'),
('EQ', 35, 1, 'I can easily work out what another person might want to talk about.'),
('EQ', 36, 1, 'I can tell if someone is masking their true emotion.'),
('EQ', 37, 1, 'I do not consciously work out the rules of social situations.'),
('EQ', 38, 1, 'I am good at predicting what someone will do.'),
('EQ', 39, 1, 'I tend to get emotionally involved with a friend’s problems.'),
('EQ', 40, 1, 'I can usually appreciate the other person’s viewpoint, even if I don''t agree with it.');
