<?php
	require_once '../security/tokenHandler.php';
	require_once '../service/LinkService.php';
	
	class LinkModel {
		private $linkService;
		
		public function __construct($conn) {
			$this->linkService = new LinkService($conn);
		}
		
		public function saveLink(): array {
			return $this->linkService->addLink();
		}
		
		
		public function getUserInfo(): array {
			return $this->linkService->getUserLinks();
		}
		
		public function removeLink($linkId): array {
			return $this->linkService->deleteLink($linkId);
		}
		
		public function getLink($keyword): array
		{
			return $this->linkService->searchLinks($keyword);
		}
	
	}