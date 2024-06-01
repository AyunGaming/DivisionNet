<?php

namespace division\Data\DAO\Interfaces;

use division\Models\Guild;
use division\Models\User;

interface IGuildDAO {
	public function create(Guild $guild): void;

	public function getAll(): array;

	public function getByOwner(User $owner): ?Guild;

	public function getByName(string $name): ?Guild;

	public function delete(Guild $guild): void;
}
