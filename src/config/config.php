<?php 

return [

    /**
     * Your customerID on Darbird (check the left panel of your dashboard)
     */
    'cusID'          => getenv('DARBIRD_CUS_ID'),

    /**
     * Your Darbird SMS Api Key
     */
    'apiKey'            => getenv('DARBIRD_API_KEY'),

    /**
     * Your chosen sender name
     */
    'sender'            => getenv('DARBIRD_SENDER_ID'),

];