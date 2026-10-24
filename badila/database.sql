CREATE DATABASE IF NOT EXISTS `localhost_badilla` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `localhost_badilla`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `high_score` INT(11) DEFAULT 0,
  `total_score` INT(11) DEFAULT 0,
  `games_played` INT(11) DEFAULT 0,
  `last_active` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user_scores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `score` INT(11) NOT NULL DEFAULT 0,
  `accuracy` INT(11) NOT NULL DEFAULT 0,
  `hints_used` INT(11) NOT NULL DEFAULT 0,
  `mistakes` INT(11) NOT NULL DEFAULT 0,
  `best_streak` INT(11) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `system_demos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `image_path` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `weekly_updates` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `week_number` INT(11) NOT NULL DEFAULT 1,
  `title` VARCHAR(255) NOT NULL,
  `date_range` VARCHAR(100) NOT NULL DEFAULT '',
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `stage` TINYINT NOT NULL,
  `term` VARCHAR(24) NOT NULL,
  `definition` TEXT NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quiz_question_stage_term` (`stage`, `term`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `quiz_question_seed_state` (
  `id` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `quiz_questions` (`stage`, `term`, `definition`) VALUES
(1, 'FRONTOFFICE', 'The department of a hotel that serves as the guest''s first and last point of contact, handling reservations, registration, and guest services.'),
(1, 'RESERVATION', 'An advance arrangement made by a guest to secure a room or service for a specific date.'),
(1, 'CHECKIN', 'The process of registering an arriving guest, verifying their reservation, and assigning a room.'),
(1, 'CHECKOUT', 'The process of settling a guest''s account and formally ending their stay.'),
(1, 'GUESTFOLIO', 'A running statement of a guest''s charges and payments kept by the front office during their stay.'),
(1, 'WALKIN', 'A guest who arrives and requests accommodation without a prior reservation.'),
(1, 'NOSHOW', 'A guest with a confirmed reservation who does not arrive and does not cancel.'),
(1, 'OVERBOOKING', 'The practice of accepting more reservations than the number of rooms actually available.'),
(1, 'ROOMRACK', 'A front office system or board used to display and track the current status of every room.'),
(1, 'REGISTRATION', 'The formal recording of a guest''s personal details and stay information upon arrival.'),
(1, 'CONCIERGE', 'A front office staff member who assists guests with bookings, directions, and local recommendations.'),
(1, 'BELLBOY', 'A front office employee who carries luggage and escorts guests to their rooms.'),
(1, 'DOORMAN', 'A staff member stationed at the entrance who greets guests and assists with vehicles and doors.'),
(1, 'VALET', 'A staff member who parks and retrieves guests'' vehicles on their behalf.'),
(1, 'LOBBY', 'The main entrance area of a hotel where the front desk and guest seating are located.'),
(1, 'KEYCARD', 'An electronic card used to unlock a guest room in place of a traditional metal key.'),
(1, 'GUESTHISTORY', 'A record kept by the front office of a guest''s past stays, preferences, and requests.'),
(1, 'AMENITIES', 'Extra comfort items or services provided to guests, such as toiletries or bathrobes.'),
(1, 'UPSELLING', 'The technique of encouraging a guest to purchase a higher category of room or an added service.'),
(1, 'ROOMSTATUS', 'The current condition of a room, such as vacant, occupied, clean, or dirty, tracked by the front office.'),
(1, 'VACANT', 'A room status indicating that no guest is currently occupying the room.'),
(1, 'OCCUPIED', 'A room status indicating that a guest is currently staying in the room.'),
(1, 'OUTOFORDER', 'A room status indicating the room cannot be sold due to maintenance or repair issues.'),
(1, 'SKIPPER', 'A guest who leaves the hotel without paying their outstanding bill.'),
(1, 'LATECHECKOUT', 'An arrangement allowing a guest to vacate their room later than the standard checkout time.'),
(1, 'GROUPBOOKING', 'A reservation made for a block of rooms for members of the same group or organization.'),
(1, 'CORPORATE', 'A room rate or account arranged for business travelers or companies.'),
(1, 'RACKRATE', 'The full, standard published price of a room before any discount is applied.'),
(1, 'NIGHTAUDIT', 'The end-of-day process of reconciling front office transactions and verifying room status and revenue.'),
(1, 'DEPOSIT', 'A sum of money paid in advance by a guest to guarantee a reservation.'),
(2, 'TABLESETTING', 'The arrangement of tableware, glassware, and linen on a dining table before service.'),
(2, 'NAPKINFOLD', 'A decorative technique of folding a napkin for table presentation.'),
(2, 'SILVERWARE', 'The knives, forks, and spoons used by guests for dining.'),
(2, 'GUERIDON', 'A small mobile trolley used by waitstaff for tableside preparation or service.'),
(2, 'SOMMELIER', 'A trained wine steward who manages a restaurant''s wine list and service.'),
(2, 'CANAPE', 'A small bite-sized appetizer served before a meal, often on a base of bread or pastry.'),
(2, 'APERITIF', 'An alcoholic drink taken before a meal to stimulate the appetite.'),
(2, 'DIGESTIF', 'An alcoholic drink taken after a meal, believed to aid digestion.'),
(2, 'MISEENPLACE', 'The preparation and arrangement of ingredients and equipment before service begins.'),
(2, 'CHAFINGDISH', 'A metal container with a heat source underneath used to keep food warm during buffet service.'),
(2, 'BUFFETSERVICE', 'A style of service where food is displayed for guests to serve themselves.'),
(2, 'SILVERSERVICE', 'A formal style of service where a waiter places food onto a guest''s plate from a serving dish.'),
(2, 'PLATESERVICE', 'A style of service where food is portioned and plated in the kitchen before being brought to the guest.'),
(2, 'FAMILYSERVICE', 'A style of service where large platters of food are placed on the table for guests to share.'),
(2, 'ORDERTAKING', 'The process of recording a guest''s food and beverage selections.'),
(2, 'COVERSETUP', 'The complete table setting arranged for a single diner.'),
(2, 'GARNISHING', 'Adding a decorative item to a dish or drink to enhance its presentation.'),
(2, 'STEWARDING', 'The department responsible for cleaning and maintaining kitchen equipment and utensils.'),
(2, 'REQUISITION', 'A formal request for the issuance of stock or supplies from the storeroom.'),
(2, 'BANQUETSETUP', 'The arrangement of tables, chairs, and equipment for a large formal event.'),
(2, 'TABLEDHOTE', 'A fixed menu offered at a set price with limited choices per course.'),
(2, 'ALACARTE', 'A menu where each dish is individually priced and ordered separately.'),
(2, 'DEGUSTATION', 'A tasting menu consisting of small courses meant to sample a range of dishes.'),
(2, 'DECANTING', 'The process of pouring wine into a separate vessel to separate sediment and allow it to breathe.'),
(2, 'CONDIMENTS', 'Sauces, spices, or accompaniments added to food to enhance its flavor.'),
(2, 'CUTLERY', 'Another term for the eating utensils, such as forks, knives, and spoons, used at the table.'),
(2, 'CROCKERY', 'The plates, bowls, and cups used for serving food and drink.'),
(2, 'GLASSWARE', 'Drinking glasses and other glass vessels used in beverage service.'),
(2, 'FLAMBE', 'A cooking technique where alcohol is added to a dish and ignited for presentation and flavor.'),
(2, 'GRATUITY', 'A voluntary payment given to a service worker in appreciation of good service.'),
(3, 'BEDMAKING', 'The task of preparing and arranging a guest bed with clean linens in a neat, standard manner.'),
(3, 'LINENCHANGE', 'The replacement of used bed sheets, pillowcases, and towels with fresh ones.'),
(3, 'DUSTING', 'The task of removing dust from surfaces, furniture, and fixtures in a room.'),
(3, 'VACUUMING', 'Cleaning carpets and floors using a vacuum cleaner to remove dirt and debris.'),
(3, 'MOPPING', 'The task of cleaning hard floors using a wet mop and cleaning solution.'),
(3, 'SWEEPING', 'The task of clearing dirt and debris from a floor using a broom.'),
(3, 'TURNDOWN', 'An evening housekeeping service that prepares the room for sleep, such as folding back the bed covers.'),
(3, 'GUESTSUPPLIES', 'Items such as toiletries and amenities placed in a guest room for their use.'),
(3, 'MINIBAR', 'A small refrigerator in a guest room stocked with drinks and snacks for purchase.'),
(3, 'LAUNDRY', 'The process of washing, drying, and cleaning linens, towels, and garments.'),
(3, 'DRYCLEANING', 'A method of cleaning fabrics using chemical solvents instead of water.'),
(3, 'STAINREMOVAL', 'The process of treating and eliminating stains from linen or fabric.'),
(3, 'FABRICSOFTENER', 'A laundry product used to make fabrics feel softer and reduce static.'),
(3, 'LINENINVENTORY', 'The tracked stock count of sheets, towels, and other linen items.'),
(3, 'TROLLEY', 'A wheeled cart used by housekeeping staff to carry supplies between rooms.'),
(3, 'PANTRY', 'A small service area on a guest floor used to store housekeeping supplies.'),
(3, 'PUBLICAREA', 'Shared spaces of a hotel, such as the lobby and hallways, that require regular cleaning.'),
(3, 'CORRIDOR', 'A hallway connecting guest rooms on a hotel floor.'),
(3, 'UPHOLSTERY', 'The fabric or padded covering used on furniture such as chairs and sofas.'),
(3, 'POLISHING', 'The task of cleaning and shining a surface, such as furniture or metal fixtures.'),
(3, 'SANITIZING', 'The process of reducing germs on a surface to a safe level.'),
(3, 'DISINFECTING', 'The process of using a chemical agent to destroy bacteria and germs on a surface.'),
(3, 'WASTEDISPOSAL', 'The proper collection and removal of trash and rubbish from guest rooms and public areas.'),
(3, 'LOSTANDFOUND', 'A department or system that stores and manages items guests have left behind.'),
(3, 'KEYCONTROL', 'The system used to track, issue, and secure room and master keys.'),
(3, 'ROOMINSPECTION', 'A thorough check of a room to ensure it meets cleanliness and quality standards.'),
(3, 'STATUSREPORT', 'A report used by housekeeping to communicate the current cleaning status of each room.'),
(3, 'FLOORPLAN', 'A diagram showing the layout of rooms and areas on a hotel floor.'),
(3, 'MAKEUPROOM', 'A request from a guest for their room to be cleaned during their stay.'),
(3, 'DONOTDISTURB', 'A request or sign used by a guest to ask staff not to enter or interrupt their room.');

INSERT IGNORE INTO `quiz_question_seed_state` (`id`) VALUES (1);

CREATE DATABASE IF NOT EXISTS `game_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `game_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `high_score` INT(11) DEFAULT 0,
  `total_score` INT(11) DEFAULT 0,
  `games_played` INT(11) DEFAULT 0,
  `last_active` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `user_scores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `score` INT(11) NOT NULL DEFAULT 0,
  `accuracy` INT(11) NOT NULL DEFAULT 0,
  `hints_used` INT(11) NOT NULL DEFAULT 0,
  `mistakes` INT(11) NOT NULL DEFAULT 0,
  `best_streak` INT(11) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `system_demos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL DEFAULT '',
  `image_path` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `weekly_updates` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `week_number` INT(11) NOT NULL DEFAULT 1,
  `title` VARCHAR(255) NOT NULL,
  `date_range` VARCHAR(100) NOT NULL DEFAULT '',
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `stage` TINYINT NOT NULL,
  `term` VARCHAR(24) NOT NULL,
  `definition` TEXT NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quiz_question_stage_term` (`stage`, `term`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `quiz_question_seed_state` (
  `id` TINYINT NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO `game_db`.`quiz_questions` (`stage`, `term`, `definition`)
SELECT `stage`, `term`, `definition` FROM `localhost_badilla`.`quiz_questions`;

INSERT IGNORE INTO `game_db`.`quiz_question_seed_state` (`id`) VALUES (1);
