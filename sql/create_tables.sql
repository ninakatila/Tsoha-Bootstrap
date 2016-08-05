CREATE TABLE person (
id serial PRIMARY KEY,
lastname varchar (80),
firstname varchar (80),
phone varchar (14),
mail varchar (80),
username varchar (12) UNIQUE,
password varchar (12));

CREATE TABLE category (
id serial PRIMARY KEY,
category_name varchar(20),
category_description varchar (400),
personid integer REFERENCES person(id) ON DELETE CASCADE);

CREATE TABLE importance (
id serial PRIMARY KEY,
importance_value integer,
importance_description varchar (400),
personid integer REFERENCES person(ID) ON DELETE CASCADE);

CREATE TABLE task (
id serial primary key,
task_name varchar (80),
task_status varchar (80),
task_description varchar (1200),
deadline date,
task_category integer REFERENCES category (id) ON DELETE CASCADE,
task_importance integer REFERENCES importance (id) ON DELETE CASCADE,
personid integer REFERENCES person(ID) ON DELETE CASCADE);

CREATE TABLE categorize (
taskid integer REFERENCES task (id) ON DELETE CASCADE,
categoryid integer REFERENCES category (id) ON DELETE CASCADE);