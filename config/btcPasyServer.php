<?php

return [
    'url' => env('BTC_PAY_URL', 'https://btcpay331939.lndyn.com'),
    "authorization" => env('BTC_AUTH', 'Basic bnZPZFZEN3ZpUkJ5T1JwN1BPR3JvcHlvV25XN2RXb0VIUFBXUXZFVUVNYg=='),
    // "authorization" => env('BTC_AUTH','Basic aW95VmxCYlpiMGhrUTdCN083clZVcGg3bDdwcmRFSHZWaGlrUkhwQ2JXNw=='),
    "apiKey" => env('BTC_AUTH_KEY', "Basic aGl0ZXNoOTNAZ21haWwuY29tOlRlc3RQYXNzMTIj"),
    "storeId" => env('BTC_STORE_ID', "2PNSTCLQCb9kHoaSHrM2NvdiJhHY33DtnEt8sovKazrm"),
];
