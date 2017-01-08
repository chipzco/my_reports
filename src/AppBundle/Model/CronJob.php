<?php
	namespace AppBundle\Model;
	define("MAXTIME", 60*60*5);
	class CronJob {
		protected $name;
		protected $id;
		protected $started;
		
		function __construct(int $id,string $name) {
			$this->id=$id;
			$this->name=$name;
			$this->started=-1;
		}
		function getId(): int {
			return $this->id;
		}
		function getName(): string {
			return $this->name;
		}
		function setStart() {
			$this->started=time();
		}
		function getStart(): int {
			return $this->started;
		}
		function hasExpired(): boolean {
			if ($this->started!=-1 && (time() - $this->started > MAXTIME))
				return true;
			return false;
		}
	}
	

	