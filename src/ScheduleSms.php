<?php
namespace Darbird\Darbirdsms;
use Illuminate\Support\Facades\Config;


class ScheduleSMS extends Service
{

	public function send($options)
	{
		if (empty($options['to']) || empty($options['sms']) || empty($options['schedule'])) {
			return $this->error('recipient and message must be defined');
		}

		if(empty($option['unicode'])){
			$data['unicode'] = '1';
		}

		$data = [
			'action' => 'send-sms',
			'to' 	=> $options['to'],
			'sms' 	=> $options['sms'],
            'from' => Config::get('DarbridSMS.sender'),
            'schedule' => $options['schedule'],
		];

		$response = $this->client->post('sms/api', ['form_params' => $data ],['verify' => false]);

		return $this->success($response);
	}

}