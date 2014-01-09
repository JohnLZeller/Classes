drop table if exists users;
create table users (
  id integer primary key AUTOINCREMENT,
  email varchar(255) UNIQUE NOT NULL,
  date_register date NOT NULL,
  bio text,
  facebook varchar(255),
  twitter varchar(255),
  website varchar(255),
  image blob
);
