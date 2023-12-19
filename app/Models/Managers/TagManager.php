<?php

namespace division\Models\Managers;

use division\Data\DAO\Interfaces\ITagDAO;
use division\Models\Tag;

class TagManager {
	private ITagDAO $tagDAO;

	public function __construct(ITagDAO $tagDAO) {
		$this->tagDAO = $tagDAO;
	}

	public function getByName(string $name): ?Tag {
		return $this->tagDAO->getByName($name);
	}
}