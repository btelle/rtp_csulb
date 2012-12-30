
INSERT INTO tblcampus_section (id, section) VALUES
    (1, 'South Campus'),
    (3, 'North East Campus'),
    (2, 'North West Campus');

INSERT INTO tbllocation (id, location, section, important) VALUES
    (1, 'International House', 2, 0),
    (2, 'Soroptomist House', 2, 0),
    (3, 'Kinesiology', 2, 0),
    (4, 'Horn Center', 3, 1),
    (5, 'Dining Plaza', 1, 0),
    (6, 'University Student Union', 1, 1),
    (7, 'Book Store', 1, 1),
    (8, 'Psychology', 1, 0),
    (9, 'Library', 1, 1),
    (10, 'Multi Media Center', 1, 0),
    (11, 'McIntosh Humanities Building', 1, 0),
    (12, 'Student Theater', 1, 0),
    (13, 'College of Natural Sciences', 1, 0),
    (14, 'Faculty Offices', 1, 0),
    (15, 'College of Fine Arts', 1, 0),
    (16, 'Health and Human Services', 3, 0),
    (17, 'Engineering Technology', 3, 0),
    (18, 'Swimming Pool', 3, 0),
    (19, 'Basketball Courts', 3, 0),
    (20, 'Student Recreational & Wellness Center', 3, 1),
    (21, 'Soccer Field', 3, 0),
    (22, 'University Print Shop', 3, 0),
    (23, 'University Music Center', 3, 0),
    (24, 'Carpenter Performing Arts Center', 3, 1),
    (25, 'Pyramid', 2, 1),
    (26, 'Recycling Center', 2, 0),
    (27, 'Parkside Commons and Housing', 2, 1),
    (28, 'Parking Transportation Services', 2, 0),
    (29, 'College of Business Administration', 2, 0),
    (30, 'Brotman Hall', 2, 1),
    (31, 'Student Health Center', 2, 0),
    (32, 'Los Alamitos Hall', 2, 0),
    (33, 'Residence Housing & Commons', 2, 0),
    (34, 'Barrett Admin Center', 2, 0),
    (35, 'Facilities', 3, 0),
    (36, 'Corporate Yard', 3, 0),
    (37, 'Design', 3, 0),
    (38, 'Social Sciences', 1, 0),
    (39, 'Child Development Center', 2, 1),
    (40, 'Housing & Residential Life', 2, 0),
    (41, 'Visitor Center', 2, 1),
    (42, 'College of Nursing', 2, 0),
    (43, 'College of Health and Consumer Sciences', 2, 0),
    (44, 'University Art Museum', 2, 0),
    (45, 'Police Substation', 1, 0),
    (46, 'College of Liberal Arts', 1, 0),
    (47, 'KKJZ K-Jazz Radio', 1, 0),
    (48, 'Academic Services', 1, 0),
    (49, 'College of Education', 1, 0),
    (50, 'University Police', 3, 1),
    (51, 'Tennis Courts', 3, 0),
    (52, 'Dance Center', 3, 0),
    (53, 'Track and Field', 2, 0),
    (54, 'Softball Fields', 3, 0),
    (55, 'Recieving', 3, 0),
    (56, 'Mail Services', 3, 0),
    (57, 'Foundation', 3, 0),
    (58, 'The Outpost', 3, 0),
    (59, 'Language Arts Buildings', 1, 0),
    (60, 'Japanese Gardens', 2, 0),
    (61, 'Los Cerritos Hall', 2, 0),
    (62, 'Baseball Field', 2, 0);

INSERT INTO tblspace_type (id, type, full_text) VALUES
(1, 'general', 'General Spaces'),
(2, 'employee', 'Employee Spaces'),
(3, 'carpool', 'General Carpool Space'),
(4, 'disabled', 'Disabled Spaces'),
(5, 'motorcycle', 'Motorcyce Parking Area'),
(6, 'employee_carpool', 'Employee Carpool Spaces'),
(7, 'state', 'State Vehicle Spaces'),
(8, 'metered', 'Metered Spaces'),
(9, 'limited', 'Limited Time Spaces'),
(10, 'special', 'Special Spaces'),
(11, 'resident', 'Resident Spaces'),
(12, 'zip', 'Zip Car Spaces'),
(13, '10_min', 'Public 10 Min. Spaces'),
(14, 'reserved', 'Reserved Spaces'),
(15, 'cdc', 'CDC Spaces');

INSERT INTO tbllot (id, type, struct_nm, struct_flr, open_time, close_time, img, classname) VALUES
    (1, 'Lot 1', NULL, NULL, '00:00:00', '23:59:59', 'lot_01.jpg', 'lot1'),
    (2, 'Lot 3', NULL, NULL, '06:00:00', '23:59:59', 'lot_03.jpg', 'lot3'),
    (3, 'Lot 4', NULL, NULL, '06:00:00', '23:59:59', 'lot_04.jpg', 'lot4'),
    (4, 'Lot 5', NULL, NULL, '06:00:00', '23:59:59', 'lot_05.jpg', 'lot5'),
    (5, 'Lot 6', NULL, NULL, '06:00:00', '23:59:59', 'lot_06.jpg', 'lot6'),
    (6, 'Lot 7', NULL, NULL, '06:00:00', '23:59:59', 'lot_07.jpg', 'lot7'),
    (7, 'Lot 8', NULL, NULL, '06:00:00', '23:59:59', 'lot_08.jpg', 'lot8'),
    (8, 'Lot 8A', NULL, NULL, '06:00:00', '23:59:59', 'lot_08a.jpg', 'lot8a'),
    (9, 'Lot 9', NULL, NULL, '06:00:00', '23:59:59', 'lot_09.jpg', 'lot9'),
    (10, 'Lot 10', NULL, NULL, '06:00:00', '23:59:59', 'lot_10.jpg', 'lot10'),
    (11, 'Lot 11A', NULL, NULL, '06:00:00', '23:59:59', 'lot_11a.jpg', 'lot11a'),
    (12, 'Lot 11B', NULL, NULL, '06:00:00', '23:59:59', 'lot_11b.jpg', 'lot11b'),
    (13, 'Lot 11C', NULL, NULL, '06:00:00', '23:59:59', 'lot_11c.jpg', 'lot11c'),
    (14, 'Lot 12', NULL, NULL, '06:00:00', '23:59:59', 'lot_12.jpg', 'lot12'),
    (15, 'Lot 13', NULL, NULL, '06:00:00', '23:59:59', 'lot_13.jpg', 'lot13'),
    (16, 'Lot 14A', NULL, NULL, '00:00:00', '23:59:59', 'lot_14a.jpg', 'lot14a'),
    (17, 'Lot 14B', NULL, NULL, '00:00:00', '23:59:59', 'lot_14b.jpg', 'lot14b'),
    (18, 'Lot 14C', NULL, NULL, '00:00:00', '23:59:59', 'lot_14c.jpg', 'lot14c'),
    (19, 'Lot 14D', NULL, NULL, '00:00:00', '23:59:59', 'lot_14d.jpg', 'lot14d'),
    (20, 'Lot 15', NULL, NULL, '06:00:00', '23:59:59', 'lot_15.jpg', 'lot15'),
    (21, 'Lot 16', NULL, NULL, '00:00:00', '23:59:59', 'lot_16.jpg', 'lot16'),
    (22, 'Lot 17', NULL, NULL, '06:00:00', '23:59:59', 'lot_17.jpg', 'lot17'),
    (23, 'Lot 18', NULL, NULL, '06:00:00', '23:59:59', 'lot_18.jpg', 'lot18'),
    (24, 'Lot 19', NULL, NULL, '00:00:00', '23:59:59', 'lot_19.jpg', 'lot19'),
    (25, 'Lot 20', NULL, NULL, '00:00:00', '23:59:59', 'lot_20.jpg', 'lot20'),
    (26, 'Structure 1', '1', '1', '06:00:00', '23:59:59', 'struct_1.jpg', 'struct1'),
    (30, 'Structure 2', '2', '1', '06:00:00', '23:59:59', 'struct_2.jpg', 'struct2'),
    (34, 'Structure 3', '3', '1', '06:00:00', '23:59:59', 'struct_3.jpg', 'struct3'),
    (38, 'PPFM', NULL, NULL, '06:00:00', '23:59:59', 'default.png', 'lotppfm'),
    (39, 'State Univ. Dr', NULL, NULL, '06:00:00', '23:59:59', 'state_drive.jpg', 'lotstateunivdr'),
    (40, 'S. Campus Dr', NULL, NULL, '06:00:00', '23:59:59', 'south_campus_drive.jpg', 'lotcampusdr'),
    (41, 'S. Turn Around', NULL, NULL, '06:00:00', '23:59:59', 'south_campus_drive.jpg', 'lotturnaround'),
    (42, 'CDC', NULL, NULL, '06:00:00', '23:59:59', 'cdc.jpg', 'lotcdc'),
    (43, 'Dorms', NULL, NULL, '06:00:00', '23:59:59', 'ho_dorms.jpg', 'lotdorms');

INSERT INTO tblspace (lot_id, type, capacity) VALUES 
    (1, 'general', 211),
    (1, 'employee', 30),
    (1, 'carpool', 8),
    (1, 'disabled', 7),
    (1, 'state', 1),
    (1, 'metered', 14),
    (1, 'limited', 1),
    (2, 'employee', 269),
    (2, 'disabled', 11),
    (2, 'motorcycle', 1),
    (2, 'state', 4),
    (2, 'special', 10),
    (2, 'zip', 2),
    (3, 'employee', 105),
    (3, 'disabled', 7),
    (3, 'motorcycle', 1),
    (3, 'employee_carpool', 5),
    (3, 'special', 3),
    (4, 'employee', 197),
    (4, 'disabled', 14),
    (4, 'motorcycle', 1),
    (4, 'employee_carpool', 2),
    (5, 'employee', 177),
    (5, 'disabled', 10),
    (5, 'employee_carpool', 7),
    (5, 'state', 2),
    (6, 'employee', 202),
    (6, 'disabled', 4),
    (6, 'motorcycle', 1),
    (6, 'employee_carpool', 5),
    (7, 'employee', 87),
    (7, 'disabled', 4),
    (7, 'employee_carpool', 2),
    (8, 'employee', 12),
    (8, 'employee_carpool', 7),
    (8, 'metered', 18),
    (9, 'employee', 243),
    (9, 'disabled', 8),
    (9, 'motorcycle', 1),
    (9, 'employee_carpool', 6),
    (10, 'employee', 70),
    (10, 'disabled', 3),
    (10, 'motorcycle', 1),
    (10, 'state', 1),
    (11, 'general', 290),
    (11, 'disabled', 8),
    (12, 'general', 216),
    (12, 'employee', 46),
    (13, 'employee', 47),
    (13, 'disabled', 4),
    (13, 'state', 8),
    (13, 'limited', 3),
    (14, 'general', 546),
    (14, 'employee', 44),
    (14, 'disabled', 39),
    (14, 'motorcycle', 1),
    (14, 'state', 1),
    (14, 'metered', 2),
    (15, 'general', 279),
    (15, 'employee', 17),
    (15, 'disabled', 40),
    (15, 'state', 2),
    (15, 'metered', 4),
    (16, 'general', 1079),
    (16, 'employee', 18),
    (16, 'disabled', 2),
    (17, 'general', 733),
    (17, 'employee', 17),
    (17, 'disabled', 1),
    (17, 'metered', 8),
    (18, 'general', 999),
    (18, 'state', 2),
    (18, 'zip', 2),
    (19, 'disabled', 2), 
    (19, 'motorcycle', 1),
    (19, 'resident', 70),
    (20, 'employee', 68),
    (20, 'disabled', 5),
    (20, 'state', 2),
    (20, 'metered', 27),
    (20, '10_min', 17),
    (21, 'general', 466),
    (21, 'disabled', 6),
    (21, 'metered', 7),
    (22, 'employee', 115),
    (22, 'carpool', 189),
    (22, 'disabled', 8), 
    (22, 'state', 1),
    (22, 'metered', 119),
    (22, 'reserved', 21),
    (23, 'employee', 251),
    (23, 'disabled', 7),
    (23, 'limited', 3),
    (24, 'disabled', 4),
    (24, 'metered', 2),
    (24, 'resident', 93),
    (25, 'general', 419),
    (26, 'general', 2635),
    (26, 'disabled', 38), 
    (26, 'motorcycle', 1),
    (26, 'state', 13),
    (30, 'general', 1200),
    (30, 'carpool', 52),
    (30, 'disabled', 6), 
    (30, 'motorcycle', 1),
    (30, 'state', 8),
    (34, 'general', 1275),
    (34, 'disabled', 23), 
    (34, 'motorcycle', 1),
    (38, 'disabled', 1),
    (38, 'metered', 4),
    (38, 'limited', 2),
    (39, 'state', 4),
    (39, 'metered', 38),
    (40, 'metered', 22),
    (41, 'employee', 30),
    (41, 'disabled', 4),
    (41, 'state', 2),
    (41, 'metered', 8),
    (42, 'disabled', 2),
    (42, 'cdc', 23),
    (43, 'disabled', 4),
    (43, 'metered', 3),
    (43, 'limited', 2),
    (43, 'special', 10);


INSERT INTO tblusers (uid, uname, pwd, name, role, user_typ, acct_stts, created_dt, space_type, lot_id, pref_location, email_alert) VALUES
    (1,'Christopher.Hines@student.csulb.edu', MD5('Christopher.Hines'), 'Chris', 1, 'Student', 1, NOW(), 1, 1, 1, TRUE),
    (2,'brandon.telle@gmail.com', MD5('brandon.telle'), 'Brandon', 1, 'Student', 1, NOW(), 2, 2, 3, TRUE),
    (3, 'chethan.gt@gmail.com', MD5('chethan.gt'), 'Chethan', 1, 'Student', 1, NOW(), 4, 3, 5, TRUE),
    (4, 'kabatasliemre@hotmail.com', MD5('kabatasliemre'), 'Emre', 1, 'Student', 1, NOW(), 7, 13, 9, TRUE);

INSERT INTO tblrestriction (lot_id, description) VALUES 
    (1, 'Employee spaces open for general parking at 6PM'),
    (2, 'Employee spaces open for general parking at 6PM'),
    (3, 'Employee spaces open for general parking at 6PM'),
    (4, 'Employee spaces require employee permit at all times'),
    (5, 'Employee spaces open for general parking at 6PM'),
    (6, 'Employee spaces open for general parking at 6PM'),
    (7, 'Employee spaces open for general parking at 6PM'),
    (8, 'Employee spaces open for general parking at 6PM'),
    (9, 'Employee spaces open for general parking at 6PM'),
    (10, 'Employee spaces require employee permit at all times'),
    (12, 'Employee spaces open for general parking at 6PM'),
    (13, 'Employee spaces require employee permit at all times'),
    (14, 'Employee spaces open for general parking at 6PM'),
    (15, 'Employee spaces open for general parking at 6PM'),
    (16, 'Employee spaces open for general parking at 6PM'),
    (17, 'Employee spaces open for general parking at 6PM'),
    (20, 'Employee spaces open for general parking at 6PM'),
    (22, 'Employee spaces open for general parking at 6PM'),
    (23, 'Employee spaces open for general parking at 6PM'),
    (26, 'Employee spaces open for general parking at 6PM'),
    (41, 'Employee spaces open for general parking at 6PM'),
    (26, 'Carpool spaces open for general parking at 6PM'),
    (30, 'Carpool spaces open for general parking at 6PM'),
    (34, 'Carpool spaces open for general parking at 6PM'),
    (15, 'Overnight parking not permitted'),
    (20, 'Overnight parking allowed: Midnight to 6AM'),
    (21, 'Overnight parking allowed: Midnight to 6AM'),
    (22, 'Overnight parking allowed: Midnight to 6AM'),
    (23, 'Overnight parking allowed: Midnight to 6AM'),
    (25, 'Overnight parking allowed: Midnight to 6AM'),
    (26, 'Overnight parking allowed: Midnight to 6AM'),
    (30, 'Overnight parking allowed: Midnight to 6AM'),
    (42, 'Overnight parking not permitted'),
    (15, 'Subject to closure'),
    (42, 'Subject to closure'),
    (23, 'Resident permit required at all times'),
    (18, 'Resident permit required at all times'),
    (24, '10 minute spaces limited at all times'),
    (26, 'Reserved spaces reserved at all times'),
    (42, 'CDC permit required at all times');


INSERT INTO tbljoin_lot_location (lot_id, loc_id) VALUES
    (1, 1), 
    (1, 2), 
    (1, 41),
    (1, 42),
    (1, 43),
    (2, 3),
    (2, 4),
    (2, 44),
    (2, 16),
    (2, 30),
    (3, 5),
    (3, 6), 
    (3, 45),
    (4, 7),
    (4, 8),
    (4, 46),
    (4, 47), 
    (4, 14),
    (5, 9),
    (5, 10), 
    (5, 48),
    (5, 49),
    (6, 11), 
    (6, 12),
    (7, 13),
    (7, 14),
    (8, 15),
    (9, 16),
    (9, 17),
    (9, 37),
    (10, 18),
    (10, 19),
    (11, 20),
    (12, 20),
    (12, 21),
    (13, 20),
    (13, 22),
    (13, 50),
    (13, 51),
    (13, 21),
    (14, 23),
    (14, 24),
    (14, 52),
    (14, 21),
    (14, 54),
    (15, 25),
    (16, 26),
    (17, 27),
    (18, 28),
    (18, 29),
    (19, 27),
    (19, 60),
    (20, 29),
    (20, 53),
    (21, 60),
    (21, 33),
    (21, 32),
    (22, 29),
    (22, 30),
    (22, 53),
    (23, 32),
    (23, 31),
    (24, 33),
    (24, 61),
    (24, 32),
    (24, 31),
    (25, 32),
    (25, 33),
    (26, 34),
    (26, 28),
    (26, 25),
    (26, 53),
    (26, 62),
    (30, 20),
    (30, 21),
    (30, 51),
    (34, 20),
    (34, 21),
    (34, 51),
    (38, 35),
    (38, 36),
    (38, 37),
    (38, 56),
    (39, 37),
    (39, 38),
    (39, 57),
    (39, 58),
    (40, 12),
    (41, 12),
    (41, 49),
    (41, 11),
    (41, 59),
    (42, 39),
    (42, 40),
    (43, 27),
    (10, 3),
    (20, 3),
    (22, 3),
    (23, 3),
    (2, 6),
    (4, 6),
    (39, 6),
    (3, 7),
    (5, 7),
    (7, 7),
    (40, 9),
    (41, 9),
    (6, 9),
    (8, 9),
    (34, 24),
    (15, 24),
    (16, 25),
    (17, 25),
    (18, 27),
    (20, 30),
    (23, 30),
    (43, 39),
    (23, 41),
    (24, 41),
    (2, 41),
    (3, 41),
    (9, 50),
    (10, 50),
    (12, 50),
    (30, 50);

INSERT INTO tblevent(description, start_dt_tm, end_dt_tm, lot_id, created_by) VALUES
    ('Women\'s Volleyball vs. Loyola Marymount', '2011-11-23 17:00:00', '2011-11-23 22:00:00', 15,1),
    ('Women\'s Volleyball vs. Central Michigan', '2011-11-25 17:00:00', '2011-11-25 22:00:00', 15,1),
    ('Metales M5 Brass Spectacular', '2011-11-26 18:00:00', '2011-11-26 20:00:00', 14,1),
    ('Sunday Afternoon Concert Series presents Linda Tillery and the Cultural Heritage Choir', '2011-11-27 10:00:00', '2011-11-27 13:00:00', 14,1),
    ('Bob Cole Conservatory of Music presents Piano Plus!', '2011-11-29 17:00:00', '2011-11-29 19:00:00', 14,1),
    ('Men \'s Basketball vs. BYU Hawaii','2011-12-02 19:05:00','2011-12-02 22:00:00',15,1),
    ('Men \'s Basketball vs. Texas','2011-12-06 17:00:00','2011-12-06 22:00:00',15,1),
    ('Women \'s Basketball vs. Nevada','2011-12-08 19:00:00','2011-12-08 23:00:00',15,1),
    ('Art Department presents student art galleries, MFA wood, drawing & painting, printmaking, and BFA fiber','2011-12-13 12:00:00','2011-12-13 17:00:00',8,1),
    ('Women \'s Basketball vs. Dartmouth','2011-12-16 19:00:00','2011-12-16 23:00:00',15,1),
    ('Women \'s Basketball, Beach Classic','2011-12-19 15:00:00','2011-12-19 17:00:00',15,1),
    ('Men \'s Basketball vs. Eastern New Mexico','2011-12-19 20:05:00','2011-12-19 23:00:00',15,1),
    ('Women \'s Basketball vs. UC Riverside','2011-12-29 19:00:00','2011-12-29 22:00:00',15,1),
    ('Women \'s Basketball vs. UC Irvine','2011-12-31 13:00:00','2011-12-31 17:00:00',15,1),
    ('Men \'s Basketball at UC Irvine','2012-01-02 19:00:00','2012-01-02 22:00:00',15,1),
    ('Women \'s Basketball vs. Cal State Northridge','2012-01-07 16:00:00','2012-01-07 19:00:00',15,1),
    ('Men \'s basketball vs. UC Davis','2012-01-12 16:00:00','2012-01-12 16:00:00',15,1),
    ('Women \'s Basketball vs. UC Santa Barbara','2012-01-19 19:00:00','2012-01-19 22:00:00',15,1),
    ('Women \'s Tennis, Beach Tennis Winter Invitational','2012-01-20 00:00:00','2012-01-20 23:59:59',30,1),
    ('Women \'s Basketball vs. Cal Poly','2012-01-21 16:00:00','2012-01-21 20:00:00',15,1),
    ('Women \'s Tennis, Beach Tennis Winter Invitational','2012-01-21 00:00:00','2012-01-21 23:59:59',30,1),
    ('Carpenter Performing Arts Center Dance Series presents Doug Varone and Dancers','2012-02-04 20:00:00','2012-02-04 23:00:00',12,1),
    ('Men \'s Basketball vs. Cal State Northridge','2012-02-04 21:00:00','2012-02-04 23:00:00',15,1),
    ('Spring 2012 Job Fair','2012-02-13 12:00:00','2012-02-13 16:00:00',3,1),
    ('Women \'s Basketball vs. UC Davis','2012-02-16 19:00:00','2012-02-16 22:00:00',15,1),
    ('Women \'s Basketball vs. Pacific','2012-02-18 16:00:00','2012-02-18 20:00:00',15,1),
    ('Osher Lifelong Learning Institute, 7th annual Juried Arts and Crafts Show','2012-02-20 10:00:00','2012-02-20 16:00:00',9,1),
    ('Men \'s Basketball vs. UC Santa Barbara','2012-02-22 20:00:00','2012-02-22 23:00:00',15,1),
    ('Osher Lifelong Learning Institute, 7th annual Juried Arts and Crafts Show','2012-02-21 10:00:00','2012-02-21 16:00:00',9,1),
    ('Osher Lifelong Learning Institute, 7th annual Juried Arts and Crafts Show','2012-02-23 10:00:00','2012-02-23 16:00:00',9,1),
    ('Osher Lifelong Learning Institute, 7th annual Juried Arts and Crafts Show','2012-02-24 10:00:00','2012-02-24 16:00:00',9,1),
    ('Men \'s Basketball vs. UC Riverside','2012-02-25 16:05:00','2012-02-25 20:00:00',15,1),
    ('Carpenter Performing Arts Center presents the Cabaret Series with Rachel York','2012-02-29 19:00:00','2012-02-25 22:00:00',12,1),
    ('Carpenter Performing Arts Center presents the Cabaret Series with Rachel York','2012-03-01 19:00:00','2012-03-01 22:00:00',12,1);


INSERT INTO tblmenu (id, description, link, parent, level, status, slug, type, position, created_dt, modified_dt, created_by) VALUES
(1, 'Home', '', 0, 1, '1', 'home', 'admin', 'header', '2011-11-27', NULL, NULL),
(2, 'Menus', '?module=menus', 0, 1, '1', 'menus', 'admin', 'header', '2011-11-28', NULL, NULL),
(3, 'Pages', '?module=pages', 0, 1, '1', 'pages', 'admin', 'header', '2011-11-28', NULL, NULL),
(4, 'Sections', '?module=sections', 0, 1, '1', 'sections', 'admin', 'header', '2011-12-06', NULL, NULL),
(5, 'Space Type', '?module=spacetype', 0, 1, '1', 'spacetype', 'admin', 'header', '2011-12-06', NULL, NULL),
(6, 'Space Info', '?module=space', 0, 0, '1', 'space', 'admin', 'header', '2011-12-15', '2011-12-15', '1'),
(7, 'Locations', '?module=locations', 0, 1, '1', 'locations', 'admin', 'header', '2011-12-06', NULL, NULL),
(8, 'Lot Details', '?module=lotdetails', 0, 1, '1', 'lotdetails', 'admin', 'header', '2011-12-06', NULL, NULL),
(9, 'Events', '?module=events', 0, 1, '1', 'events', 'admin', 'header', '2011-12-06', NULL, NULL),
(10, 'Logout', '/../logout.php', 0, 1, '1', 'logout', 'admin', 'header', '2011-12-06', NULL, NULL),
(15, 'Home', '', 0, 0, '1', 'home', 'site', 'header', NULL, NULL, NULL),
(16, 'Events', 'Eventcalender.php', 0, 0, '1', 'events', 'site', 'header', NULL, NULL, NULL),
(17, 'Lot Detail', 'lotinfo.php', 0, 0, '1', 'lot detail', 'site', 'header', NULL, NULL, NULL),
(18, 'Help', '?module=pages&type=frequently-asked-questions-faqs', 0, 0, '1', 'help', 'site', 'header', NULL, NULL, NULL),
(19, 'About Us', '?module=pages&amp;type=about-us', 0, 0, '1', 'about us', 'site', 'footer', NULL, NULL, NULL),
(20, 'Contact Us', 'contact.php', 0, 0, '1', 'contact us', 'site', 'footer', NULL, NULL, NULL),
(21, 'Privacy Policy', '?module=pages&type=privacy-policy', 0, 0, '1', 'privacy policy', 'site', 'footer', NULL, NULL, NULL),
(22, 'Site Map', 'sitemap.php', 0, 0, '1', 'site map', 'site', 'footer', NULL, NULL, NULL);

INSERT INTO `tblpages` VALUES
(5,'About Us','<h2>Website Description</h2>\r\n<p>This website is primarily a tool that provides real-time parking area information to people visiting California State University, Long Beach.&nbsp; Since the campus does not have a system in place to accurately determine how many of the parking spaces in a specific lot are actually occupied, this website uses a simulation to fill the lots according to certain variables.&nbsp; Some of those variables are time of day, whether the Spring or Fall semesters are in process, and our own observations of certain parking areas.&nbsp; The home page of the website shows a campus map overlaid with parking area icons that indicate a percentage that represents how full that parking area currently is.&nbsp; The data displayed to a user is updated every minute and each update invokes the data simulation to run providing continuously changing information.&nbsp; When a user moves the mouse over any of the parking area icons an additional window is displayed showing them exactly which parking spaces in that lot are still available.&nbsp; We use Asynchronous Java Script and XML (AJAX) to update the information on the home page. <br /> <br /> This website also provides a lot information page that shows the details of each parking area on campus.&nbsp; This information includes capacity of each type of space in the lot, the hours that the lot is open, any additional restrictions, and the campus locations that are close by this lot.&nbsp; The lots are grouped by major campus landmarks/areas to make it easier for users to find a lot that interests them instead of depending on the semi-arbitrary lot and structure numbers. <br />&nbsp; <br /> Also part of this website is a page that displays an event calendar.&nbsp; This page displays information about major campus events for a given month including which parking area may be closed or impacted. <br /> <br /> The website includes an account creation and modification page to allow users to create or change their existing account.&nbsp; This allows them to set individual preferences to filter what is displayed on the home page. <br /> <br /> For administrative users, the website includes a robust content management system (CMS).&nbsp; This system can be used to modify or add pages, content, and menu items on the different web pages.&nbsp; It also allows the site to be maintained by a less technical person in the future or even provides the capability to change or expand the layout of the website.&nbsp; &nbsp;<br /> <br /> Finally the website contains some static and familiar pages that many websites have in common.&nbsp; We included some static pages including a Help page, an About Us page, a Copyrights page, and a Site Map.&nbsp; We also included a page that has a contact form where users can submit their feedback to us.</p>\r\n<h2>Website Design</h2>\r\n<p>This website was designed first by conceiving of the idea and then by story boarding the potential site layout.&nbsp; Based of the feedback we received from the class and the instructor we decided what needed to be added and taken away from that initial design.&nbsp; We next had discussions on which technologies and methods would be used to incorporate all of the features and functionality.&nbsp; We agreed that AJAX would be ideal for the home page.&nbsp; We knew that we needed Jquery for the event calendar, form validation, and the CMS.&nbsp; Our next step was to design a database that housed all pertinent information to support every feature that the website needed to accomplish.&nbsp; After we had the database designed we divided the website into functional pieces and assigned certain sections to members of the group.&nbsp; Below is the breakdown of responsibilities for each of the team members.</p>\r\n<h2>Brandon</h2>\r\n<p>Brandon was assigned the primary task of designing the layout and implementing the AJAX for the home page.&nbsp; He created the map of the campus and the parking area icons as well as the CSS for both the desktop and mobile versions of the website.&nbsp; He also created the contact form and all of the associated PHP code.&nbsp; Brandon&rsquo;s brought a wealth of knowledge concerning web development to the team so he established our entire project framework.&nbsp; He also included the implementation of many features that the rest of the group would need to use for their sections.&nbsp; Some of these include the PHP email module, the Jquery form validation plug-in, establishing the mySQL connection, and the setup and proper use of the Smarty template engine.&nbsp; Brandon created the SQL inserts to modify the database and he also created the static Site Map page.</p>\r\n<h2>Chethan</h2>\r\n<p>Chethan&rsquo;s primary responsibility was to create the CMS that accompanied the website. &nbsp;He was instrumental in creating the original database relationship schema. &nbsp;The Content Management module can be used to control the entire content of the website.&nbsp;He has implemented the Pages module which can be used by&nbsp;the admin to create statis pages through the UI. The editor also allows the admin to write his own HTML code if required. The static pages is designed&nbsp;on the \"slug\" concept which is basically used for Google indexing.</p>\r\n<h2>Chris</h2>\r\n<p>Chris had the original idea for the website that the team decided to work on.&nbsp; He was instrumental in creating the initial website layout and design during the mock-up phase.&nbsp; He also worked closely with Chethan and Brandon to design the tables and relationships needed in the database to implement his vision for the website.&nbsp; Chris obtained all of the information about the parking areas on the CSULB campus to enter into the database.&nbsp; He also created the simulation that output the probability of a parking area being full based on the time of day and other variables in PHP.&nbsp; Chris produced all of the PHP needed to work with the AJAX that Brandon was developing for the home page, and together they designed the protocol for the JSON objects.&nbsp; He incorporated the functionality of emailing users when their preferred lot was impacted by a campus special event.&nbsp; Chris also designed the account creation and modification page and the associated PHP, plus this static About Us page.</p>\r\n<h2>Ibrahim</h2>\r\n<p>Ibrahim took on the challenge of designing the event calendar page and implementing its functionality.&nbsp; Ibrahim used a Jquery plug-in to display the calendar and the individual event as well as the table of events for the entire month.&nbsp; Working with Brandon he used AJAX to update these items without re-loading the entire page.&nbsp; Ibrahim also designed the static Help page and wrote all of the content for the FAQ\'s.</p>','2011-12-06 20:33:53','0000-00-00 00:00:00','1','about-us'),
(6,'Privacy Policy','<div>This Privacy policy applies to all the information we have posted about the parking structure and User account information.&nbsp;Over a period of time business changes might impact the privacy policy norms. Please be informed that you will have to check this section periodically&nbsp;for the up-to-date information. We assure that the modified policies will not have any security concerns with respect to the User Information we have gathered.</div>','2011-12-06 21:17:37','0000-00-00 00:00:00','1','privacy-policy'),
(7,'Frequently Asked Questions (FAQs)','<ul>\r\n<li><strong>How do I use website?</strong>\r\n<p>In order to use the website you will interact with parking area icons that are color coded in green, yellow, red, and grey overllayed on the CSULB campus map. These icons represent one of the over thirty parking areas on campus. When the mouse cursor is positioned over one of these icons you will see a small window that shows in detail of how many spaces that there are available to park in, and which kind of spaces they are.</p>\r\n</li>\r\n<li><strong>What do the colors mean?</strong>\r\n<p>The colors of the parking area icons on the home page map show how full each of the areas are. If the color is red, the parking area is from 90% to 100% full. If an icon is yellow, then the parking area is from 80% to 89% full. If an icon is green, then the parking area is less than 80% full. If an icon is grey, then the lot is closed for a special event such as a concert or sports game.</p>\r\n</li>\r\n<li><strong>How do I know if a lot is full?</strong>\r\n<p>The percentages displayed in each of the parking area icons shows how full it currently is, Not how empty it is. The color of the icon is just for quick reference if the user is able to distinguish them. Red corresponds to mostly full, yellow to partially full, and green to many spaces still available.</p>\r\n</li>\r\n<li><strong>How often is the information updated?</strong>\r\n<p>Main page information is updated every minute to give user reliable real-time information.</p>\r\n</li>\r\n<li><strong>How do I create an account?</strong>\r\n<p>To create an account select the link \"Create an Account\" located on the top right of the Home page. This will bring you to the account page where you will be prompted to enter valid information such as your Name, email and password. You will be able set you parking preferences using the drop-down selection boxes. After repeating the displayed text in the captcha and pressing the submit button your information will be checked, and if valid your account will be created.</p>\r\n</li>\r\n<li><strong>Why should I create an account?</strong>\r\n<p>The primary reason to create an account is set your individual parking preferences for quick customized feedback on the parking areas that pertain specifically to you.</p>\r\n</li>\r\n<li><strong>How can I get information about events in the campus?</strong>\r\n<p>The event tab on the main navigation bar present on every page will direct you to event calender page. This page provides the user with important CSULB campus events on a given month that can effect the parking availability in one or more of the parking areas. The event detail will tell the specifics about the event such as date, time, and description as well as which parking area on campus is closest to where the event is being held.</p>\r\n</li>\r\n<li><strong>How can I use preferences in the main page?</strong>\r\n<p>All users can choose from the parking space type and campus section drop-down boxes that are located towards the bottom left of the home page. When a selection from one or both of these are made and the filter button is pressed Then the appropriate filters will activated to reduce the result shown on the home page. Only the campus section chosen (North West, North East, or South) or parking areas that contain parking sapces of the matching type will be shown. Logged in users who have created an account will have access to a third drop-down selection box.</p>\r\n</li>\r\n<li><strong>Where can I see information about the lots?</strong>\r\n<p>The lot detail tab on the main navigation bar present on every page will bring you to a page that contains information about every parking area on campus. The parking areas are grouped by major campus landmarks or areas. Information such as the total capacity, types of parking spaces, time restrictions, nearby locations, and even a picture can be found here.</p>\r\n</li>\r\n</ul>','2011-12-06 21:17:46','0000-00-00 00:00:00','1','frequently-asked-questions-faqs');