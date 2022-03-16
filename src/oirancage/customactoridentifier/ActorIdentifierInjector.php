<?php declare(strict_types=1);

namespace oirancage\customactoridentifier;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\AvailableActorIdentifiersPacket;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;

class ActorIdentifierInjector
{
    private const ID_LIST = "idlist";

    public function __construct(private AvailableActorIdentifiersPacket $packet){}

    public function inject(AvailableActorIdentifierEntry $entry){
        $root = $this->packet->identifiers->getRoot();
        assert($root instanceof CompoundTag);
        $identifierListTag = $root->getListTag(self::ID_LIST);
        $compound = CompoundTag::create();
        $entry->write($compound);
        $identifierListTag->push($compound);
        $this->packet->identifiers = new CacheableNbt(CompoundTag::create()->setTag(self::ID_LIST, $identifierListTag));
    }
}