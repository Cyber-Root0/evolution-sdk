<?php
namespace EvolutionSDK;

use EvolutionSDK\util\Config;
use EvolutionSDK\util\EndPoints;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
class SDK
{
    protected Client $httpclient;
    protected Config $config;
    /**
     * receive Config instance
     *
     * @param  Config $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->httpclient = new Client(
            [
                'base_uri' => $config->getUrl(),
                'timeout' => 10
            ]
        );
    }
    /**
     * create instance
     *
     * @param  string $instance
     * @param  bool $qrcode
     * @return \StdClass
     */
    public function create(string $instance, $qrcode = false)
    {
        try {

            $output = $this->httpclient->request(
                'POST',
                EndPoints::CREATE,
                [
                    'headers' => $this->setConfigHeader(),
                    'json' => [
                        'instanceName' => $instance,
                        'qrcode' => $qrcode
                    ]
                ]
            );
            return json_decode($output->getBody()->getContents());
        } catch (ClientException $e) {
            var_dump($e->getMessage());
        }

    }
    /**
     * sendMessage
     *
     * @param  string $instance
     * @param  string $number
     * @param  string $message
     * @param  array $options
     * @return \stdClass
     */
    public function sendMessage(string $instance, string $number, string $message, array $options = [])
    {
        $number = $number . '@s.whatsapp.net';
        try {
            $output = $this->httpclient->request(
                'POST',
                EndPoints::SEND . $instance,
                [
                    'headers' => $this->setConfigHeader(),
                    'json' => [
                        'number' => $number,
                        'textMessage' => [
                            'text' => $message
                        ],
                        'options' => $options
                    ]
                ]
            );
            return json_decode($output->getBody()->getContents());
        } catch (ClientException $e) {
            var_dump($e->getMessage());
        }
    }
    /**
     * connect qrcode from specif instance
     *
     * @param  string $instance
     * @return void
     */
    public function connect(string $instance)
    {
        try {
            $output = $this->httpclient->request(
                'GET',
                EndPoints::CONNECT . $instance,
                [
                    'headers' => $this->setConfigHeader()
                ]
            );
            return json_decode($output->getBody()->getContents());
        } catch (ClientException $e) {
            var_dump($e->getMessage());
        }
    }
    public function instanceStatus(string $instance)
    {
        try {
            $output = $this->httpclient->request(
                'GET',
                EndPoints::STATUS . $instance,
                [
                    'headers' => $this->setConfigHeader()
                ]
            );
            return json_decode($output->getBody()->getContents());
        } catch (ClientException $e) {
            var_dump($e->getMessage());
        }
    }
    /* private methods */
    /**
     * get header with apikey
     *
     * @return array
     */
    private function setConfigHeader(): array
    {
        return [
            'apiKey' => $this->config->getApikey()
        ];
    }
}