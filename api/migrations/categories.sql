-- up
CREATE TABLE `categories` (
    `id` VARCHAR(255),
    `name` VARCHAR(255) NOT NULL,
    `parent`  VARCHAR(255),
    PRIMARY KEY (`id`)
);

-- down
DROP TABLE `categories`;