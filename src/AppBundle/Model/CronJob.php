<?php
	namespace AppBundle\Model;
	
	class CronJob {
		protected $name;
		protected $id;
		function __construct(int $id,string $name) {
			$this->id=$id;
			$this->name=$name;
		}
		function getId(): int {
			return $this->id;
		}
		function getName(): string {
			return $this->name;
		}
	}
	

	