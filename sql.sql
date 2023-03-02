CREATE TABLE user(
    pk_id_user        INT             NOT NULL AUTO_INCREMENT,
    nm_user           VARCHAR(255),
    cd_password       VARCHAR(255),
    ds_email          VARCHAR(255),
    dt_born           DATE,
    nm_img            VARCHAR(255),
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