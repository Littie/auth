CREATE DATABASE IF NOT EXISTS `mvc.local` CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

use `mvc.local`;

create table users
(
    id         int unsigned auto_increment
        primary key,
    first_name varchar(128) null,
    last_name  varchar(128) null,
    email      varchar(128) not null,
    phone      varchar(64)  null,
    password   varchar(256) not null,
    constraint email
        unique (email)
);
