<?php

namespace division\Data\DAO\Interfaces;

use division\Models\Tag;

interface ITagDAO {
	public function getById(int $id): ?Tag;

	public function getByName(string $name): ?Tag;

	public function getAll(): array;
}
