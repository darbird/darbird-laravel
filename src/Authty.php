<?php
namespace Darbird\Darbirdsms;
use Illuminate\Support\Facades\Config;


class Authty extends Service
{

	public function send($options)
	{
		if (empty($options['to_number']) || empty($options['msg_type']) || empty($options['token_lenght'])) {
			return $this->error('recipient and message must be defined');
		}

		$data = [
			'to_number' 	=> $options['to_number'],
			'token_lenght' 	=> $options['token_lenght'],
            'from' => Config::get('darbird.sender'),
            'msg_type' => $options['msg_type'],
		];

		$response = $this->client->post('auth/autity', ['form_params' => $data ],['verify' => false]);

		return $this->success($response);
	}

}