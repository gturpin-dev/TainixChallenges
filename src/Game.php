<?php

namespace Gturpin\TainixChallenges;

/**
 * API Engine to solve a challenge
 */
final class Game
{	
	private const BASE_URL = 'https://tainix.fr/';

	private string $codeEngine;
	private string $key;
	private string $token;

	public function __construct(string $key, string $codeEngine)
	{
		$this->key = $key;
		$this->codeEngine = $codeEngine;
	}

	public function input(): array
	{
		$data = $this->request('api/games/start/' . $this->key . '/' . $this->codeEngine);

		$this->token = $data['token'];
		
		return $data['input'];
	}

	public function output(array $dataPlayer): void
	{
		if (!isset($dataPlayer['data'])) {
			$this->errors(['Votre tableau de retour doit contenir une cle "data"']);
		}

		$dataPlayer = base64_encode(json_encode($dataPlayer));
		
		$data = $this->request('api/games/response/' . $this->token . '/' . $dataPlayer);

		$color = $data['game_success'] ? 'green' : 'red';

		echo '<p><b style="color: ' . $color . ';">' . $data['game_message'] . '</b></p>' .
			 '<p><b>Le Token de ta Game :</b> <a href="' . self::BASE_URL . 'games/story/' . $this->token . '" target="_blank">' . $this->token . '</a></p>';
	}

	private function request(string $url): array
	{
		$data = file_get_contents(self::BASE_URL . $url);
		$data = json_decode($data, true);

		if (!$data['success']) {
			$this->errors($data['errors']);
		}

		return $data;
	}

	private function errors($errors): void
	{
		foreach ((array) $errors as $error) {
			echo '<p><b>Erreur : </b> ' . $error . '</p>';
		}

		exit();
	}
}