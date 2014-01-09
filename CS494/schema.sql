drop table if exists users;
create table users (
  email varchar(255) primary key,
  password varchar(255) not null,
  date_register date not null,
  bio text,
  facebook varchar(255),
  twitter varchar(255),
  website varchar(255),
  image blob
);
