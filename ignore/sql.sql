CREATE TABLE user(
    pk_id_user        INT             NOT NULL AUTO_INCREMENT,
    nm_user           VARCHAR(255),
    cd_password       VARCHAR(255),
    ds_email          VARCHAR(255),
    dt_born           DATE,
    nm_img            VARCHAR(255), 'Identifies which image is in the dirtiest scheme'
    cd_cep            VARCHAR(255),
    ds_country        VARCHAR(255),
    ds_state          VARCHAR(255),
    ds_city           VARCHAR(255),
    ds_address        VARCHAR(255),
    nr_address        INT,

    dt_creation       DATE,
    dt_update         DATE,

    PRIMARY KEY(pk_id_user)
);

INSERT INTO user 
VALUES(0, 'sus','suspass','suspass','2012-01-01','dsa','dasd','dsa','dasd','dsa','dasd',32,'2012-01-01','2012-01-01');

CREATE TABLE market(
    pk_id_market        INT             NOT NULL AUTO_INCREMENT,
    nm_market           VARCHAR(255),
    ds_email            VARCHAR(255),
    nm_img              VARCHAR(255), 'Identifies which image is in the dirtiest scheme'
    dt_market_creation  DATE,
    ds_market           VARCHAR(255),
    ie_status           VARCHAR(255), 'Active or Inactive'
    
    dt_creation         DATE,
    dt_update           DATE,

    PRIMARY KEY(pk_id_market)
);
