<form method="post" onsubmit="return attivaRegistrazione()" action="signIn.php" id="registrazione" autocomplete="off">
    <p>
        <label for="username">
            <span class="tipoInput">Username:</span>
            <input type="text" id="username" name="username" placeholder="Max 10 characters" maxlength="10" onkeydown="return controlloUsername(event)" onchange="controlloLunghezzaUsername()" value="<?php echo htmlspecialchars($dati['username']) ?>" required>
        </label>
    <p class="error" id="eU"></p>
    <p class="error" id="cS"></p>
    <p class="error" id="mL"></p>
    </p>
    <p>
        <label for="email">
            <span class="tipoInput">E-mail:</span>
            <input type="email" id="email" name="email" onkeydown="controlloEmail()" value="<?php echo htmlspecialchars($dati['email']) ?>" required />
        </label>
    <p class="error" id="eE"></p>
    </p>
    <p>
        <label for="nome">
            <span class="tipoInput">Nome:</span>
            <input id="nome" name="nome" onkeydown="return soloCaratteri(event,'nC')" value="<?php echo htmlspecialchars($dati['nome']) ?>" required />
        </label>
    <p class="error" id="nC"></p>
    </p>
    <p>
        <label for="cognome">
            <span class="tipoInput">Cognome:</span>
            <input id="cognome" name="cognome" onkeydown="return soloCaratteri(event,'cC')" value="<?php echo htmlspecialchars($dati['cognome']) ?>" required />
        </label>
    <p class="error" id="cC"></p>
    </p>
    <p>
        <label for="password">
            <span class="tipoInput">Password:</span>
            <input type="password" id="password" name="password" placeholder="Min 8 characters Max 24" minlength="8" maxlength="24" onkeyup="controlloPassword()" onchange="verificaPassword()" value="<?php echo htmlspecialchars($dati['password']) ?>" required />
        </label>
    <p class="error" id="pC1"></p>
    </p>
    <p>
        <label for="showPassword">
            <input type="checkbox" id="showPassword" name="showPassword" onclick="mostraPassword()" /> Mostra Password
        </label>
    </p>
    <p>
        <label for="vpassword">
            <span class="tipoInput">Verifica Password:</span>
            <input type="password" id="vpassword" name="vpassword" onchange="verificaPassword()" required />
        </label>
    <p class="error" id="pC2"></p>
    </p>
    <p>
        <label for="data">
            <span class="tipoInput">Data di nascita:</span>
            <input type="date" id="data" name="data" onchange="calcAge()" value="<?php echo htmlspecialchars($dati['data']) ?>" required />
        </label>
    <p class="error" id="dC"></p>
    </p>
    <p>
        <label for="consenso">
            <input type="checkbox" id="consenso" name="consenso" required />
            <a href="https://protezionedatipersonali.it/informativa" target="_blank">
                Informativa sulla privacy </a>
        </label>
    </p>

    <button type="submit" name="subs" id="subs">
        <b> Registrati al sito </b>
    </button>

    <button type="reset" name="clear" id="clear">
        <b> Cancella tutto </b>
    </button>
</form>