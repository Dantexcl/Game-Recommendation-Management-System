DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  id INTEGER PRIMARY KEY,
  filename VARCHAR(255),
  type VARCHAR(100),
  game VARCHAR(255)
);
INSERT INTO `images` VALUES (1, 'ea', 'png', NULL);
INSERT INTO `images` VALUES (2, 'ubisoft', 'jpeg', NULL);
INSERT INTO `images` VALUES (3, 'hollow_knight', 'jpeg', NULL);
INSERT INTO `images` VALUES (4, 'no_photo', 'jpeg', NULL);