<?php

namespace division\Data\DAO\Interfaces;

use division\Models\Enums\GuildAddStatut;
use division\Models\Guild;
use division\Models\User;

interface IGuildMemberDAO {
	public function getGuildMembers(Guild $guild): array;
	public function addGuildMember(Guild $guild, User $user): void;
	public function removeGuildMember(Guild $guild, User $user): void;
	public function isGuildMember(Guild $guild, User $user): bool;
	public function isGuildLeader(Guild $guild, User $user): bool;
	public function getGuildMemberCount(Guild $guild): int;
	public function getGuildLeader(Guild $guild): array;
	public function updateGuildMember(Guild $guild, User $user, GuildAddStatut $statut): void;
}
