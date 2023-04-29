-- Just to test that our database works --
DROP TABLE IF EXISTS test;

CREATE TABLE test(
pk INT NOT NULL,
PRIMARY KEY (pk)
)ENGINE = InnoDB;

INSERT INTO test VALUES (0), (1), (2);