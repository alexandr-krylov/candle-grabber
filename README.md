
# PROECT X

## Quick start

docker-compose up  
docker exec -it candle-grabber_app_1 composer install  
docker exec -it candle-grabber_app_1 bin/doctrine orm:schema-tool:create  

## Functionality

### 1. Grab candles from exchange

`docker exec -it candle-grabber_app_1 php grab_candles.php <symbol> <from-date> <to-date> <period>`

#### example

`docker exec -it candle-grabber_app_1 php grab_candles.php XMRBTC 2024-01-01T18:22:00 2024-12-31T23:59:59 M30`

### 2. Labeling data

`docker exec -it candle-grabber_app_1 php label_candles.php <symbol> <from-date> <to-date> <period>`

### 11. Generate population

### 100. Start reaction. Get results

### 101. Selection

### 110. Get winners
