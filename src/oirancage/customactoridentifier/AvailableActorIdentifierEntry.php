<?php declare(strict_types=1);

namespace oirancage\customactoridentifier;

use pocketmine\nbt\tag\CompoundTag;

// Most codes from rush2929, https://github.com/Rush2929/CustomEntityLoader/blob/main/src/EntityRegistryEntry.php
class AvailableActorIdentifierEntry
{

    public const TAG_BEHAVIOR_ID = "bid";
    public const TAG_HAS_SPAWN_EGG = "hasspawnegg";
    public const TAG_IDENTIFIER = "id";
    public const TAG_RUNTIME_ID = "rid";
    public const TAG_SUMMONABLE = "summonable";

    public function __construct(
        private string $identifier,
        private string $behaviorId = "",
        private ?int $runtimeId = null,
        private bool $hasSpawnEgg = false,
        private bool $isSummonable = false
    ){
    }

    public function write(CompoundTag $entry) : void {
        $entry->setString(self::TAG_BEHAVIOR_ID, $this->behaviorId);
        $entry->setByte(self::TAG_HAS_SPAWN_EGG, $this->hasSpawnEgg ? 1 : 0);
        $entry->setString(self::TAG_IDENTIFIER, $this->identifier);
        if ($this->runtimeId !== null) {
            $entry->setInt(self::TAG_RUNTIME_ID, $this->runtimeId);
        }
        $entry->setByte(self::TAG_SUMMONABLE, $this->isSummonable ? 1 : 0);
    }
}