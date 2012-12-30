-- -----------------------------------------------------------------------------
--    Name       :        db_schema.sql
--    Purpose    :        This scrips installs the storage tables and related
--                        objects in the central schema
--
--
--   MM/DD/YYYY         Modified By           Comments
--   11/08/2011         Chethan G             Created
--   11/17/2011         Brandon T             Locations and restrictions
--   11/18/2011         Chethan G             Added table tblpreference
--   11/19/2011         Brandon T             Made join table for locations
--   11/21/2011         Chethan G             Added additional columns in
--                                             tables tblevents, tbllot and tblspace.
--   11/24/2011         Brandon T             Added drops, merged Chethan's changes.
--   11/28/2011         Chethan G             Added columns to tblmenu
--   12/03/2011         Brandon T             Added classname to tbllot
--   12/04/2011         Chris H               Changed tblusers PK to auto increment
--   12/05/2011         Chethan G             Changed tblmenu->id to auto increment
--   12/05/2011         Chethan G             Added id to tblspace_type
--   12/06/2011         Chethan G             Added tblpages
--   12/06/2011         Chethan G             Dropped table tblpreference,
--                                            Added columns in tblusers,
--                                            Dropped uid col from tbllot table
--   12/06/2011         Chethan G             Changed tblcampus_section id to auto increment
--   12/10/2011         Chris H               added email_alert field in tblusers
--   12/13/2011         Chethan G             Dropped expirt_dt column from tblusers
-- -----------------------------------------------------------------------------

USE rtp;

-- Drops for rebuilding the database.
-- /*
DROP TABLE IF EXISTS tblusers;
DROP TABLE IF EXISTS tblcontact;
DROP TABLE IF EXISTS tblpages;
DROP TABLE IF EXISTS tbljoin_lot_location;
DROP TABLE IF EXISTS tbllocation;
DROP TABLE IF EXISTS tblcampus_section;
DROP TABLE IF EXISTS tblrestriction;
DROP TABLE IF EXISTS tblspace;
DROP TABLE IF EXISTS tblspace_type;
DROP TABLE IF EXISTS tblmenu;
DROP TABLE IF EXISTS tblevent;
DROP TABLE IF EXISTS tbllot;
-- */

-- Table structure for table 'tbllot'
CREATE TABLE IF NOT EXISTS tbllot (
  id INT(10) NOT NULL COMMENT 'Unique identifier of the Lot' AUTO_INCREMENT,
  type VARCHAR(20) NOT NULL COMMENT 'Type of the Lot',
  struct_nm VARCHAR(20) DEFAULT NULL COMMENT 'The name of the structure',
  struct_flr VARCHAR(10) DEFAULT NULL COMMENT 'The floor of the structure',
  capacity INT(11) NOT NULL DEFAULT 0 COMMENT 'The total capacity of the Lot - if a lot has a structure then it holds the capacity for each floor',
  occupied INT(11) NOT NULL DEFAULT 0,
  open_time TIME NOT NULL,
  close_time TIME NOT NULL,
  img VARCHAR(255) NOT NULL DEFAULT 'default.png',
  classname VARCHAR(50) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE(classname)
);

-- Index for table 'tbllot'
-- Data dump for table 'tbllot'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblevent'
CREATE TABLE IF NOT EXISTS tblevent (
  id int(5) NOT NULL COMMENT 'Unique identifier of the Event' AUTO_INCREMENT,
  description text NOT NULL COMMENT 'description of the Event',
  start_dt_tm datetime NOT NULL COMMENT 'Start Date and time of the event',
  end_dt_tm datetime NOT NULL COMMENT 'End Date and time of the event',
  lot_id int(10) NOT NULL,
  created_dt datetime default NULL COMMENT 'The creation date of the Event',
  modified_dt datetime default NULL COMMENT 'The modified date of the Event',
  created_by varchar(10) default NULL COMMENT 'The uid of the User creating the Event - This field always holds the "admin" value but if there are many Users with role as "1" (admin) then this fields helps in identifying a specific User',
  email_sent BOOLEAN NOT NULL COMMENT 'Whether or not an email has been sent about this event' DEFAULT FALSE,
  PRIMARY KEY  (id),
  foreign key(lot_id) references tbllot(id) on delete cascade
);

-- Index for table 'tblevent'
-- Data dump for table 'tblevent'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblmenu'
CREATE TABLE IF NOT EXISTS tblmenu (
  id int(5) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifiers for the Menus',
  description text NOT NULL COMMENT 'Menu description',
  link varchar(400) NOT NULL,
  parent int(3) NOT NULL default '0' COMMENT 'Parent Id of the Menu - which is nothing but tblMenus->id',
  level int(3) NOT NULL default '1' COMMENT 'The Menu/Sub menu level',
  status varchar(10) NOT NULL default '1' COMMENT 'The current status of the Menu',
  slug varchar(50) NOT NULL,
  type enum('admin','site') NOT NULL default 'site',
  position enum('header','footer','lsidebar','rsidebar','usermenu') NOT NULL default 'header',
  created_dt date default NULL COMMENT 'The creation date of the User',
  modified_dt date default NULL COMMENT 'The modified date',
  created_by varchar(20) default NULL COMMENT 'The uid of the User creating the Menu - This field always holds the "admin" value but if there are many Users with role as "1" (admin) then this fields helps in identifying a specific User',
  PRIMARY KEY  (id)
);

-- Index for table 'tblmenu'
-- Data dump for table 'tblmenu'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblspace_type'
CREATE TABLE IF NOT EXISTS tblspace_type (
  id int(11) NOT NULL auto_increment,
  type varchar(20) NOT NULL COMMENT 'Identifier',
  full_text varchar(50) NOT NULL COMMENT 'Display text',
  PRIMARY KEY  (id),
  UNIQUE KEY type (type)
);

-- Index for table 'tblspace_type'
-- Data dump for table 'tblspace_type'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblspace'
CREATE TABLE IF NOT EXISTS tblspace (
  id int(5) NOT NULL COMMENT 'Unique identifier of the Space' AUTO_INCREMENT,
  lot_id int(5) NOT NULL COMMENT 'Unique identifier of the Lot',
  type varchar(20) NOT NULL COMMENT 'The type of the Space',
  capacity int(11) NOT NULL COMMENT 'The total capacity of the Lot - if a lot has a structure then it holds the capacity for each floor',
  occupied int(11) NOT NULL default 0,
  PRIMARY KEY  (id),
  foreign key (lot_id) references tbllot(id) on delete cascade,
  foreign key (type) references tblspace_type(type)
);

-- Index for table 'tblspace'
-- Data dump for table 'tblspace'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblrestriction'
CREATE TABLE IF NOT EXISTS tblrestriction (
  id int(5) NOT NULL COMMENT 'Unique identifier of the restriction' AUTO_INCREMENT,
  description text NOT NULL,
  lot_id int(10) NOT NULL,
  PRIMARY KEY  (id),
  foreign key (lot_id) references tbllot(id) on delete cascade
);
-- Index for table 'tblrestriction'
-- Data dump for table 'tblrestriction'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblcampus_section'
CREATE TABLE IF NOT EXISTS tblcampus_section (
  id INT(1) NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
  section VARCHAR(20) NOT NULL COMMENT 'Name of the section',
  PRIMARY KEY(id)
);
-- Index for table 'tblcampus_section'
-- Data dump for table 'tblcampus_section'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tbllocation'
CREATE TABLE IF NOT EXISTS tbllocation (
  id INT(10) NOT NULL COMMENT 'Unique identifier' AUTO_INCREMENT,
  location TEXT NOT NULL COMMENT 'Text data for the nearby location',
  section int(1) NOT NULL COMMENT 'Section of campus the location is in',
  important int(1) NOT NULL DEFAULT 0 COMMENT 'Whether the location is major',
  PRIMARY KEY(id),
  foreign key(section) references tblcampus_section(id)
);

-- Index for table 'tbllocation'
-- Data dump for table 'tbllocation'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tbljoin_lot_location'
CREATE TABLE IF NOT EXISTS tbljoin_lot_location (
  lot_id INT(10) NOT NULL COMMENT 'Identifier for lot',
  loc_id INT(10) NOT NULL COMMENT 'Identifier for the location',
  PRIMARY KEY(lot_id, loc_id),
  FOREIGN KEY(lot_id) REFERENCES tbllot(id),
  FOREIGN KEY(loc_id) REFERENCES tbllocation(id)
);

-- Index for table 'tbljoin_lot_location'
-- Data dump for table 'tbljoin_lot_location'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblcontact'
CREATE TABLE IF NOT EXISTS tblcontact (
  id INT(10) NOT NULL COMMENT 'Identifier for contact form data' AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  comment TEXT NOT NULL,
  PRIMARY KEY(id)
);

-- Index for table 'tblcontact'
-- Data dump for table 'tblcontact'

-- Table structure for table 'tblpages'
CREATE TABLE IF NOT EXISTS tblpages (
  id int(11) NOT NULL auto_increment,
  title varchar(200) NOT NULL,
  content text NOT NULL,
  created_date timestamp NOT NULL default CURRENT_TIMESTAMP,
  modified_date datetime NOT NULL,
  status enum('1','0') default '1',
  slug varchar(50) NOT NULL,
  PRIMARY KEY  (id)
);

-- Index for table 'tblpages'
-- Data dump for table 'tblpages'

-- -----------------------------------------------------------------------------

-- Table structure for table 'tblusers'
CREATE TABLE IF NOT EXISTS tblusers (
  uid int(10) NOT NULL COMMENT 'Unique Identifier for a User ' AUTO_INCREMENT,
  uname varchar(50) NOT NULL COMMENT 'UserName of the registered User',
  pwd varchar(32) NOT NULL COMMENT 'Password of the registered User',
  name varchar(20) NOT NULL COMMENT 'First Name of the registered User',
  role tinyint(1) NOT NULL COMMENT 'This fields holds the boolean value indicating whether the User is an admin or not',
  user_typ varchar(10) NOT NULL COMMENT 'This field holds the type of the User Staff/Student',
  space_type int(10) not null,
  lot_id int(10) not null,
  pref_location int(10) not null,
  email_alert boolean not null,
  acct_stts varchar(10) default NULL COMMENT 'The current status of the  registered User',
  created_dt date default NULL COMMENT 'Account Creation date',
  modified_dt date default NULL COMMENT 'Accounts last modified date',
  PRIMARY KEY  (uid),
  FOREIGN KEY (space_type) REFERENCES tblspace_type(id) ON DELETE CASCADE,
  FOREIGN KEY (lot_id) REFERENCES tbllot(id) ON DELETE CASCADE,
  FOREIGN KEY (pref_location) REFERENCES tbllocation(id) ON DELETE CASCADE
);

-- Index for table 'tblusers'
-- Data dump for table 'tblusers'

-- -----------------------------------------------------------------------------