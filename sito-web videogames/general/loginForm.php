   <form method="post" action="login.php" id="login">
       <p>
           <label for="username">
               <span class="tipoinput">Username:</span> <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username) ?>" required />
           </label>
           <p class="error" id="fL"></p>
       </p>
       <p>
           <label for="password">
               <span class="tipoinput"> Password:</span> <input type="password" name="password" id="password" maxlength="24" required />
           </label>
       </p>
       <p>
           <input type="submit" name="invia" value="Login" class="subs" />
           <p> Nuovo utente ? <a class="signin" href="../signIn/signIn.php">Registrati!</a></p>
       </p>
   </form>