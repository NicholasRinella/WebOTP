<?php

?>
<html>
     <head>
          <style>
               .radio-button input[type="radio"] {
                 display: none;
               }
               .radio-button label {
                 display: inline-block;
                 background-color: #d1d1d1;
                 padding: 4px 11px;
                 font-family: Arial;
                 font-size: 18px;
                 cursor: pointer;
               }
               .radio-button input[type="radio"]:checked+label {
                 background-color: #76cf9f;
               }
          </style>
     </head>
     <body>
          <div class="radio-button">
               <input type="radio" id="radio1" name="radios" value="all" checked>
               <label for="radio1">Books</label>
               <input type="radio" id="radio2" name="radios" value="false">
               <label for="radio2">Snippets</label>
               <input type="radio" id="radio3" name="radios" value="true">
               <label for="radio3">Quizzes</label>
          </div>
     </body>
</html>
