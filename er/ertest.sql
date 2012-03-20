
-- Table Creation --

-- Each entity on the model is represented by a table that needs to be created within the Database.
-- Within SQL new tables are created using the CREATE TABLE command.
-- When a table is created its name and its attributes are defined.
-- The values of which are derived from those specified on the model.
-- Certain constraints are sometimes also specified, such as identification of primary keys.

-- Create a Database table to represent the "customer" entity.
CREATE TABLE customer(
	id	INTEGER NOT NULL,
	first_name	VARCHAR(25) NOT NULL,
	surname	VARCHAR(25) NOT NULL,
	address	VARCHAR(100) NOT NULL,
	postcode	VARCHAR(8) NOT NULL,
	city	VARCHAR(25) NOT NULL,
	email	VARCHAR(50) NOT NULL UNIQUE,
	password	VARCHAR(60) NOT NULL,
	-- Specify the PRIMARY KEY constraint for table "customer".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_customer PRIMARY KEY (id)
);

-- Create a Database table to represent the "product" entity.
CREATE TABLE product(
	product_id	INTEGER NOT NULL,
	prod_type_id	INTEGER NOT NULL,
	name	VARCHAR(50) NOT NULL,
	description	VARCHAR(500),
	release_year	INTEGER,
	publisher	VARCHAR(50),
	image_url	VARCHAR(200),
	language	VARCHAR(50),
	stock_level	INTEGER,
	fk1_prod_type_id	INTEGER NOT NULL,
	fk2_prod_type_id	INTEGER NOT NULL,
	-- Specify the PRIMARY KEY constraint for table "product".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_product PRIMARY KEY (product_id,fk1_prod_type_id,fk2_prod_type_id)
);

-- Create a Database table to represent the "prod_book" entity.
CREATE TABLE prod_book(
	prod_type_id	INTEGER NOT NULL,
	author	VARCHAR(25) NOT NULL,
	page_number	INTEGER,
	isbn_10	INTEGER,
	isbn_13	INTEGER,
	-- Specify the PRIMARY KEY constraint for table "prod_book".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_prod_book PRIMARY KEY (prod_type_id)
);

-- Create a Database table to represent the "prod_film" entity.
CREATE TABLE prod_film(
	prod_type_id	INTEGER NOT NULL,
	director	VARCHAR(25),
	length	BIGINT,
	studio	VARCHAR(25),
	-- Specify the PRIMARY KEY constraint for table "prod_film".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_prod_film PRIMARY KEY (prod_type_id)
);

-- Create a Database table to represent the "customer_order" entity.
CREATE TABLE customer_order(
	order_id	INTEGER NOT NULL,
	cu_id	INTEGER NOT NULL,
	order_placed_date	DATE,
	order_status	INTEGER NOT NULL,
	fk1_id	INTEGER NOT NULL,
	-- Specify the PRIMARY KEY constraint for table "customer_order".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_customer_order PRIMARY KEY (order_id,cu_id)
);

-- Create a Database table to represent the "order_items" entity.
CREATE TABLE order_items(
	cu_order_id	INTEGER NOT NULL,
	cu_product_id	INTEGER NOT NULL,
	quantity	INTEGER NOT NULL,
	fk1_product_id	INTEGER NOT NULL,
	fk1_fk1_prod_type_id	INTEGER NOT NULL,
	fk1_fk2_prod_type_id	INTEGER NOT NULL,
	fk2_order_id	INTEGER NOT NULL,
	fk2_cu_id	INTEGER NOT NULL,
	-- Specify the PRIMARY KEY constraint for table "order_items".
	-- This indicates which attribute(s) uniquely identify each row of data.
	CONSTRAINT	pk_order_items PRIMARY KEY (cu_order_id,cu_product_id)
);

ALTER TABLE product ADD CONSTRAINT fk1_product_to_prod_book FOREIGN KEY(fk1_prod_type_id) REFERENCES prod_book(prod_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Alter table to add new constraints required to implement the "product_prod_film" relationship

-- This constraint ensures that the foreign key of table "product"
-- correctly references the primary key of table "prod_film"

ALTER TABLE product ADD CONSTRAINT fk2_product_to_prod_film FOREIGN KEY(fk2_prod_type_id) REFERENCES prod_film(prod_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Alter table to add new constraints required to implement the "customer_order_customer" relationship

-- This constraint ensures that the foreign key of table "customer_order"
-- correctly references the primary key of table "customer"

ALTER TABLE customer_order ADD CONSTRAINT fk1_customer_order_to_customer FOREIGN KEY(fk1_id) REFERENCES customer(id) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Alter table to add new constraints required to implement the "order_items_product" relationship

-- This constraint ensures that the foreign key of table "order_items"
-- correctly references the primary key of table "product"

ALTER TABLE order_items ADD CONSTRAINT fk1_order_items_to_product FOREIGN KEY(fk1_product_id,fk1_fk1_prod_type_id,fk1_fk2_prod_type_id) REFERENCES product(product_id,fk1_prod_type_id,fk2_prod_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Alter table to add new constraints required to implement the "order_items_customer_order" relationship

-- This constraint ensures that the foreign key of table "order_items"
-- correctly references the primary key of table "customer_order"

ALTER TABLE order_items ADD CONSTRAINT fk2_order_items_to_customer_order FOREIGN KEY(fk2_order_id,fk2_cu_id) REFERENCES customer_order(order_id,cu_id) ON DELETE RESTRICT ON UPDATE RESTRICT;