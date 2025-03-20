require_once __DIR__.'/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $titel = $_POST['titel'] ?? '';
    $afdeling = $_POST['afdeling'] ?? '';
    $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
    $melder = $_POST['melder'] ?? '';
    $overig = $_POST['overig'] ?? '';

    if (!empty($titel) && !empty($melder)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO taken (titel, afdeling, prioriteit, melder, overig) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute([$titel, $afdeling, $prioriteit, $melder, $overig]);

            if ($result) {
                header("Location: ".$base_url."/takenlijst.php");
                exit;
            } else {
                echo "Er is iets misgegaan bij het toevoegen van de taak.";
            }
        } catch (Exception $e) {
            echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
        }
    } else {
        echo "Vul alle verplichte velden in!";
    }
}
