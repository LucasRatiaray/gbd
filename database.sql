CREATE TABLE `depenses` (
  id INT PRIMARY KEY,
  titre varchar(255) NOT NULL,
  prix FLOAT NOT NULL
);


CREATE TABLE task (
  id INT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
