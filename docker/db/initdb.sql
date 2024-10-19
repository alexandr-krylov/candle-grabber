-- create init db aind user
CREATE DATABASE candle_grabber;
CREATE USER 'user'@'%' IDENTIFIED BY 'example';
GRANT ALL PRIVILEGES ON candle_grabber.* TO 'user'@'%';