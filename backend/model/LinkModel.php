<?php
	
	require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';
	require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/service/LinkService.php';
	
	class LinkModel {
		private $linkService;
		
		public function __construct($conn) {
			$this->linkService = new LinkService($conn);
		}
		
		public function addLink(): array {
			return $this->linkService->addLink();
		}
		
		public function getUserLinks(): array {
			return $this->linkService->getUserLinks();
		}
		
		public function deleteLink($linkId): array {
			return $this->linkService->deleteLink($linkId);
		}
	
	}