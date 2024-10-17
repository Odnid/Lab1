<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/recaptchaenterprise/v1/recaptchaenterprise.proto

namespace Google\Cloud\RecaptchaEnterprise\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The environment creating the assessment. This describes your environment
 * (the system invoking CreateAssessment), NOT the environment of your user.
 *
 * Generated from protobuf message <code>google.cloud.recaptchaenterprise.v1.AssessmentEnvironment</code>
 */
class AssessmentEnvironment extends \Google\Protobuf\Internal\Message
{
    /**
     * Optional. Identifies the client module initiating the CreateAssessment
     * request. This can be the link to the client module's project. Examples
     * include:
     * - "github.com/GoogleCloudPlatform/recaptcha-enterprise-google-tag-manager"
     * - "cloud.google.com/recaptcha/docs/implement-waf-akamai"
     * - "cloud.google.com/recaptcha/docs/implement-waf-cloudflare"
     * - "wordpress.org/plugins/recaptcha-something"
     *
     * Generated from protobuf field <code>string client = 1 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $client = '';
    /**
     * Optional. The version of the client module. For example, "1.0.0".
     *
     * Generated from protobuf field <code>string version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     */
    private $version = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $client
     *           Optional. Identifies the client module initiating the CreateAssessment
     *           request. This can be the link to the client module's project. Examples
     *           include:
     *           - "github.com/GoogleCloudPlatform/recaptcha-enterprise-google-tag-manager"
     *           - "cloud.google.com/recaptcha/docs/implement-waf-akamai"
     *           - "cloud.google.com/recaptcha/docs/implement-waf-cloudflare"
     *           - "wordpress.org/plugins/recaptcha-something"
     *     @type string $version
     *           Optional. The version of the client module. For example, "1.0.0".
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Recaptchaenterprise\V1\Recaptchaenterprise::initOnce();
        parent::__construct($data);
    }

    /**
     * Optional. Identifies the client module initiating the CreateAssessment
     * request. This can be the link to the client module's project. Examples
     * include:
     * - "github.com/GoogleCloudPlatform/recaptcha-enterprise-google-tag-manager"
     * - "cloud.google.com/recaptcha/docs/implement-waf-akamai"
     * - "cloud.google.com/recaptcha/docs/implement-waf-cloudflare"
     * - "wordpress.org/plugins/recaptcha-something"
     *
     * Generated from protobuf field <code>string client = 1 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Optional. Identifies the client module initiating the CreateAssessment
     * request. This can be the link to the client module's project. Examples
     * include:
     * - "github.com/GoogleCloudPlatform/recaptcha-enterprise-google-tag-manager"
     * - "cloud.google.com/recaptcha/docs/implement-waf-akamai"
     * - "cloud.google.com/recaptcha/docs/implement-waf-cloudflare"
     * - "wordpress.org/plugins/recaptcha-something"
     *
     * Generated from protobuf field <code>string client = 1 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setClient($var)
    {
        GPBUtil::checkString($var, True);
        $this->client = $var;

        return $this;
    }

    /**
     * Optional. The version of the client module. For example, "1.0.0".
     *
     * Generated from protobuf field <code>string version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Optional. The version of the client module. For example, "1.0.0".
     *
     * Generated from protobuf field <code>string version = 2 [(.google.api.field_behavior) = OPTIONAL];</code>
     * @param string $var
     * @return $this
     */
    public function setVersion($var)
    {
        GPBUtil::checkString($var, True);
        $this->version = $var;

        return $this;
    }

}

