<?php
class UI_Gravatar extends Plugin {
	private $host;
	private $gravatar_hash = "";

	function about() {
		return array(1.0,
			"Shows your globally recognized avatar (Gravatar) in the UI",
			"fox");
	}

	function init($host) {
		$this->host = $host;

		$sth = $this->pdo->prepare("SELECT email FROM ttrss_users WHERE id = ?");
		$sth->execute([$_SESSION['uid']]);

		if ($row = $sth->fetch()) {
			$this->gravatar_hash = md5(trim($row['email']));
		}

		//$host->add_hook($host::HOOK_PREFS_TAB, $this);
	}

	function get_js() {
		if ($this->gravatar_hash) {
			return str_replace("%GRAVATAR_HASH%", $this->gravatar_hash,
				file_get_contents(__DIR__ . "/init.js"));
		} else {
			return "";
		}
	}

	function get_css() {
		if ($this->gravatar_hash) {
			return file_get_contents(__DIR__ . "/init.css");
		} else {
			return "";
		}
	}

	function api_version() {
		return 2;
	}

}
