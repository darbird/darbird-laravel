<?php
namespace Darbird\Darbirdsms;

abstract class Service 
{
	protected $client;

	protected $username;

	protected $apiKey;

	public function __construct($client, $username, $apiKey)
	{
		$this->client 	= $client;
		$this->username = $username;
		$this->apiKey 	= $apiKey;
	}

	protected static function error($data) {
		return [
			'code' 	=> 'error',
			'data'		=> $data
		];
	}


	protected static function success($data) {
		return [
			//'status' 	=> 'success',
			'result'		=> json_decode($data->getBody()->getContents())
		];
	}
}