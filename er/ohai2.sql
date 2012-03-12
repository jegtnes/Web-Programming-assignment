CREATE TABLE customer(
	id	INTEGER NOT NULL,
	first_name	VARCHAR(25) NOT NULL,
	last_name	VARCHAR(25) NOT NULL,
	address	VARCHAR(100) NOT NULL,
	postcode	VARCHAR(8) NOT NULL,
	city	VARCHAR(25) NOT NULL,
	email	VARCHAR(50) NOT NULL UNIQUE,
	password	VARCHAR(50) NOT NULL,
	CONSTRAINT	pk_customer PRIMARY KEY (id)
);

CREATE TABLE product(
	product_id	INTEGER NOT NULL,
	type_id	INTEGER NOT NULL,
	name	VARCHAR(50) NOT NULL,
	description	VARCHAR(500),
	release_year	INTEGER,
	publisher	VARCHAR(50),
	image_url	VARCHAR(200),
	language	VARCHAR(50),
	stock_level	INTEGER,
	fk1_prod_book_type_id	INTEGER NOT NULL,
	fk1_book_type	INTEGER NOT NULL,
	fk2_prod_film_type_id	INTEGER NOT NULL,
	CONSTRAINT	pk_product PRIMARY KEY (product_id,type_id,fk1_prod_book_type_id,fk1_book_type,fk2_prod_film_type_id)
);

CREATE TABLE prod_book(
	prod_book_type_id	INTEGER NOT NULL,
	book_type	INTEGER NOT NULL,
	author	VARCHAR(25) NOT NULL,
	page_number	INTEGER,
	isbn_10	INTEGER,
	isbn_13	INTEGER,
	fk1_book_type_id	INTEGER NOT NULL,
	CONSTRAINT	pk_prod_book PRIMARY KEY (prod_book_type_id,book_type)
);

CREATE TABLE prod_film(
	prod_film_type_id	INTEGER NOT NULL,
	film_type	INTEGER,
	director	VARCHAR(25),
	length	BIGINT,
	studio	VARCHAR(25),
	fk1_film_type_id	INTEGER NOT NULL,
	CONSTRAINT	pk_prod_film PRIMARY KEY (prod_film_type_id)
);

CREATE TABLE customer_order(
	order_id	INTEGER NOT NULL,
	cu_id	INTEGER NOT NULL,
	order_placed_date	DATE,
	order_status	INTEGER NOT NULL,
	fk1_id	INTEGER NOT NULL,
	CONSTRAINT	pk_customer_order PRIMARY KEY (order_id,cu_id)
);

CREATE TABLE order_items(
	cu_order_id	INTEGER NOT NULL,
	cu_product_id	INTEGER NOT NULL,
	quantity	INTEGER NOT NULL,
	fk1_product_id	INTEGER NOT NULL,
	fk1_type_id	INTEGER NOT NULL,
	fk1_fk1_prod_book_type_id	INTEGER NOT NULL,
	fk1_fk1_book_type	INTEGER NOT NULL,
	fk1_fk2_prod_film_type_id	INTEGER NOT NULL,
	fk2_order_id	INTEGER NOT NULL,
	fk2_cu_id	INTEGER NOT NULL,

	CONSTRAINT	pk_order_items PRIMARY KEY (cu_order_id,cu_product_id)
);

CREATE TABLE book_type(
	book_type_id	INTEGER NOT NULL,
	book_type_name	VARCHAR(8),
	CONSTRAINT	pk_book_type PRIMARY KEY (book_type_id)
);

CREATE TABLE film_type(
	film_type_id	INTEGER NOT NULL,
	film_type_name	VARCHAR(8),
	CONSTRAINT	pk_film_type PRIMARY KEY (film_type_id)
);

ALTER TABLE product ADD CONSTRAINT fk1_product_to_prod_book FOREIGN KEY(fk1_prod_book_type_id,fk1_book_type) REFERENCES prod_book(prod_book_type_id,book_type) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE product ADD CONSTRAINT fk2_product_to_prod_film FOREIGN KEY(fk2_prod_film_type_id) REFERENCES prod_film(prod_film_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE customer_order ADD CONSTRAINT fk1_customer_order_to_customer FOREIGN KEY(fk1_id) REFERENCES customer(id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE order_items ADD CONSTRAINT fk1_order_items_to_product FOREIGN KEY(fk1_product_id,fk1_type_id,fk1_fk1_prod_book_type_id,fk1_fk1_book_type,fk1_fk2_prod_film_type_id) REFERENCES product(product_id,type_id,fk1_prod_book_type_id,fk1_book_type,fk2_prod_film_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE order_items ADD CONSTRAINT fk2_order_items_to_customer_order FOREIGN KEY(fk2_order_id,fk2_cu_id) REFERENCES customer_order(order_id,cu_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE prod_book ADD CONSTRAINT fk1_prod_book_to_book_type FOREIGN KEY(fk1_book_type_id) REFERENCES book_type(book_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE prod_film ADD CONSTRAINT fk1_prod_film_to_film_type FOREIGN KEY(fk1_film_type_id) REFERENCES film_type(film_type_id) ON DELETE RESTRICT ON UPDATE RESTRICT;