<?php

namespace division\Models\Managers;

use division\Data\DAO\Interfaces\IGuildDAO;
use division\Data\DAO\Interfaces\IGuildMemberDAO;
use division\Models\Guild;
use division\Models\User;

class GuildManager {
	private IGuildDAO $guildDAO;
	private IGuildMemberDAO $guildMemberDAO;

	public function __construct(IGuildDAO $guildDAO, IGuildMemberDAO $guildMemberDAO) {
		$this->guildDAO = $guildDAO;
		$this->guildMemberDAO = $guildMemberDAO;
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

	public function addMember(Guild $guild, User $user): void {
		$this->guildMemberDAO->addGuildMember($guild, $user);
	}
}
