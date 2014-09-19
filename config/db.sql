
CREATE TABLE threads (
  threadId int not null primary key auto_increment,
  userId int not null,
  threadTitle varchar(1024) not null,
  created datetime not null,
  INDEX `author` (userId)
) default charset = utf8;

CREATE TABLE posts (
  postId int not null primary key auto_increment,
  threadId int not null,
  userId int not null,
  content text,
  created datetime,
  INDEX `author` (userId),
  INDEX `thread` (threadId)
) default charset = utf8;

CREATE TABLE users (
  userId int not null primary key auto_increment,
  userName varchar(255) not null unique,
  registryDate datetime

) default charset = utf8;