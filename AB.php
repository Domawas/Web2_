<?php
class DB {
    private $kapcsolat;

    public function __construct() {
        $this->kapcsolat = new mysqli('localhost', 'root', '', 'sport');
        if ($this->kapcsolat->connect_error) {
            die("Kapcsolódás nem sikerült: " . $this->kapcsolat->connect_error);
        }

        $this->kapcsolat->set_charset("utf8");
    }

    public function csapatBeszur($csapatNev, $orszagId, $kepNev) {
        $stmt = $this->kapcsolat->prepare("INSERT INTO csapat (nev, orszagAzon, kep) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $csapatNev, $orszagId, $kepNev);
        $stmt->execute();
        $stmt->close();
    }

    public function csapatNevModosit($regiNev, $ujNev) {
        $stmt = $this->kapcsolat->prepare("UPDATE csapat SET nev = ? WHERE nev = ?");
        $stmt->bind_param("ss", $ujNev, $regiNev);
        $stmt->execute();
        $stmt->close();
    }

    public function csapatTagokTorlese($csapatNev) {
        $stmt = $this->kapcsolat->prepare("DELETE FROM tag WHERE csapatAzon = (SELECT csapatAzon FROM csapat WHERE nev = ?)");
        $stmt->bind_param("s", $csapatNev);
        $stmt->execute();
        $stmt->close();
    }

    public function csapatTorlese($csapatNev) {
        $stmt = $this->kapcsolat->prepare("DELETE FROM csapat WHERE nev = ?");
        $stmt->bind_param("s", $csapatNev);
        $stmt->execute();
        $stmt->close();
    }

    public function csapatokKeppekkel() {
        $result = $this->kapcsolat->query("SELECT nev, kep FROM csapat");
        $csapatok = [];
        while ($row = $result->fetch_assoc()) {
            $csapatok[] = $row;
        }
        return $csapatok;
    }
}
?>
