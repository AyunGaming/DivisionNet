<?php

namespace division\Models\Managers;

use division\Data\DAO\Interfaces\IGuildDAO;
use division\Data\DAO\Interfaces\IGuildMemberDAO;
use division\Data\DAO\Interfaces\IUserDAO;
use division\Data\DAO\UserDAO;
use division\Models\Enums\GuildAddStatut;
use division\Models\Guild;
use division\Models\User;

class GuildManager {
	private IGuildDAO $guildDAO;
	private IGuildMemberDAO $guildMemberDAO;
	private IUserDAO $userDAO;

	public function __construct(IGuildDAO $guildDAO, IGuildMemberDAO $guildMemberDAO, IUserDAO $userDao) {
		$this->guildDAO = $guildDAO;
		$this->guildMemberDAO = $guildMemberDAO;
		$this->userDAO = $userDao;
	}

	public function create(array $data): void {
		$guild = new Guild();
		$guild->hydrate($data);
		$this->guildDAO->create($guild);
	}

	public function getByOwner(User $user): ?Guild {
		return $this->guildDAO->getByOwner($user);
	}

	public function getByName(string $name): ?Guild {
		return $this->guildDAO->getByName($name);
	}

	public function getAll(): array {
		$data = $this->guildDAO->getAll();
		$guilds = [];
		foreach ($data as $guildData) {
			$owner = $this->userDAO->getById($guildData['owner']);
			$guildData['owner'] = $owner;
			$guild = new Guild();
			$guild->hydrate($guildData);
			$guilds[] = $guild;
		}

		return $guilds;
	}

	public function removeMember(User $user): void {
		$this->guildMemberDAO->removeGuildMember($user);
	}

	public function delete(Guild $guild): void {
		$this->guildDAO->delete($guild);
	}

	public function addMember(Guild $guild, User $user): void {
		$this->guildMemberDAO->addGuildMember($guild, $user);
	}

	public function acceptMember(Guild $guild, User $user): void {
		$this->guildMemberDAO->updateGuildMember($guild, $user, GuildAddStatut::VALIDE);
	}
}
