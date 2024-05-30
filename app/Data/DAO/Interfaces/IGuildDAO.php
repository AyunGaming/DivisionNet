<?php

namespace division\Data\DAO\Interfaces;

use division\Models\Guild;

interface IGuildDAO {
	public function create(Guild $guild): void;
}
