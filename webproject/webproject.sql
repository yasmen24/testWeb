

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ;



CREATE TABLE `designcategory` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
);



CREATE TABLE `designconsultation` (
  `id` int(11) NOT NULL,
  `requestID` int(11) NOT NULL,
  `consultation` text NOT NULL,
  `consultationImgFileName` varchar(255) DEFAULT NULL
) ;




CREATE TABLE `designconsultationrequest` (
  `id` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `designerID` int(11) NOT NULL,
  `roomTypeID` int(11) NOT NULL,
  `designCategoryID` int(11) NOT NULL,
  `roomWidth` decimal(5,2) NOT NULL,
  `roomLength` decimal(5,2) NOT NULL,
  `colorPreferences` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `statusID` int(11) NOT NULL
);




CREATE TABLE `designer` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `logoImgFileName` varchar(255) NOT NULL
);




CREATE TABLE `designerspeciality` (
  `designerID` int(11) NOT NULL,
  `designCategoryID` int(11) NOT NULL
); 




CREATE TABLE `designportfolioproject` (
  `id` int(11) NOT NULL,
  `designerID` int(11) NOT NULL,
  `projectName` varchar(255) NOT NULL,
  `projectImgFileName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `designCategoryID` int(11) NOT NULL
); 


CREATE TABLE `requeststatus` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
); 





CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
);

INSERT INTO `client` (`id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(47, 'afia', 'mohamed', 'afia@gmail.com', '$2y$10$V9zc15esTm6vA8o5q4G34e5vceT/nh5GNZBZc6JjoqLL7ugKbdOvC'),
(48, 'saleh', 'hassen', 'saleh@gmail.com', '$2y$10$uJIfcdzaMjaiWO3yl/oESuULnkin0/Mv6GpZR8OW16BfkvUSIui3i'),
(49, 'Ali', 'ali', 'Ali@gmail.com', '$2y$10$FnvzmzwSq14AT6uqATetcuClZ/6EO1MIYWsA8hBW8TU9.nbPiPbzG'),
(50, 'Shatha', 'saleh', 'shatha@gmail.com', '$2y$10$WjYOg99YkaNYY0bfpaui8umNF19IZGCW4kzCRIik69Qh9d2ec1rFu');

INSERT INTO `designcategory` (`id`, `category`) VALUES
(1, 'Modern'),
(2, 'Country'),
(3, 'Coastal'),
(4, 'Bohemian'),
(5, 'Minimalist');

INSERT INTO `designconsultation` (`id`, `requestID`, `consultation`, `consultationImgFileName`) VALUES
(13, 43, '  From the details you supplied, the image presents one of the potential designs that align with your specifications                \r\n                ', '6611ff42707af.jpeg'),
(14, 49, 'In designing this space, I aimed for an effortless blend of modern elegance and comfort. The sheer curtains soften the natural light, highlighting the sleek wooden table and cozy textured chairs.', '6612ad99d704f.jpeg'),
(15, 51, '\r\nThe design offers a serene bedroom with a modern twist, where pine green accents and a striking chandelier create a relaxing yet sophisticated atmosphere.', '6612b0a5bad76.jpeg'),
(16, 54, '\r\nThe design offers a serene bedroom with a modern twist, where pine green accents and a striking chandelier create a relaxing yet sophisticated atmosphere.    ', '6612b1abe8361.jpeg');


INSERT INTO `designconsultationrequest` (`id`, `clientID`, `designerID`, `roomTypeID`, `designCategoryID`, `roomWidth`, `roomLength`, `colorPreferences`, `date`, `statusID`) VALUES
(43, 50, 35, 3, 1, '22.00', '30.00', 'white', '2024-04-07', 5),
(44, 50, 34, 2, 5, '40.00', '50.00', 'green', '2024-04-07', 1),
(45, 50, 33, 4, 3, '3.00', '2.00', 'blue', '2024-04-07', 3),
(46, 48, 34, 1, 5, '2.00', '3.00', 'yellow', '2024-04-07', 1),
(47, 48, 33, 3, 1, '2.00', '3.00', 'green', '2024-04-07', 3),
(49, 48, 36, 4, 1, '3.00', '6.00', 'white', '2024-04-07', 5),
(50, 47, 36, 2, 1, '3.00', '4.00', 'green', '2024-04-07', 1),
(51, 47, 35, 3, 1, '3.00', '4.00', 'white', '2024-04-07', 5),
(52, 47, 34, 4, 1, '5.00', '3.00', 'black', '2024-04-07', 3),
(53, 49, 33, 1, 1, '4.00', '3.00', 'orange', '2024-04-07', 1),
(54, 49, 36, 2, 1, '6.00', '5.00', 'green', '2024-04-07', 5),
(55, 49, 34, 3, 1, '3.00', '3.00', 'yellow', '2024-04-07', 3),
(56, 50, 33, 1, 1, '2.00', '2.00', 'white', '2024-04-07', 1),
(57, 50, 36, 3, 1, '4.00', '4.00', 'brown', '2024-04-07', 1);

INSERT INTO `designer` (`id`, `firstName`, `lastName`, `emailAddress`, `password`, `brandName`, `logoImgFileName`) VALUES
(33, 'Jana', 'AL-jomaih', 'jana@gmail.com', '$2y$10$OIiL.lSIxKsHL0C77FNs2O.mqF0evwngQfCDi3HpYAI.tvw7kafZG', 'Jana Brand', '6611f7d088d4d.jpeg'),
(34, 'Jojo', 'albanian ', 'Jojo@gmail.com', '$2y$10$XztWNcMetFWmZVBFUhnfKekrjeZf..x7NH2JJwuGtLXJU6iV3pMkO', 'Jojo Brand', '6611f89193e8d.jpeg'),
(35, 'Yasmen', 'Saleh', 'Yasmen@gmail.com', '$2y$10$6wJiTOxFRgZ/6.ikpZ6iF.iJgpZ4bYbWLfI54e.o6qhLKQ4c127ea', 'Yasmen Brand', '6611fbb79aeca.jpeg'),
(36, 'Yara', 'Bahmad ', 'Yara@gmail.com', '$2y$10$B9lEwataxQbbxQJ0jOxS2.mhLcvcsytkZUNLVAR/d8YMrXgG6Mkcu', 'Yara Brand', '6612aae159325.jpeg');


INSERT INTO `designerspeciality` (`designerID`, `designCategoryID`) VALUES
(33, 1),
(35, 1),
(36, 1),
(34, 2),
(35, 2),
(33, 3),
(34, 3),
(35, 3),
(36, 4);

INSERT INTO `designportfolioproject` (`id`, `designerID`, `projectName`, `projectImgFileName`, `description`, `designCategoryID`) VALUES
(23, 33, 'Floor Plans', '6611f82d97f3a_Real Estate Watercolor 2D Floor Plans Part 1.jpeg', ' a watercolor floor plan of the first floor of a house in Houston, featuring a mix of informal and formal living and dining areas, a kitchen, a powder room, a foyer, and an outdoor wood deck.', 3),
(24, 34, 'design', '6611f8de537fb_architecture portfolio design.jpeg', 'designer\'s portfolio, depicting various aspects of interior spaces and furnishings, with annotations and measurements that provide insight into the design process.', 1),
(25, 35, 'Home', '6611fbf875390_fantasy house concept art interior.jpeg', ' 3D isometric view of a two-story house interior, complete with a bedroom loft, living area, kitchen, and staircase, all designed with modern furnishings and green plant accents', 1),
(26, 36, 'Dream Home', '6612ac1d99cec_u48H9BVz.jpeg', ' interior design sketch for a living room space. It showcases various furniture pieces like a sectional sofa, armchairs, and a central kitchen island with stools. There are annotations for different elements such as a television, an oven, and a staircase, along with materials like wood, metal, and textile. To the right, a window is indicated to have stained glass. ', 2);


INSERT INTO `requeststatus` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Declined'),
(4, 'Completed'),
(5, 'consultation provided');

INSERT INTO `roomtype` (`id`, `type`) VALUES
(1, 'Living Room'),
(2, 'Kitchen'),
(3, 'Bedroom'),
(4, 'Dining Room');


ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);


ALTER TABLE `designcategory`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `designconsultation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requestID` (`requestID`);


ALTER TABLE `designconsultationrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `designerID` (`designerID`),
  ADD KEY `roomTypeID` (`roomTypeID`),
  ADD KEY `designCategoryID` (`designCategoryID`),
  ADD KEY `statusID` (`statusID`);


ALTER TABLE `designer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

ALTER TABLE `designerspeciality`
  ADD PRIMARY KEY (`designerID`,`designCategoryID`),
  ADD KEY `designCategoryID` (`designCategoryID`);


ALTER TABLE `designportfolioproject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designerID` (`designerID`),
  ADD KEY `designCategoryID` (`designCategoryID`);


ALTER TABLE `requeststatus`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;


ALTER TABLE `designcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `designconsultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `designconsultationrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;


ALTER TABLE `designer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

ALTER TABLE `designportfolioproject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;


ALTER TABLE `requeststatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `designconsultation`
  ADD CONSTRAINT `designconsultation_ibfk_1` FOREIGN KEY (`requestID`) REFERENCES `designconsultationrequest` (`id`);

ALTER TABLE `designconsultationrequest`
  ADD CONSTRAINT `designconsultationrequest_ibfk_1` FOREIGN KEY (`clientID`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `designconsultationrequest_ibfk_2` FOREIGN KEY (`designerID`) REFERENCES `designer` (`id`),
  ADD CONSTRAINT `designconsultationrequest_ibfk_3` FOREIGN KEY (`roomTypeID`) REFERENCES `roomtype` (`id`),
  ADD CONSTRAINT `designconsultationrequest_ibfk_4` FOREIGN KEY (`designCategoryID`) REFERENCES `designcategory` (`id`),
  ADD CONSTRAINT `designconsultationrequest_ibfk_5` FOREIGN KEY (`statusID`) REFERENCES `requeststatus` (`id`);


ALTER TABLE `designerspeciality`
  ADD CONSTRAINT `designerspeciality_ibfk_1` FOREIGN KEY (`designerID`) REFERENCES `designer` (`id`),
  ADD CONSTRAINT `designerspeciality_ibfk_2` FOREIGN KEY (`designCategoryID`) REFERENCES `designcategory` (`id`);


ALTER TABLE `designportfolioproject`
  ADD CONSTRAINT `designportfolioproject_ibfk_1` FOREIGN KEY (`designerID`) REFERENCES `designer` (`id`),
  ADD CONSTRAINT `designportfolioproject_ibfk_2` FOREIGN KEY (`designCategoryID`) REFERENCES `designcategory` (`id`);




