CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(70) DEFAULT NULL,
  prenom varchar(70) DEFAULT NULL,
  email varchar(200) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  created_at datetime DEFAULT null,
  photo_path varchar(200) DEFAULT NULL,
  telephone varchar(255) DEFAULT NULL,
  birthday date DEFAULT NULL,
  PRIMARY KEY (id),
  constraint  uk_email unique(email)
);

CREATE TABLE bank_coords (
  id int(11) NOT NULL AUTO_INCREMENT,
  numero int(11) DEFAULT NULL,
  delivred_at date DEFAULT null,
  cvv int(11) DEFAULT 111,
  nom varchar(200) DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  created_at datetime DEFAULT null,
  card_type varchar(200) DEFAULT NULL,
  month_expired int(11) DEFAULT 1,
  year_expired int(11) DEFAULT 2022,
  PRIMARY KEY (id),
  constraint uk_numeor_card UNIQUE (numero),
  CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);

