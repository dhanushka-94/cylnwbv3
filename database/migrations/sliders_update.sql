-- SQL Query to Update Sliders Table
-- Run these queries in your database to add new fields without losing existing data

-- Add alt_text column (for image accessibility)
ALTER TABLE `sliders` 
ADD COLUMN `alt_text` VARCHAR(255) NULL AFTER `image_path`;

-- Add mobile_image_path column (for separate mobile images)
ALTER TABLE `sliders` 
ADD COLUMN `mobile_image_path` VARCHAR(255) NULL AFTER `image_path`;

-- Add target column (for link target: _self or _blank)
ALTER TABLE `sliders` 
ADD COLUMN `target` VARCHAR(255) NOT NULL DEFAULT '_self' AFTER `link_url`;

-- Add button_text column (for CTA button text)
ALTER TABLE `sliders` 
ADD COLUMN `button_text` VARCHAR(255) NULL AFTER `link_url`;

-- Add start_date column (for scheduling when slider should start)
ALTER TABLE `sliders` 
ADD COLUMN `start_date` DATETIME NULL AFTER `is_active`;

-- Add end_date column (for scheduling when slider should end)
ALTER TABLE `sliders` 
ADD COLUMN `end_date` DATETIME NULL AFTER `start_date`;

