<?php

return [
    'stripe_public_key' => env('STRIPE_PUBLIC_KEY'),//公開鍵
    'stripe_secret_key' => env('STRIPE_SECRET_KEY'),//秘密鍵
];
// 環境変数から Stripe の公開鍵と秘密鍵を取得して配列で返している