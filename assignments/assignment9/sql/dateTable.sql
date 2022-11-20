CREATE TABLE notes
(
    id int NOT NULL AUTO_INCREMENT,
    timestamp char(50) NOT NULL,
    content char(50) NULL,
    PRIMARY KEY(id)
 ) ENGINE=InnoDB