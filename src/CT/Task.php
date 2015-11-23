<?php
namespace CT;

use pocketmine\item\Item;
use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;
class Task extends PluginTask{
	public $player;
	public function __construct(Plugin $owner, Player $player){
		parent::__construct($owner);
		$this->player = $player;
		 $config = $this->getOwner()->getConfig();
	}
	
	
	public function onRun($currentTick){
		if ($this->player instanceof Player){
			if(in_array($this->player->getName(), $this->getOwner()->compass)){
		 				$id = array_search($this->player->getName(), $this->getOwner()->compass);
				unset($this->getOwner()->compass[$id]);
				}
			if(!in_array($this->player->getName(), $this->getOwner()->compass)){
			 			$this->player->sendMessage("§l§aYou can use your Compass now!");
		}
	}
}
}
