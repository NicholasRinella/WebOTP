<?php
     $title = "WebOTP - Key Generator";

     include ("./header.php");

     //Key generation
     function generateRandomKey($length = 256) {
         $characters = '-ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
         $charactersLength = strlen($characters);
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
         }
         return $randomString;
     }

     $encryptionKey = generateRandomKey();
?>
<script>
     function copy_to_clipboard(id)
     {
         document.getElementById(id).select();
         document.execCommand('copy');
         alert("Encryption key has been copied to clipboard");
     }
</script>
<div class="div-content">
     <!--Description-->
     <p>
          To start encrypting messages, you will need an encryption key.
     </p>
     <p>
          Once a message has been encrypted, the only way to decrypt it is to use the same encryption key. So keep your encryption keys safe!
     </p>
</div>
<div class="div-content">
     <div class="div-formContent">
          <!--Generate key-->
          <h2>
               Encryption Key Generator
          </h2>
          <div class="div-buttons">
               <form>
                    <input class="button-generateKey" type="submit" name="Generate" value="Generate A New Key">
               </form>
          </div>

		<textarea id="html" name="html"><?php echo htmlspecialchars($encryptionKey); ?></textarea>

          <div class="div-buttons">
               <input type="button" value="Copy To Clipboard" onclick="copy_to_clipboard('html');">
          </div>
     </div>
</div>
<?php
     include ("./footer.php");
?>
