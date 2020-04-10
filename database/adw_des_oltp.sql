SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS adw_des_oltp DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE appify16_des_oltp;

DROP TABLE IF EXISTS adw_credits;
CREATE TABLE adw_credits (
  credits_id int(11) NOT NULL,
  persons_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  description varchar(255) DEFAULT NULL,
  amount int(11) NOT NULL,
  credit_date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS adw_credit_return;
CREATE TABLE adw_credit_return (
  credit_return_id int(11) NOT NULL,
  persons_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  credits_id int(11) DEFAULT NULL,
  amount_returned int(11) NOT NULL,
  return_date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS adw_credit_return_old;
CREATE TABLE adw_credit_return_old (
  credit_return_id int(11) NOT NULL,
  persons_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  amount_returned int(11) NOT NULL,
  return_date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS adw_persons;
CREATE TABLE adw_persons (
  persons_id int(11) NOT NULL,
  person_name varchar(150) NOT NULL,
  person_contact_details varchar(255) DEFAULT NULL,
  user_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS adw_txn_main;
CREATE TABLE adw_txn_main (
  txn_main_id int(11) NOT NULL,
  txn_type_id int(11) DEFAULT NULL,
  txn_description varchar(255) DEFAULT NULL,
  txn_value int(11) NOT NULL,
  txn_attachment varchar(500) DEFAULT NULL,
  txn_date date NOT NULL,
  user_id int(11) NOT NULL,
  audit_modified_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS adw_txn_type;
CREATE TABLE adw_txn_type (
  txn_type_id int(11) NOT NULL,
  txn_typename varchar(100) NOT NULL,
  txn_flow enum('expense','earning') NOT NULL,
  user_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(1, 'Expense - General', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(2, 'Expense - Travel & Fuel', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(3, 'Expense - Food', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(4, 'Expense - Bill & Recharge', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(5, 'Expense - Rent', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(9, 'Earning - General', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(10, 'Earning - Salary', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(11, 'Earning - Work', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(13, 'Expense - Clothing & Acc', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(15, 'Expense - Health & Medicines', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(16, 'Expense - Gift', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(18, 'Expense - Work', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(19, 'Expense - Repairing', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(20, 'Expense - Room', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(21, 'Expense - Donation', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(22, 'Expense - Investment', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(23, 'Expense - Electronics & IT', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(24, 'Expense - Books, Stationary & Education', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(25, 'Expense - Entertainment', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(26, 'Expense - Food', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(28, 'Expense - Cosmetics/Grooming', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(29, 'Expense - Fine', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(31, 'Expense - Official Works', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(32, 'Earning - Cashback', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(34, 'Expense - Home & Furniture', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(35, 'Earning - Investment Returns', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(37, 'Earning - Gift', 'earning', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(38, 'Expense - Miscellaneous Or Other', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(39, 'Expense - Servant Salary', 'expense', 1);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(40, 'Expense - Petrol', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(41, 'Expense - Clothing', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(42, 'Expense - Lifestyle', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(43, 'Earning - General', 'earning', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(44, 'Expense - Education', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(45, 'Expense - Stationary', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(46, 'Expense - Medical', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(47, 'Expense - Travel', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(48, 'Expense - Bills & Recharge', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(49, 'Expense - Rent', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(50, 'Expense - Entertainment', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(51, 'Expense - Miscellaneous', 'expense', 2);
INSERT INTO adw_txn_type (txn_type_id, txn_typename, txn_flow, user_id) VALUES(52, 'Expense - Bad Credit', 'expense', 1);

DROP TABLE IF EXISTS adw_user;
CREATE TABLE adw_user (
  user_id int(11) NOT NULL,
  name varchar(50) DEFAULT NULL,
  username varchar(50) NOT NULL,
  password varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO adw_user (user_id, `name`, username, `password`) VALUES(1, 'Demo User', 'admin', 'pass');
DROP VIEW IF EXISTS `v_earning`;
CREATE TABLE `v_earning` (
`txn_main_id` int(11)
,`txn_typename` varchar(100)
,`txn_description` varchar(255)
,`txn_value` int(11)
,`txn_date` date
,`user_id` int(11)
);
DROP VIEW IF EXISTS `v_expense`;
CREATE TABLE `v_expense` (
`txn_main_id` int(11)
,`txn_typename` varchar(100)
,`txn_description` varchar(255)
,`txn_value` int(11)
,`txn_date` date
,`user_id` int(11)
);
DROP VIEW IF EXISTS `v_external`;
CREATE TABLE `v_external` (
`txn_value` decimal(32,0)
,`txn_month` date
);
DROP VIEW IF EXISTS `v_olap_txn_all`;
CREATE TABLE `v_olap_txn_all` (
`txn_main_id` int(11)
,`txn_type_id` int(11)
,`txn_typename_raw` varchar(100)
,`txn_typename` varchar(100)
,`txn_flow` enum('expense','earning')
,`txn_description` varchar(255)
,`txn_value` int(11)
,`txn_date` date
,`user_id` int(11)
,`audit_modified_date` timestamp
);
DROP VIEW IF EXISTS `v_txn_all`;
CREATE TABLE `v_txn_all` (
`txn_main_id` int(11)
,`txn_type_id` int(11)
,`txn_typename` varchar(100)
,`txn_description` varchar(255)
,`txn_value` int(11)
,`txn_date` date
,`user_id` int(11)
);
DROP TABLE IF EXISTS `v_earning`;

CREATE VIEW v_earning  AS  select A.txn_main_id AS txn_main_id,B.txn_typename AS txn_typename,A.txn_description AS txn_description,A.txn_value AS txn_value,A.txn_date AS txn_date,A.user_id AS user_id from (adw_txn_main A join adw_txn_type B on((A.txn_type_id = B.txn_type_id))) where (B.txn_flow = 'earning') ;
DROP TABLE IF EXISTS `v_expense`;

CREATE VIEW v_expense  AS  select A.txn_main_id AS txn_main_id,B.txn_typename AS txn_typename,A.txn_description AS txn_description,A.txn_value AS txn_value,A.txn_date AS txn_date,A.user_id AS user_id from (adw_txn_main A join adw_txn_type B on((A.txn_type_id = B.txn_type_id))) where (B.txn_flow = 'expense') ;
DROP TABLE IF EXISTS `v_external`;

CREATE VIEW v_external  AS  select sum(a.txn_value) AS txn_value,str_to_date(concat(year(a.txn_date),'-',month(a.txn_date),'-01'),'%Y-%m-%d') AS txn_month from v_expense a where ((1 = 1) and (a.user_id = 1) and (a.txn_date between '2018-01-01' and '2019-01-31')) group by concat(year(a.txn_date),'-',month(a.txn_date),'-31') ;
DROP TABLE IF EXISTS `v_olap_txn_all`;

CREATE VIEW v_olap_txn_all  AS  select A.txn_main_id AS txn_main_id,B.txn_type_id AS txn_type_id,B.txn_typename AS txn_typename_raw,(case when (right(B.txn_typename,(length(B.txn_typename) - (locate(' - ',B.txn_typename) + 2))) = 'Share Market') then 'Investment' else right(B.txn_typename,(length(B.txn_typename) - (locate(' - ',B.txn_typename) + 2))) end) AS txn_typename,B.txn_flow AS txn_flow,A.txn_description AS txn_description,A.txn_value AS txn_value,A.txn_date AS txn_date,A.user_id AS user_id,A.audit_modified_date AS audit_modified_date from (adw_txn_main A join adw_txn_type B on(((A.txn_type_id = B.txn_type_id) and (A.user_id = B.user_id)))) ;
DROP TABLE IF EXISTS `v_txn_all`;

CREATE VIEW v_txn_all  AS  select A.txn_main_id AS txn_main_id,B.txn_type_id AS txn_type_id,B.txn_typename AS txn_typename,A.txn_description AS txn_description,A.txn_value AS txn_value,A.txn_date AS txn_date,A.user_id AS user_id from (adw_txn_main A join adw_txn_type B on(((A.txn_type_id = B.txn_type_id) and (A.user_id = B.user_id)))) ;


ALTER TABLE adw_credits
  ADD PRIMARY KEY (credits_id),
  ADD KEY fk_adw_persons_persons_id_idx (persons_id),
  ADD KEY fk_adw_user_user_id_idx (user_id);

ALTER TABLE adw_credit_return
  ADD PRIMARY KEY (credit_return_id),
  ADD KEY fk_credit_return_persons_id (persons_id),
  ADD KEY fk_credit_return_user_id (user_id),
  ADD KEY fk_credit_return_credits_id (credits_id);

ALTER TABLE adw_credit_return_old
  ADD PRIMARY KEY (credit_return_id),
  ADD KEY fk_adw_persons_persons_id_idx (persons_id),
  ADD KEY fk_adw_user_user_id_idx (user_id);

ALTER TABLE adw_persons
  ADD PRIMARY KEY (persons_id),
  ADD UNIQUE KEY person_name_UNIQUE (person_name),
  ADD KEY fk_persons_user_user_id_idx (user_id);

ALTER TABLE adw_txn_main
  ADD PRIMARY KEY (txn_main_id),
  ADD KEY txn_type_id_idx (txn_type_id),
  ADD KEY fk_adw_user_user_id_idx (user_id);

ALTER TABLE adw_txn_type
  ADD PRIMARY KEY (txn_type_id),
  ADD KEY fk_adw_user_user_id_idx (user_id);

ALTER TABLE adw_user
  ADD PRIMARY KEY (user_id);


ALTER TABLE adw_credits
  MODIFY credits_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adw_credit_return
  MODIFY credit_return_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adw_credit_return_old
  MODIFY credit_return_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adw_persons
  MODIFY persons_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adw_txn_main
  MODIFY txn_main_id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adw_txn_type
  MODIFY txn_type_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE adw_user
  MODIFY user_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE adw_credits
  ADD CONSTRAINT fk_credits_persons_persons_id FOREIGN KEY (persons_id) REFERENCES adw_persons (persons_id) ON UPDATE CASCADE,
  ADD CONSTRAINT fk_credits_user_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id) ON UPDATE CASCADE;

ALTER TABLE adw_credit_return
  ADD CONSTRAINT fk_credit_return_credits_id FOREIGN KEY (credits_id) REFERENCES adw_credits (credits_id),
  ADD CONSTRAINT fk_credit_return_persons_id FOREIGN KEY (persons_id) REFERENCES adw_persons (persons_id),
  ADD CONSTRAINT fk_credit_return_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id);

ALTER TABLE adw_credit_return_old
  ADD CONSTRAINT fk_credit_return_persons_persons_id FOREIGN KEY (persons_id) REFERENCES adw_persons (persons_id) ON UPDATE CASCADE,
  ADD CONSTRAINT fk_credit_return_user_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id) ON UPDATE CASCADE;

ALTER TABLE adw_persons
  ADD CONSTRAINT fk_persons_user_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id) ON UPDATE CASCADE;

ALTER TABLE adw_txn_main
  ADD CONSTRAINT fk_txn_main_txn_tye_txn_type_id FOREIGN KEY (txn_type_id) REFERENCES adw_txn_type (txn_type_id) ON UPDATE CASCADE,
  ADD CONSTRAINT fk_txn_main_user_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id) ON UPDATE CASCADE;

ALTER TABLE adw_txn_type
  ADD CONSTRAINT fk_txn_type_user_user_id FOREIGN KEY (user_id) REFERENCES adw_user (user_id) ON UPDATE CASCADE;

