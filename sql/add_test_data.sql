insert into person (lastname, firstname, phone, mail, username, password) values 
('Testaaja', 'Tiina', '0505551111', 'tiina@mail.fi', 'testtiin', 'SyksyTalvi1'),
('Testaaja', 'Taavi', '0505551112', 'taavi@mail.fi', 'testtaav', 'SyksyTalvi2');

insert into category (category_name, category_description, personid) values
('Työ', 'Työhön liittyvät tehtävät', (select id from person where username = 'testtiin')),
('Koulu', 'Kouluun liittyvät tehtävät', (select id from person where username = 'testtiin')),
('Koti', 'Kotiin liittyvät tehtävät', (select id from person where username = 'testtiin')),
('Opiskelu', 'Opiskeluun liittyvät tehtävät', (select id from person where username = 'testtaav')),
('Harrastus', 'Harrastuksiin liittyvät tehtävät', (select id from person where username = 'testtaav'));

insert into importance (importance_value, importance_description, personid) values
('1', 'Tee heti', (select id from person where username = 'testtiin')),
('2', 'Tee sitten, kun kaikki ykköset on tehty', (select id from person where username = 'testtiin')),
('1', 'Tärkeä', (select id from person where username = 'testtaav')),
('2', 'Melko tärkeä', (select id from person where username = 'testtiin')),
('3', 'Tee, kun huvittaa', (select id from person where username = 'testtiin'));

insert into task (task_name, task_status, task_description, task_category, task_importance, deadline, personid) values
('Soita Matille', 'Avoin', 'Kerro miten toimitaan', (select id from category where category_name = 'Työ'), '20160813', (select id from importance where importance_value = '1'), (select id from person where username = 'testtiin')),
('Vastaa Pirjolle', 'Avoin', 'Vastaa Pirjon mailiin', (select id from category where category_name = 'Työ'), '20160815', (select id from importance where importance_value = '2'), (select id from person where username = 'testtiin')),
('TNL laskarit', 'Kesken', 'Tee TNL laskarit', (select id from category where category_name = 'Opiskelu'), '20160810', (select id from importance where importance_value = '1'), (select id from person where username = 'testtaav'));
