-- Migration: per-module quiz support
-- Run on existing databases via phpMyAdmin or:
--   mysql -u root cybersecurity_learn_db < migration_module_quizzes.sql

USE cybersecurity_learn_db;

-- Add module_id column (ignore error if column already exists)
ALTER TABLE quiz_results ADD COLUMN module_id INT NULL;
ALTER TABLE quiz_results
    ADD CONSTRAINT fk_quiz_results_module
    FOREIGN KEY (module_id) REFERENCES modules(module_id) ON DELETE SET NULL;
