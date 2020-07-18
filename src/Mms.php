<?php
namespace Darbird\Darbirdsms;
use Illuminate\Support\Facades\Config;


class MMS extends Service
{

	public function send($options)
	{
		if (empty($options['to']) || empty($options['sms']) || empty($options['media_url'])) {
			return $this->error('recipient and message must be defined');
		}

		$data = [
			'action' => 'send-sms',
			'to' 	=> $options['to'],
			'sms' 	=> $options['sms'],
            'from' => Config::get('darbird.sender'),
            'mms' => '1',
            'media_url' => $options['media_url'],
		];

		$response = $this->client->post('sms/api', ['form_params' => $data ],['verify' => false]);

		return $this->success($response);
	}

}