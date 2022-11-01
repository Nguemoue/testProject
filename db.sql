create table users (
    id int auto_increment primary key,
    nom varchar(70),
    prenom varchar(70),
    email varchar(200) unique,
    password varchar(255),
    created_at datetime default now(),
    photo text,
    telephone varchar(255),
    cvv int,
    birthday date
);