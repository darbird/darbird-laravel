<?php
namespace Darbird\Darbirdsms;
use Illuminate\Support\Facades\Config;


class Voice extends Service
{

	public function send($options)
	{
		if (empty($options['to']) || empty($options['sms']) || empty(Config::get('darbird.sender'))) {
			return $this->error('recipient and message must be defined');
		}

		$data = [
			'action' => 'send-sms',
			'to' 	=> $options['to'],
			'sms' 	=> $options['sms'],
            'from' => Config::get('darbird.sender'),
            'voice' => '1'
		];

		$response = $this->client->post('sms/api', ['form_params' => $data ],['verify' => false]);

		return $this->success($response);
	}

}