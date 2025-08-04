<?php

namespace app\Enums;

enum Symbol
{
    case XMRUSDT;
    case BTCUSDT;
    case ETHBTC;
    case XRPBTC;
    case LTCBTC;
    case XMRBTC;

    public function currency(): string
    {
        return match ($this) {
            self::XMRUSDT => 'XMR',
            self::BTCUSDT => 'BTC',
            self::ETHBTC => 'ETH',
            self::XRPBTC => 'XRP',
            self::LTCBTC => 'LTC',
            self::XMRBTC => 'XMR',
        };
    }
    public function quoteCurrency(): string
    {
        return match ($this) {
            self::XMRUSDT => 'USDT',
            self::BTCUSDT => 'USDT',
            self::ETHBTC => 'BTC',
            self::XRPBTC => 'BTC',
            self::LTCBTC => 'BTC',
            self::XMRBTC => 'BTC',
        };
    }
}
