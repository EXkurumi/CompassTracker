<?php

namespace CT;

use pocketmine\plugin\PluginBase;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\PluginTask;
use pocketmine\block\Block;
use pocketmine\event\player\PlayerInteractEvent;


class Main extends PluginBase implements Listener
{
public $compass = array();

    
    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		
}


public function compassTracker(PlayerInteractEvent $ev){
$p = $ev->getPlayer();
if($p->getInventory()->getItemInHand()->getId() === 345 && $ev->getAction() === PlayerInteractEvent::RIGHT_CLICK_AIR){

		if(in_array($ev->getPlayer()->getName(), $this->compass)){
		$p->sendMessage("§c§lYou cant use this for 3 minutes!");
		$ev->setCancelled(true);
		return;
		}
		 		if(!in_array($ev->getPlayer()->getName(), $this->compass)){
		 	
		 array_push($this->compass, $ev->getPlayer()->getName());
		 		$p->sendTip("§c§lYou cant use this for 3 minutes!");
		 
		 	$task = new Task($this, $ev->getPlayer());
		 	$this->getServer()->getScheduler()->scheduleDelayedTask($task, 3600);
$pickqv = [];
$distSqMap = [];
foreach($p->getLevel()->getPlayers() as $player){
  if($player === $p) $p->sendMessage("no one is near you!"); continue;
  $distSq = $player->distanceSquared($p); 
  if($distSq < 4096){
    $picked[$player->getId()] = $player;
    $distSqMap[$player->getId()] = $distSq;
  }
}

asort($distSqMap);
foreach($distSqMap as $id => $distSq){
  $p->sendMessage("§b§l".$picked[$id]->getDisplayName() . " §fis §c" . round(sqrt($distSq)) . " §fblocks from you."); 
}

}
}
}

}
