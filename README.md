
# PROECT X

## Quick start

docker-compose up  
docker exec -it candle-grabber_app_1 composer install  
docker exec -it candle-grabber_app_1 bin/doctrine orm:schema-tool:create  

## Testing

docker exec -it candle-grabber_app_1 composer test  

### Update schema

docker exec -it candle-grabber_app_1 bin/doctrine orm:schema-tool:update --force  

## Functionality

### 1. Grab candles from exchange

`docker exec -it candle-grabber_app_1 php grab_candles.php <symbol> <from-date> <to-date> <period>`

#### example grabbing

`docker exec -it candle-grabber_app_1 php grab_candles.php XMRBTC 2024-01-01T18:22:00 2024-12-31T23:59:59 M30`

### 2. Labeling data

`docker exec -it candle-grabber_app_1 php label_candles.php <symbol> <from-date> <to-date> <period> <max-amount> <max-quantity>`

#### example labeling

`docker exec -it candle-grabber_app_1 php label_candles.php XMRBTC 2015-01-01T00:00 2015-12-31T23:59 M1 0.22 10000`
`docker exec -it candle-grabber_app_1 php label_candles.php XMRUSDT 2017-05-05T15:08 2018-05-05T15:08 M1 0.22 10`

### 11. Generate population

### 100. Start reaction. Get results

### 101. Selection

### 110. Get winners
