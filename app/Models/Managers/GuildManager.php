<?php

namespace division\Models\Managers;

use division\Data\DAO\Interfaces\IGuildDAO;
use division\Models\Guild;

class GuildManager {
	private IGuildDAO $guildDAO;

	public function __construct(IGuildDAO $guildDAO) {
		$this->guildDAO = $guildDAO;
	}

	public function create(array $data): void {
		$guild = new Guild();
		$guild->hydrate($data);
		$this->guildDAO->create($guild);
	}
}
