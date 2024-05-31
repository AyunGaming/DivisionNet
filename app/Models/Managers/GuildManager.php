<?php

namespace division\Models\Managers;

use division\Data\DAO\Interfaces\IGuildDAO;
use division\Models\Guild;
use division\Models\User;

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

	public function getByOwner(User $user): ?Guild {
		return $this->guildDAO->getByOwner($user);
	}

	public function getAll(): array {
		return $this->guildDAO->getAll();
	}

	public function delete(Guild $guild): void {
		$this->guildDAO->delete($guild);
	}
}
