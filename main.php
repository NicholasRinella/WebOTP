<?php
     $title = "WebOTP - Main";

     //----------Encryption & Decryption----------

     //init vars
     $input = "";
     $output = "";
     $encryptionKey = "";
     $cryptionType = "";
     $error = "";
     $canPerformCryption = false;

     //Validate encryptionKey
     if(isset($_POST['submitButtonEncrypt']) || isset($_POST['submitButtonDecrypt'])) {
          if(isset($_POST['encryptionKey']) && $_POST['encryptionKey'] !== "") {
               //encryptionKey is valid
               $encryptionKey = $_POST['encryptionKey'];

               //Validate input
               if(isset($_POST['input']) && $_POST['input'] !== "") {
                    //input is valid
                    $input = $_POST['input'];
                    //remove unwanted characters
                    $input = strtoupper(preg_replace('/ /','-',$input));

                    //Get cryptionType from button pressed
                    //----------Encrypt---------
                    if(isset($_POST['submitButtonEncrypt'])) {
                         //cryptionType is valid
                         $cryptionType = "encrypt";

                         //Info is valid, can now perform calculation
                         $canPerformCryption = true;
                    }else{
                    //---------Decrypt---------
                         //cryptionType is valid
                         $cryptionType = "decrypt";

                         //Info is valid, can now perform calculation
                         $canPerformCryption = true;
                    }
               }else{
                    $error = "Please enter an input.";
               }
          }else{
               $error = "Please enter a valid encryption key.<br>If you do not have one, use the link below.";
          }

          //Perform encryption/decryption
          if($canPerformCryption == true) {
               //Generate cryption table
               $characterList = '-ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
               $characterListSize = strlen($characterList);
               $cryptionTable = array();
               //Row Loop
               for($row = 0; $row < $characterListSize; $row ++) {
                    //Column Loop
                    $rowString = '';
                    for($column = 0; $column < $characterListSize; $column ++) {
                         if(($column + $row) < strlen($characterList)) {
                              $rowString .= $characterList[$column+$row];
                         }else{
                              $rowString .= $characterList[$column+$row-$characterListSize];
                         }
                    }
                    $cryptionTable[$row] = $rowString;
               }

               switch($cryptionType) {
                    case "encrypt":
                         //Encryption Process
                         for($i = 0; $i < strlen($input); $i ++) {
                              //Find indexes of input and encryptionKey chars
                              $inputIndex = strrpos($cryptionTable[0], $input[$i]);
                              $encryptIndex = strrpos($cryptionTable[0], $encryptionKey[$i]);
                              //Save character at intersection to output
                              $output .= substr($cryptionTable[$encryptIndex], $inputIndex, 1);
                         }
                         break;
                    case "decrypt":
                         //Decryption Process
                         for($i = 0; $i < strlen($input); $i ++) {
                              //Find indexes of input and encryptionKeychars
                              $otpIndex = strrpos($cryptionTable[0], $encryptionKey[$i]);
                              $decryptedIndex = strrpos($cryptionTable[$otpIndex], $input[$i]);
                              //Save character at intersection to output
                              $output .= substr($cryptionTable[0], $decryptedIndex, 1);
                         }
                         break;
                    default:
                         break;
               }
          }
     }

     include ("./header.php");
?>
<div class="div-content">
     <!--Helpful links-->
     <p>
          What is <a href="info.php">this website</a>?
     </p>
</div>

<div class="div-content">
     <form method="POST" action="main.php" id="mainForm">
          <!--Error message-->
          <p class="error-message">
               <?php echo($error); ?>
          </p>

          <!--Get Key-->
          <h2>Encryption Key</h2>
          <p>
			Generate an encryption key <a href="getkey.php">here</a>.
		</p>
          <textarea type="text" name="encryptionKey" form="mainForm" placeholder="Put your encryption key here"><?php echo($encryptionKey); ?></textarea>

          <!--Input form-->
          <h2>Input</h2>
          <textarea type="text" name="input" form="mainForm" placeholder="The message to encrypt/decrypt goes here"><?php echo($input); ?></textarea>

          <!--Encrypt/decrypt buttons-->
          <div class="div-buttons">
               <input type="submit" name="submitButtonEncrypt" value="Encrypt">
               <input type="submit" name="submitButtonDecrypt" value="Decrypt">
          </div>
     </form>
</div>
<div class="div-content">
     <!--Output box-->
     <h2>Output</h2>
     <textarea type="text" placeholder="The encrypted/decrypted result will appear here"><?php echo($output); ?></textarea>
</div>
<?php
     include ("./footer.php");
?>
