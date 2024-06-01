<?php

namespace division\Data\DAO\guild;

use division\Data\DAO\BaseDAO;
use division\Data\DAO\Interfaces\IGuildMemberDAO;
use division\Models\Enums\GuildAddStatut;
use division\Models\Guild;
use division\Models\User;
use Exception;
use PDOException;
use Slim\Exception\HttpNotImplementedException;

class GuildMemberDAO extends BaseDAO implements IGuildMemberDAO {
	public function getGuildMembers(Guild $guild): array {
		try{
			$req = $this->database->prepare("SELECT * FROM guild_members WHERE guildId = ?");
			$req->bindValue(1, $guild->getName());
			$req->execute();

			return $req->fetchAll();
		} catch (PDOException $e) {
			return [];
		}
	}

	public function addGuildMember(Guild $guild, User $user): void {
		try{
			$req = $this->database->prepare("INSERT INTO guild_members (guildId, userId) VALUES (?,?)");
			$req->bindValue(1, $guild->getName());
			$req->bindValue(2, $user->getId());

			$req->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * @throws Exception
	 */
	public function removeGuildMember(Guild $guild, User $user): void {
		throw new Exception('Not implemented');
	}

	/**
	 * @throws Exception
	 */
	public function isGuildMember(Guild $guild, User $user): bool {
		throw new Exception('Not implemented');
	}

	/**
	 * @throws Exception
	 */
	public function isGuildLeader(Guild $guild, User $user): bool {
		throw new Exception('Not implemented');
	}

	/**
	 * @throws Exception
	 */
	public function getGuildMemberCount(Guild $guild): int {
		throw new Exception('Not implemented');
	}

	/**
	 * @throws Exception
	 */
	public function getGuildLeader(Guild $guild): array {
		throw new Exception('Not implemented');
	}

	public function updateGuildMember(Guild $guild, User $user, GuildAddStatut $statut): void {
		try{
			$req = $this->database->prepare("UPDATE guild_members SET guildId = ?, statut = ? WHERE userId = ?");
			$req->bindValue(1, $guild->getName());
			$req->bindValue(2, $statut->value);
			$req->bindValue(3, $user->getId());

			$req->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
