<?php
namespace Darbird\Darbirdsms;
use Illuminate\Support\Facades\Config;


class AuthtyVerify extends Service
{

	public function send($options)
	{
		if (empty($options['to_number']) || empty($options['auth_code'])) {
			return $this->error('recipient and message must be defined');
		}

		$data = [
			'to_number' 	=> $options['to_number'],
			'auth_code' 	=> $options['auth_code'],
		];

		$response = $this->client->post('auth/confirm-token', ['form_params' => $data ],['verify' => false]);

		return $this->success($response);
	}

}