create database new_db;

use new_db;

create table users (
id int unsigned primary key auto_increment,
full_name varchar(255) not null
);

create table transactions (
id int unsigned primary key auto_increment,
user_id int unsigned not null default 0,
`date` int not null,
`check` varchar(4),
description text not null,
amount decimal(6,2) not null,
foreign key (user_id) references users(id)
);

