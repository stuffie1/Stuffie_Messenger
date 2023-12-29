CREATE DATABASE projet_php;
use projet_php;
CREATE TABLE users(
    username varchar(255) ,
    fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    email varchar(255),
    photo text NOT NULL,
    birthdate date,
    statu int(1) ,
    phone varchar(10),
    motpass varchar(255),
);
use projet_php;
CREATE TABLE friendlist(
    username varchar(30) ,
    fname varchar(30) NOT NULL,
    lname varchar(30) NOT NULL,
    photo text NOT NULL,
    statu int(1) ,
    id_user varchar(255),
    PRIMARY KEY (username,id_user)
    FOREIGN KEY(id_user) REFERENCES users(username)
);
use projet_php;

CREATE TABLE messages (
    id_message INT PRIMARY KEY AUTO_INCREMENT,
    message TEXT,
    id_auteur VARCHAR(30),
    id_distinataire VARCHAR(30),
    FOREIGN KEY (id_auteur) REFERENCES users(username),
    FOREIGN KEY (id_distinataire) REFERENCES friendlist(username)
);


SELECT friendlist.username,messages.message
FROM friendlist 
JOIN messages  ON friendlist.username = messages.id_distinataire
WHERE messages.id_message IN (
    SELECT MAX(id_message)
    FROM messages
    WHERE id_distinataire = friendlist.username OR id_auteur = friendlist.username
    GROUP BY CASE
        WHEN id_distinataire = friendlist.username THEN id_auteur
        WHEN id_auteur = friendlist.username THEN id_distinataire
    END
)
ORDER BY messages.id_message DESC;
