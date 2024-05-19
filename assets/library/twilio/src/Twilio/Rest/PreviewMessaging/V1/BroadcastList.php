<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Bulk Messaging and Broadcast
 * Bulk Sending is a public Twilio REST API for 1:Many Message creation up to 100 recipients. Broadcast is a public Twilio REST API for 1:Many Message creation up to 10,000 recipients via file upload.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\PreviewMessaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;


class BroadcastList extends ListResource
    {
    /**
     * Construct the BroadcastList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/Broadcasts';
    }

    /**
     * Create the BroadcastInstance
     *
     * @param array|Options $options Optional Arguments
     * @return BroadcastInstance Created BroadcastInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): BroadcastInstance
    {

        $options = new Values($options);

        $headers = Values::of(['X-Twilio-Request-Key' => $options['xTwilioRequestKey']]);

        $payload = $this->version->create('POST', $this->uri, [], [], $headers);

        return new BroadcastInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.PreviewMessaging.V1.BroadcastList]';
    }
}
