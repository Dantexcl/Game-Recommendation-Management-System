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
INSERT INTO `images` VALUES (5, 'ela', 'jpg', NULL);
INSERT INTO `images` VALUES (6, 'r6', 'jpg', NULL);
INSERT INTO `images` VALUES (7, 'rainbowsix', 'jpg', NULL);
INSERT INTO `images` VALUES (8, 'dark_soul_hero', 'jpeg', NULL);
INSERT INTO `images` VALUES (9, 'dark_soul_ava', 'jpeg', NULL);
INSERT INTO `images` VALUES (10, 'ela_avatar', 'jpg', NULL);
INSERT INTO `images` VALUES (11, 'favicon', 'png', NULL);
INSERT INTO `images` VALUES (12, 'bg1', 'jpg', NULL);
INSERT INTO `images` VALUES (13, 'bg2', 'jpg', NULL);
INSERT INTO `images` VALUES (14, 'bg3', 'jpg', NULL);
INSERT INTO `images` VALUES (15, 'bg4', 'jpg', NULL);
INSERT INTO `images` VALUES (16, 'bg6', 'jpg', NULL);
INSERT INTO `images` VALUES (17, 'bg5', 'jpg', NULL);
INSERT INTO `images` VALUES (18, 'bg7', 'gif', NULL);
INSERT INTO `images` VALUES (19, 'bg8', 'gif', NULL);

