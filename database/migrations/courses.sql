-- up
CREATE TABLE `courses` (
    `course_id` VARCHAR(255),
    `title` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255),
    `image_preview` VARCHAR(300),
    `category_id` VARCHAR(255),
    PRIMARY KEY (`course_id`)
);

-- down
DROP TABLE `courses`;