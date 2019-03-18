<?php
class UI_Libravatar extends Plugin {
	private $host;
	private $libravatar_hash = "";

	function about() {
		return array(1.0,
			"Shows your globally recognized avatar (Libravatar) in the UI",
			"kierun",
			false,
			"https://git.tt-rss.org/kierun/ttrss-ui-libravatar");
	}

	function init($host) {
		$this->host = $host;

		$sth = $this->pdo->prepare("SELECT email FROM ttrss_users WHERE id = ?");
		$sth->execute([$_SESSION['uid']]);

		if ($row = $sth->fetch()) {
			$this->libravatar_hash = md5(trim($row['email']));
		}

	}

	function get_js() {
		if ($this->libravatar_hash) {
			return str_replace("%LIBRAVATAR_HASH%", $this->libravatar_hash,
				file_get_contents(__DIR__ . "/init.js"));
		} else {
			return "";
		}
	}

	function get_css() {
		if ($this->libravatar_hash) {
			return file_get_contents(__DIR__ . "/init.css");
		} else {
			return "";
		}
	}

	function api_version() {
		return 2;
	}

}
