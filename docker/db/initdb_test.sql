-- create init db aind user
CREATE DATABASE candle_grabber_test;
CREATE USER 'user'@'%' IDENTIFIED BY 'example';
GRANT ALL PRIVILEGES ON candle_grabber_test.* TO 'user'@'%';