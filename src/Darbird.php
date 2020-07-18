<?php
namespace Darbird\Darbirdsms;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class DarbirdSMS
{
	const BASE_DOMAIN         = "https://api.darbird.com/api/";	
	protected $username;
    protected $apiKey;
    protected $senderName;
	protected $voicesmsClient;
	protected $smsVoiceUrl;


	public function __construct()
	{
        $this->loadConfigData();
        $this->prepareRequest();
        return $this;
    }
    

    public function loadConfigData()
    {
        $this->username = Config::get('darbird.cusID');

        $this->senderName = Config::get('darbird.sender');

        $this->apiKey = Config::get('darbird.apiKey');
    }


    public function prepareRequest()
    {
        $this->baseDomain = self::BASE_DOMAIN;
		$this->smsVoiceUrl = $this->baseDomain;
		
		$this->voicesmsClient = new Client([
			'base_uri' => $this->smsVoiceUrl,
			'headers' => [
                'X-Darbird-Token' => $this->apiKey,
                'X-Darbird-Key' => $this->username,
				'Content-Type' => 'application/x-www-form-urlencoded',
				'Accept' => 'application/json'
			]
		]);
    }

    public function sms()
	{
		$sms = new SMS($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
    }
    
    public function voice()
	{
		$sms = new Voice($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
    }
    
    public function mms()
	{
		$sms = new MMS($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
    }
    
    public function schedulesms()
	{
		$sms = new ScheduleSMS($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
    }
    
    public function authty()
	{
		$sms = new Authty($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
	}
    
    public function authtyverify()
	{
		$sms = new AuthtyVerify($this->voicesmsClient, $this->senderName, $this->apiKey);
		return $sms;
	}
    
}