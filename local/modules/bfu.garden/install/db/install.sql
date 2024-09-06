CREATE TABLE IF NOT EXISTS `buildings`
(
    `BUILDING_ID`   INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `BUILDING_NAME` VARCHAR(255)       NOT NULL
);

CREATE TABLE IF NOT EXISTS `communications`
(
    `COMMUNICATION_ID`   INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `COMMUNICATION_NAME` VARCHAR(255)       NOT NULL
);

CREATE TABLE IF NOT EXISTS `people`
(
    `PERSON_ID`   INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `PERSON_NAME` VARCHAR(255)       NOT NULL,
    `PERSON_SURNAME` VARCHAR(255)       NOT NULL
);

CREATE TABLE IF NOT EXISTS `contributions`
(
    `CONTRIBUTION_ID` INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `CONTRIBUTOR_ID`  INT                NOT NULL,
    `PAYMENT_DATE`    DATE               NOT NULL,
    `PAYMENT_SUM`     DECIMAL            NOT NULL
);

CREATE TABLE IF NOT EXISTS `contributions_by_year`
(
    `CONTRIBUTION_ID`      INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `CONTRIBUTOR_ID`       INT                NOT NULL,
    `CONTRIBUTION_YEAR`    INT               NOT NULL,
    `SUM_OF_CONTRIBUTIONS` DECIMAL            NULL
);

CREATE TABLE IF NOT EXISTS `garden_plot`
(
    `PLOT_ID`            INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    `OWNER_ID`           INT                NULL,
    `PLOT_SIZE`          FLOAT              NOT NULL,
    `HAS_BUILDINGS`      TINYINT(1)         NOT NULL,
    `HAS_COMMUNICATIONS` TINYINT(1)         NOT NULL,
    `PURCHASE_DATE`      DATE,
    `SALE_DATE`          DATE
);

CREATE TABLE IF NOT EXISTS `plot_building`
(
    `PLOT_ID`     INT NOT NULL,
    `BUILDING_ID` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `plot_communication`
(
    `PLOT_ID`          INT NOT NULL,
    `COMMUNICATION_ID` INT NOT NULL
);

INSERT INTO people (PERSON_ID, PERSON_NAME, PERSON_SURNAME)
VALUES (1, 'Денис','Глушков'),
       (2, 'Алексей', 'Иванов'),
       (3, 'Артём', 'Сидоров'),
       (4, 'Андрей', 'Петров'),
       (5, 'Максим', 'Захаров'),
       (6, 'Алексей', 'Фёдоров');

INSERT INTO communications (COMMUNICATION_ID, COMMUNICATION_NAME)
VALUES (1, 'Электричество'),
       (2, 'Газ'),
       (3, 'Водоснабжение');

INSERT INTO buildings (BUILDING_ID, BUILDING_NAME)
VALUES (1, 'Дом'),
       (2, 'Гараж'),
       (3, 'Сарай'),
       (4, 'Беседка');


INSERT INTO garden_plot (PLOT_ID,
                         OWNER_ID,
                         PLOT_SIZE,
                         HAS_BUILDINGS,
                         HAS_COMMUNICATIONS,
                         PURCHASE_DATE,
                         SALE_DATE)
VALUES (1, 1, 2.3, true, true, '2015-02-01', '2018-10-15'),
       (2, 5, 3.2, true, false, '2012-03-31', '2016-05-02'),
       (3, 4, 1.8, false, false, '2001-07-09', '2016-11-22'),
       (4, 2, 1.5, false, true, '2019-01-15', '2021-01-14'),
       (5, 3, 2.5, false, true, '2019-08-11', '2023-12-18'),
       (6, 3, 3.1, true, false, '2015-09-24', '2015-01-01'),
       (7, 1, 2.0, false, false, '2007-06-13', '2018-07-07');

INSERT INTO plot_building (PLOT_ID, BUILDING_ID)
VALUES (1, 1),
       (1, 2),
       (2, 3),
       (2, 1),
       (6, 1),
       (6, 2),
       (6, 3);

INSERT INTO plot_communication (PLOT_ID, COMMUNICATION_ID)
VALUES (1, 1),
       (1, 2),
       (1, 3),
       (4, 3),
       (4, 1),
       (5, 1);

INSERT INTO contributions (CONTRIBUTION_ID, CONTRIBUTOR_ID, PAYMENT_DATE, PAYMENT_SUM)
VALUES (1, 1, '2016-05-25', 2000),
       (2, 1, '2016-07-28', 1500),
       (3, 2, '2013-01-13', 7000),
       (4, 3, '2007-03-23', 2800),
       (5, 3, '2007-04-27', 4600),
       (6, 4, '2020-09-29', 4300),
       (7, 5, '2022-11-20', 1100),
       (8, 6, '2019-12-25', 3100);

INSERT INTO contributions_by_year (CONTRIBUTION_ID, CONTRIBUTOR_ID, CONTRIBUTION_YEAR, SUM_OF_CONTRIBUTIONS)
VALUES (1, 1, '2016', 3500),
       (2, 2, '2013', 7000),
       (3, 3, '2007', 7400),
       (4, 4, '2020', 4300),
       (5, 5, '2022', 1100),
       (6, 6, '2019', 3100);