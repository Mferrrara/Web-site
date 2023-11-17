<?php
#FUNZIONE PER LA CONNESSIONE AL DATABASE
function connect() {
    require "connectionStringDB.php";
    $db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
    return $db;
}

#FUNZIONE PER L'INSERIMENTO DI UN NUOVO UTENTE
function insert_utente($username, $email, $nome, $cognome, $password, $data) {
    $db = connect();
    $hPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO utente(username, email, nome, cognome, password, datadinascita) VALUES($1, $2, $3, $4, $5, $6)";
    $prepare = pg_prepare($db, "insertUtente", $sql);
    $ret = pg_execute($db, "insertUtente", array($username, $email, $nome, $cognome, $hPassword, $data));
    if (!$ret) {
        echo "Errore query inserimento nuovo utente: " . pg_last_error($db);
        return false;
    } else {
        return true;
    }
}

#FUNZIONE PER CONTROLLARE SE UN VALORE INSERITO (USERNAME primary key / E-MAIL assunzione max 1 per ogni account) E' GIA' PRESENTE NEL DB 
function value_exist($value, $valueName) {
    $db = connect();
    $sql = "SELECT " . $valueName . " FROM utente WHERE " . $valueName . " = $1";
    $prep = pg_prepare($db, $valueName, $sql);
    $ret = pg_execute($db, $valueName, array($value));
    if (!$ret) {
        echo "Errore query controllo $valueName esistente: " . pg_last_error($db);
        return false;
    } else {
        $row = pg_fetch_assoc($ret);
        if (!$row) {
            return true;
        } else {
            return false;
        }
    }
}

#FUNZIONE PER STAMPARE TITOLO E IMMAGINE DI TUTTI I GIOCHI/ DEI GIOCHI ESPOSITIVI
function stampaAnteprimaGiochi($espositivo) {
    $db = connect();
    $sql = "SELECT gioco.nome, gioco.immagine from gioco where gioco.giochiEspositivi = $1 ";
    $ret = pg_prepare($db, "stampaAnteprimaGiochi" . $espositivo, $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaAnteprimaGiochi" . $espositivo, array($espositivo));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            while ($row = pg_fetch_assoc($ret)) {
                $giochi[$row['nome']] = $row['immagine'];
            }
            return $giochi;
        }
    }
}

#FUNZIONE PER STAMPARE TITOLO E IMMAGINE DEI GIOCHI IN BASE AL FILTRO APPLICATO
function stampaAnteprimaGiochiFiltrati($valoreFiltro, $tipoFiltro) {
    $db = connect();
    if ($tipoFiltro == "lingua") {
        $sql = "SELECT lingua.giocoAssociato, gioco.immagine from lingua join gioco on (gioco.nome = lingua.giocoAssociato) where lingua.nomeLingua = $1";
    }
    if ($tipoFiltro == "piattaforma") {
        $sql = "SELECT piattaforma.giocoAssociato, gioco.immagine from piattaforma join gioco on (gioco.nome = piattaforma.giocoAssociato) where piattaforma.nomePiattaforma = $1";
    }
    if ($tipoFiltro == "categoria") {
        $sql = "SELECT gioco.nome, gioco.immagine from gioco where gioco.categoria =$1 ";
    }
    $ret = pg_prepare($db, "stampaGiochiFiltrati" . $valoreFiltro, $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaGiochiFiltrati" . $valoreFiltro, array($valoreFiltro));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            while ($row = pg_fetch_assoc($ret)) {
                $key = array_keys($row);
                $giochi[$row[$key[0]]] = $row[$key[1]];
            }
            return $giochi;
        }
    }
}

#FUNZIONE PER EFFETTUARE IL LOGOUT
function destroySessionAndData() {
    session_start();
    $_SESSION = array();
    if (session_id() != "" ||  isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() -    2592000, '/');
    session_destroy();
}

#FUNZIONE PER EFFETTUARE IL LOGIN
function getPassword($username) {
    $db = connect();
    $sql = "SELECT password FROM utente WHERE username = $1";
    $prep = pg_prepare($db, "sqlPassword", $sql);
    $ret = pg_execute($db, "sqlPassword", array($username));
    if (!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        return false;
    } else {
        if ($row = pg_fetch_assoc($ret)) {
            $password = $row['password'];
            return $password;
        } else {
            return false;
        }
    }
}

#FUNZIONE PER STAMPARE TUTTE LE INFORMAZIONI DI UN GIOCO
function stampaGioco($title) {
    $db = connect();
    $sql = "SELECT gioco.nome, gioco.immagine, gioco.descrizione, gioco.produttore, gioco.categoria from gioco where gioco.nome = $1";
    $ret = pg_prepare($db, "stampaGioco1", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaGioco1", array($title));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            $row = pg_fetch_assoc($ret);
            $gioco = $row;
        }
    }
    $sql = "SELECT lingua.nomeLingua from lingua where lingua.giocoAssociato = $1";
    $ret = pg_prepare($db, "stampaGioco2", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaGioco2", array($title));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            $lingua = "";
            while ($row = pg_fetch_assoc($ret)) {
                $lingua = $lingua .  $row['nomelingua'] . ' ';
            }
            $gioco['lingua'] = $lingua;
        }
    }
    $sql = "SELECT piattaforma.nomePiattaforma from piattaforma where piattaforma.giocoAssociato = $1";
    $ret = pg_prepare($db, "stampaGioco3", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaGioco3", array($title));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            $piattaforma = "";
            while ($row = pg_fetch_assoc($ret)) {
                $piattaforma = $piattaforma .  $row['nomepiattaforma'] . ' ';
            }
            $gioco['piattaforma'] = $piattaforma;
        }
    }
    return $gioco;
}

#FUNZIONE PER STAMPARE I COMMENTI RELATIVI AD UN GIOCO
function stampaCommenti($title) {
    $db = connect();
    $sql = "SELECT commento.nomeUtente, commento.descrizioneCommento from commento where nomeGioco = $1";
    $ret = pg_prepare($db, "stampaCommento", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "stampaCommento", array($title));
        if (!$ret) {
            echo pg_last_error($db);
        } else {
            $commenti = null;
            while ($row = pg_fetch_assoc($ret)) {
                $commenti[$row['nomeutente']] = $row['descrizionecommento'];
            }
            return $commenti;
        }
    }
}

#FUNZIONE PER ELIMINARE IL COMMENTO DI UN UTENTE RELATIVO AD UN GIOCO (SE E' PRESENTE)
function eliminaCommento($title, $username) {
    $db = connect();
    $sql = "DELETE from commento where nomeUtente= $1 and nomeGioco = $2 ";
    $ret = pg_prepare($db, "eliminaCommento", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "eliminaCommento", array($username, $title));
        if (!$ret) {
            echo pg_last_error($db);
        }
    }
}

#FUNZIONE PER INSERIRE IL COMMENTO DI UN UTENTE RELATIVO AD UN GIOCO (SE NON NE HA ANCORA INSERITO UNO)
function inserisciCommento($title, $username, $commento) {
    $db = connect();
    $sql = "INSERT into commento values ($1, $2, $3)";
    $ret = pg_prepare($db, "eliminaCommento", $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {
        $ret = pg_execute($db, "eliminaCommento", array($username, $title, $commento));
        if (!$ret) {
            echo pg_last_error($db);
        }
    }
}
