<?php

namespace division\Data\DAO\guild;

use division\Data\DAO\BaseDAO;
use division\Data\DAO\Interfaces\IGuildDAO;
use division\Models\Guild;
use PDOException;

class GuildDAO extends BaseDAO implements IGuildDAO {

	public function create(Guild $guild): void {
		try {
			$req = $this->database->prepare('INSERT INTO guilds (name, description, owner) VALUES (?, ?, ?)');

			$req->bindValue(1, $guild->getName());
			$req->bindValue(2, $guild->getDescription());
			$req->bindValue(3, $guild->getOwner()->getId());

			$req->execute();
		} catch (PDOException) {
		}
	}

	public function getAll(): array {
		try{
			$req = $this->database->prepare('SELECT * FROM guilds');
			$req->execute();

			$guilds = [];
			$data = $req->fetchAll();
			foreach ($data as $datum) {
				$guild = new Guild();
				$guild->hydrate($datum);
				$guilds[] = $guild;
			}

			return $guilds;
		} catch (PDOException) {
		}
	}
}
